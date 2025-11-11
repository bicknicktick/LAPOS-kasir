<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'pin' => 'required|string|size:6'
            ]);
            
            $cashier = Cashier::where('name', $request->name)
                ->where('pin', $request->pin)
                ->where('is_active', true)
                ->first();
            
            if (!$cashier) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid name or PIN'
                ], 401);
            }
            
            return response()->json([
                'success' => true,
                'message' => 'Login successful',
                'cashier' => [
                    'id' => $cashier->id,
                    'name' => $cashier->name
                ]
            ], 200);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Cashier login error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Login failed. Please try again.'
            ], 500);
        }
    }
}
