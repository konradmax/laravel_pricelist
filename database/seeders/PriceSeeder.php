<?php

namespace Database\Seeders;

use App\Models\Price;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Price::create([
            'sku' => 'product-001',
            'price' => '19.99',
        ]);
        Price::create([
            'sku' => 'product-002',
            'price' => '29.99',
        ]);
        Price::create([
            'sku' => 'product-003',
            'price' => '49.99',
        ]);
        Price::create([
            'sku' => 'product-001',
            'price' => '59.99',
        ]);
    }
}
