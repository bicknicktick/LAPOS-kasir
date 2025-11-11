@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="card">
    <div class="flex justify-between">
        <h2>🧾 Detail Transaksi</h2>
        <a href="{{ route('transactions.index') }}" class="btn">Kembali</a>
    </div>
    
    <div style="margin: 2rem 0; padding: 1.5rem; background: #f8f9fa; border-radius: 8px;">
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
            <div>
                <p><strong>Kode Transaksi:</strong></p>
                <p style="font-size: 1.25rem; color: #3498db;">{{ $transaction->transaction_code }}</p>
            </div>
            <div>
                <p><strong>Tanggal:</strong></p>
                <p>{{ $transaction->created_at->format('d F Y, H:i') }}</p>
            </div>
            <div>
                <p><strong>Metode Pembayaran:</strong></p>
                <p>{{ ucfirst($transaction->payment_method) }}</p>
            </div>
            <div>
                <p><strong>Mode Mata Uang:</strong></p>
                <p>
                    @if($transaction->currency_mode == 'redenominated')
                        <span style="color: #f39c12;">🔄 Redenominasi</span>
                    @else
                        <span style="color: #3498db;">💵 Standard</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
    
    <h3>Detail Produk</h3>
    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->details as $detail)
            <tr>
                <td>{{ $detail->product->name }}</td>
                <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right"><strong>TOTAL ({{ $transaction->currency_mode == 'redenominated' ? 'Redenominasi' : 'Standard' }}):</strong></td>
                <td>
                    <strong>
                        @if($transaction->currency_mode == 'redenominated')
                            Rp {{ number_format($transaction->total / 1000, 2, ',', '.') }}
                        @else
                            Rp {{ number_format($transaction->total, 0, ',', '.') }}
                        @endif
                    </strong>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="text-right">Dibayar:</td>
                <td>
                    @if($transaction->currency_mode == 'redenominated')
                        Rp {{ number_format($transaction->paid_amount / 1000, 2, ',', '.') }}
                    @else
                        Rp {{ number_format($transaction->paid_amount, 0, ',', '.') }}
                    @endif
                </td>
            </tr>
            @if($transaction->payment_method === 'tunai')
            <tr>
                <td colspan="3" class="text-right">Kembalian:</td>
                <td>
                    @if($transaction->currency_mode == 'redenominated')
                        Rp {{ number_format($transaction->change / 1000, 2, ',', '.') }}
                    @else
                        Rp {{ number_format($transaction->change, 0, ',', '.') }}
                    @endif
                </td>
            </tr>
            @endif
        </tfoot>
    </table>
    
    <div class="text-center mt-2">
        <button onclick="window.print()" class="btn">🖨️ Cetak Struk</button>
    </div>
</div>

@push('styles')
<style>
    @media print {
        header, nav, .btn {
            display: none !important;
        }
        
        .card {
            box-shadow: none;
            padding: 0;
        }
        
        body {
            background: white;
        }
    }
</style>
@endpush
@endsection
