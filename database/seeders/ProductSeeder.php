<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'code' => 'BRG001',
                'name' => 'Sabun Mandi',
                'price' => 15000,
                'stock' => 50,
                'category' => 'Kebutuhan Rumah'
            ],
            [
                'code' => 'BRG002',
                'name' => 'Shampo',
                'price' => 25000,
                'stock' => 30,
                'category' => 'Kebutuhan Rumah'
            ],
            [
                'code' => 'BRG003',
                'name' => 'Pasta Gigi',
                'price' => 12000,
                'stock' => 40,
                'category' => 'Kebutuhan Rumah'
            ],
            [
                'code' => 'BRG004',
                'name' => 'Mie Instan',
                'price' => 3500,
                'stock' => 100,
                'category' => 'Makanan'
            ],
            [
                'code' => 'BRG005',
                'name' => 'Kopi Sachet',
                'price' => 2000,
                'stock' => 200,
                'category' => 'Minuman'
            ],
            [
                'code' => 'BRG006',
                'name' => 'Air Mineral 600ml',
                'price' => 4000,
                'stock' => 80,
                'category' => 'Minuman'
            ],
            [
                'code' => 'BRG007',
                'name' => 'Teh Celup',
                'price' => 15000,
                'stock' => 25,
                'category' => 'Minuman'
            ],
            [
                'code' => 'BRG008',
                'name' => 'Gula 1kg',
                'price' => 18000,
                'stock' => 35,
                'category' => 'Bahan Pokok'
            ],
            [
                'code' => 'BRG009',
                'name' => 'Minyak Goreng 1L',
                'price' => 22000,
                'stock' => 20,
                'category' => 'Bahan Pokok'
            ],
            [
                'code' => 'BRG010',
                'name' => 'Beras 5kg',
                'price' => 75000,
                'stock' => 15,
                'category' => 'Bahan Pokok'
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
