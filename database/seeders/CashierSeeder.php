<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cashier;

class CashierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cashiers = [
            ['name' => 'Admin', 'pin' => '123456'],
            ['name' => 'Kasir 1', 'pin' => '111111'],
            ['name' => 'Kasir 2', 'pin' => '222222'],
        ];
        
        foreach ($cashiers as $cashier) {
            Cashier::create($cashier);
        }
    }
}
