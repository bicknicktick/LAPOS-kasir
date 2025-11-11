<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        try {
            $transactions = Transaction::with('details.product')
                ->orderBy('created_at', 'desc')
                ->get();
            
            return view('transactions.index', compact('transactions'));
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Unable to load transaction history. Please contact support if this persists.'
            ]);
        }
    }

    public function create()
    {
        try {
            $products = Product::where('stock', '>', 0)->get();
            return view('transactions.create_modern', compact('products'));
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Unable to load products. Please ensure the database is properly configured.'
            ]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'payment_method' => 'required|in:tunai,transfer',
            'paid_amount' => 'required|numeric|min:0'
        ]);

        DB::beginTransaction();
        
        try {
            // Hitung total
            $subtotal = 0;
            $items = [];
            
            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);
                
                // Cek stok
                if ($product->stock < $item['quantity']) {
                    return back()->withErrors([
                        'error' => "Stock for {$product->name} is insufficient"
                    ])->withInput();
                }
                
                $itemSubtotal = $product->price * $item['quantity'];
                $subtotal += $itemSubtotal;
                
                $items[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'subtotal' => $itemSubtotal
                ];
            }
            
            // Calculate tax (10%) and total
            $tax = $subtotal * 0.1;
            $total = $subtotal + $tax;
            
            // Validasi pembayaran
            if ($request->paid_amount < $total) {
                return back()->withErrors([
                    'error' => 'Payment amount is insufficient'
                ])->withInput();
            }
            
            $change = $request->paid_amount - $total;
            
            // Simpan transaksi
            $transaction = Transaction::create([
                'transaction_code' => Transaction::generateCode(),
                'total' => $total,
                'payment_method' => $request->payment_method,
                'paid_amount' => $request->paid_amount,
                'change' => $change
            ]);
            
            // Simpan detail dan kurangi stok
            foreach ($items as $item) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['product']->price,
                    'subtotal' => $item['subtotal']
                ]);
                
                $item['product']->decreaseStock($item['quantity']);
            }
            
            DB::commit();
            
            return redirect()->route('transactions.show', $transaction->id)
                ->with('success', 'Transaction completed successfully');
                
        } catch (\Exception $e) {
            DB::rollback();
            
            // Log error for debugging
            \Log::error('Transaction failed: ' . $e->getMessage());
            
            return back()->withErrors([
                'error' => 'Transaction failed. Please try again or contact support if the issue persists.'
            ])->withInput();
        }
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('details.product');
        return view('transactions.show', compact('transaction'));
    }
}
