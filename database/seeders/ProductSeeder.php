<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'sku' => 'product-001',
            'name' => 'Product 1',
            'category_id' => 'category-001',
            'desc' => 'Lorem ipsum',
        ]);
        Product::create([
            'sku' => 'product-002',
            'name' => 'Product 2',
            'category_id' => 'category-002',
            'desc' => 'Lorem ipsum',
        ]);
        Product::create([
            'sku' => 'product-003',
            'name' => 'Product 3',
            'category_id' => 'category-001',
            'desc' => 'Lorem ipsum',
        ]);
    }
}
