@extends('layouts.app')

@section('title', 'Sales Reports')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>📊 Sales Reports</h2>
        <div style="display: flex; gap: 10px;">
            <form action="{{ route('reports.pdf') }}" method="GET" style="display: inline;">
                @if(request('start_date'))
                    <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                @endif
                @if(request('end_date'))
                    <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                @endif
                <button type="submit" class="btn btn-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 18px; height: 18px; display: inline; vertical-align: middle; margin-right: 5px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    Export PDF
                </button>
            </form>
            
            <form action="{{ route('reports.excel') }}" method="GET" style="display: inline;">
                @if(request('start_date'))
                    <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                @endif
                @if(request('end_date'))
                    <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                @endif
                <button type="submit" class="btn btn-success">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 18px; height: 18px; display: inline; vertical-align: middle; margin-right: 5px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                    Export Excel
                </button>
            </form>
        </div>
    </div>
    
    <!-- Filter Form -->
    <form method="GET" action="{{ route('reports.index') }}" style="margin-bottom: 30px;">
        <div style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 15px; align-items: end;">
            <div class="form-group" style="margin-bottom: 0;">
                <label>Start Date</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="form-control">
            </div>
            
            <div class="form-group" style="margin-bottom: 0;">
                <label>End Date</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="form-control">
            </div>
            
            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('reports.index') }}" class="btn" style="background: #95a5a6;">Reset</a>
            </div>
        </div>
    </form>
    
    <!-- Summary Cards -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin-bottom: 30px;">
        <div style="background: linear-gradient(135deg, #16a085 0%, #138d75 100%); color: white; padding: 20px; border-radius: 8px;">
            <div style="font-size: 13px; opacity: 0.9; margin-bottom: 5px;">Total Transactions</div>
            <div style="font-size: 28px; font-weight: 700;">{{ $summary['total_transactions'] }}</div>
        </div>
        
        <div style="background: linear-gradient(135deg, #2c3e50 0%, #1a252f 100%); color: white; padding: 20px; border-radius: 8px;">
            <div style="font-size: 13px; opacity: 0.9; margin-bottom: 5px;">Total Revenue</div>
            <div style="font-size: 28px; font-weight: 700;">Rp {{ number_format($summary['total_revenue'], 0, ',', '.') }}</div>
        </div>
        
        <div style="background: linear-gradient(135deg, #27ae60 0%, #229954 100%); color: white; padding: 20px; border-radius: 8px;">
            <div style="font-size: 13px; opacity: 0.9; margin-bottom: 5px;">Cash Payments</div>
            <div style="font-size: 28px; font-weight: 700;">Rp {{ number_format($summary['total_cash'], 0, ',', '.') }}</div>
        </div>
        
        <div style="background: linear-gradient(135deg, #3498db 0%, #2980b9 100%); color: white; padding: 20px; border-radius: 8px;">
            <div style="font-size: 13px; opacity: 0.9; margin-bottom: 5px;">Card Payments</div>
            <div style="font-size: 28px; font-weight: 700;">Rp {{ number_format($summary['total_card'], 0, ',', '.') }}</div>
        </div>
    </div>
    
    <!-- Transactions Table -->
    @if($transactions->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Date & Time</th>
                    <th>Cashier</th>
                    <th>Items</th>
                    <th>Payment</th>
                    <th>Currency</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td><strong>{{ $transaction->transaction_code }}</strong></td>
                    <td>{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                    <td>
                        <span style="font-weight: 600; color: #2c3e50;">
                            {{ $transaction->cashier_name ?? '-' }}
                        </span>
                    </td>
                    <td>{{ $transaction->details->count() }} items</td>
                    <td>
                        <span style="padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; 
                            {{ $transaction->payment_method == 'tunai' ? 'background: #d4edda; color: #155724;' : 'background: #d1ecf1; color: #0c5460;' }}">
                            {{ ucfirst($transaction->payment_method) }}
                        </span>
                    </td>
                    <td>
                        <span style="padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; 
                            {{ $transaction->currency_mode == 'redenominated' ? 'background: #fff3cd; color: #856404;' : 'background: #e7f3ff; color: #004085;' }}">
                            {{ $transaction->currency_mode == 'redenominated' ? '🔄 Redom' : '💵 Standard' }}
                        </span>
                    </td>
                    <td>
                        <strong>
                            @if($transaction->currency_mode == 'redenominated')
                                Rp {{ number_format($transaction->total / 1000, 2, ',', '.') }}
                            @else
                                Rp {{ number_format($transaction->total, 0, ',', '.') }}
                            @endif
                        </strong>
                    </td>
                    <td>
                        <a href="{{ route('transactions.show', $transaction->id) }}" class="btn" style="padding: 6px 12px; font-size: 13px;">
                            View Details
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div style="text-align: center; padding: 60px 20px; color: #95a5a6;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 64px; height: 64px; margin: 0 auto 20px; opacity: 0.3;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
            </svg>
            <p style="font-size: 16px;">No transactions found for the selected period</p>
        </div>
    @endif
</div>
@endsection
