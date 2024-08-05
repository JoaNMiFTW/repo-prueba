<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $categories = [
            ['name' => 'Alimentación', 'description' => 'Categoría de alimentación'],
            ['name' => 'Tecnología', 'description' => 'Categoría de tectnología'],
            ['name' => 'Jardín', 'description' => 'Categoría de jardín']
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
