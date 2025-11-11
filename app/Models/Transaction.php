<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_code',
        'total',
        'payment_method',
        'paid_amount',
        'change',
        'currency_mode',
        'cashier_name'
    ];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public static function generateCode()
    {
        $date = date('Ymd');
        $lastTransaction = self::whereDate('created_at', today())->latest()->first();
        
        if ($lastTransaction) {
            $lastNumber = (int)substr($lastTransaction->transaction_code, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
        
        return 'TRX' . $date . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }
}
