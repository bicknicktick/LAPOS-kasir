<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionsExport;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with('details.product');
        
        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }
        
        $transactions = $query->orderBy('created_at', 'desc')->get();
        
        // Calculate summary
        $summary = [
            'total_transactions' => $transactions->count(),
            'total_revenue' => $transactions->sum('total'),
            'total_cash' => $transactions->where('payment_method', 'tunai')->sum('total'),
            'total_card' => $transactions->where('payment_method', 'transfer')->sum('total'),
        ];
        
        return view('reports.index', compact('transactions', 'summary'));
    }
    
    public function exportPdf(Request $request)
    {
        try {
            $query = Transaction::with('details.product');
            
            if ($request->filled('start_date')) {
                $query->whereDate('created_at', '>=', $request->start_date);
            }
            
            if ($request->filled('end_date')) {
                $query->whereDate('created_at', '<=', $request->end_date);
            }
            
            $transactions = $query->orderBy('created_at', 'desc')->get();
            
            $summary = [
                'total_transactions' => $transactions->count(),
                'total_revenue' => $transactions->sum('total'),
                'total_cash' => $transactions->where('payment_method', 'tunai')->sum('total'),
                'total_card' => $transactions->where('payment_method', 'transfer')->sum('total'),
                'start_date' => $request->start_date ?? 'All time',
                'end_date' => $request->end_date ?? 'Present',
            ];
            
            $pdf = Pdf::loadView('reports.pdf', compact('transactions', 'summary'));
            
            return $pdf->download('sales-report-' . date('Y-m-d') . '.pdf');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Failed to generate PDF report. Please try again.'
            ]);
        }
    }
    
    public function exportExcel(Request $request)
    {
        try {
            return Excel::download(
                new TransactionsExport($request->start_date, $request->end_date),
                'sales-report-' . date('Y-m-d') . '.xlsx'
            );
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Failed to generate Excel report. Please try again.'
            ]);
        }
    }
}
