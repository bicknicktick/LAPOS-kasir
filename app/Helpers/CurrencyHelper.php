<?php

namespace App\Helpers;

class CurrencyHelper
{
    /**
     * Format currency with redenomination support
     */
    public static function format($amount, $showSymbol = true)
    {
        $isRedenominated = config('app.currency_redenomination', false);
        $symbol = config('app.currency_symbol', 'Rp');
        
        if ($isRedenominated) {
            // After redenomination (remove 3 zeros)
            $amount = $amount / 1000;
            $formatted = number_format($amount, 2, '.', ',');
        } else {
            // Current format
            $formatted = number_format($amount, 0, ',', '.');
        }
        
        return $showSymbol ? $symbol . ' ' . $formatted : $formatted;
    }
    
    /**
     * Parse currency input considering redenomination
     */
    public static function parse($value)
    {
        $isRedenominated = config('app.currency_redenomination', false);
        $value = str_replace(['Rp', ' ', '.', ','], '', $value);
        $value = floatval($value);
        
        if ($isRedenominated) {
            // Convert back to original value
            return $value * 1000;
        }
        
        return $value;
    }
    
    /**
     * Get display value for forms
     */
    public static function displayValue($amount)
    {
        $isRedenominated = config('app.currency_redenomination', false);
        
        if ($isRedenominated) {
            return $amount / 1000;
        }
        
        return $amount;
    }
}
