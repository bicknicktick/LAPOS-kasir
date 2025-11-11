<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $startDate;
    protected $endDate;
    
    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    
    public function collection()
    {
        $query = Transaction::with('details.product');
        
        if ($this->startDate) {
            $query->whereDate('created_at', '>=', $this->startDate);
        }
        
        if ($this->endDate) {
            $query->whereDate('created_at', '<=', $this->endDate);
        }
        
        return $query->orderBy('created_at', 'desc')->get();
    }
    
    public function headings(): array
    {
        return [
            'Transaction Code',
            'Date',
            'Time',
            'Cashier',
            'Payment Method',
            'Currency Mode',
            'Items',
            'Subtotal',
            'Tax (10%)',
            'Total',
            'Display Total',
            'Paid Amount',
            'Change',
        ];
    }
    
    public function map($transaction): array
    {
        $subtotal = $transaction->total / 1.1;
        $tax = $transaction->total - $subtotal;
        
        // Display total based on currency mode
        $displayTotal = $transaction->currency_mode == 'redenominated' 
            ? number_format($transaction->total / 1000, 2, ',', '.') 
            : number_format($transaction->total, 0, ',', '.');
        
        return [
            $transaction->transaction_code,
            $transaction->created_at->format('Y-m-d'),
            $transaction->created_at->format('H:i:s'),
            $transaction->cashier_name ?? '-',
            ucfirst($transaction->payment_method),
            $transaction->currency_mode == 'redenominated' ? 'Redenominated' : 'Standard',
            $transaction->details->count() . ' items',
            number_format($subtotal, 0, ',', '.'),
            number_format($transaction->tax, 0, ',', '.'),
            number_format($transaction->total, 0, ',', '.'),
            $displayTotal,
            number_format($transaction->paid_amount, 0, ',', '.'),
            number_format($transaction->change, 0, ',', '.'),
        ];
    }
    
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '2c3e50']
                ],
                'font' => ['color' => ['rgb' => 'FFFFFF'], 'bold' => true],
            ],
        ];
    }
}
