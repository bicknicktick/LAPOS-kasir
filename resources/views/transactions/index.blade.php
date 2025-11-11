@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@section('content')
<div class="card">
    <div class="flex justify-between">
        <h2>📋 Daftar Transaksi</h2>
    </div>
    
    @if($transactions->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Kode Transaksi</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->transaction_code }}</td>
                    <td>{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                    <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                    <td>
                        <span style="padding: 0.25rem 0.5rem; background: #e8f5e9; color: #2e7d32; border-radius: 4px; font-size: 0.875rem;">
                            {{ ucfirst($transaction->payment_method) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('transactions.show', $transaction->id) }}" class="btn">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center" style="padding: 2rem; color: #999;">Belum ada transaksi</p>
    @endif
</div>

<!-- Summary -->
<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
    <div class="card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
        <h3 style="color: white; font-size: 0.875rem; margin-bottom: 0.5rem;">Total Transaksi</h3>
        <p style="font-size: 2rem; font-weight: bold;">{{ $transactions->count() }}</p>
    </div>
    
    <div class="card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
        <h3 style="color: white; font-size: 0.875rem; margin-bottom: 0.5rem;">Total Penjualan</h3>
        <p style="font-size: 2rem; font-weight: bold;">Rp {{ number_format($transactions->sum('total'), 0, ',', '.') }}</p>
    </div>
    
    <div class="card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white;">
        <h3 style="color: white; font-size: 0.875rem; margin-bottom: 0.5rem;">Transaksi Hari Ini</h3>
        <p style="font-size: 2rem; font-weight: bold;">{{ $transactions->where('created_at', '>=', today())->count() }}</p>
    </div>
</div>
@endsection
