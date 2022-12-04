<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'category_id' => 1,
            'title' => 'medical consulting'
        ]);
        Category::create([
            'category_id' => 2,
            'title' => 'professional consulting'
        ]);
        Category::create([
            'category_id' => 3,
            'title' => 'psychological consulting'
        ]);
        Category::create([
            'category_id' => 4,
            'title' => 'family consulting'
        ]);
        Category::create([
            'category_id' => 5,
            'title' => 'business consulting'
        ]);
    }
}
