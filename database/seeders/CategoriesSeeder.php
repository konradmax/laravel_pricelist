<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'category_id' => 'category-001',
            'name' => 'Category #1',
        ]);
        Category::create([
            'category_id' => 'category-002',
            'name' => 'Category #2',
        ]);
    }
}
