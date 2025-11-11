<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'price',
        'stock',
        'category'
    ];

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function decreaseStock($quantity)
    {
        $this->stock -= $quantity;
        $this->save();
    }

    public function increaseStock($quantity)
    {
        $this->stock += $quantity;
        $this->save();
    }
    
    public function getFormattedPriceAttribute()
    {
        return \App\Helpers\CurrencyHelper::format($this->price);
    }
    
    public function getDisplayPriceAttribute()
    {
        return \App\Helpers\CurrencyHelper::displayValue($this->price);
    }
}
