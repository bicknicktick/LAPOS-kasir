<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'pin' => 'required|string|size:6'
        ]);
        
        try {
            $cashier = Cashier::where('name', $request->name)
                ->where('pin', $request->pin)
                ->where('is_active', true)
                ->first();
            
            if (!$cashier) {
                return response()->json([
                    'message' => 'Invalid name or PIN'
                ], 401);
            }
            
            return response()->json([
                'message' => 'Login successful',
                'cashier' => [
                    'id' => $cashier->id,
                    'name' => $cashier->name
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Login failed. Please try again.'
            ], 500);
        }
    }
}
