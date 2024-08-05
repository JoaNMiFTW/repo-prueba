<?php

namespace Database\Seeders;

use App\Models\Product;
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
        $products = [
            ['name' => 'Plátano', 'description' => 'descripción para plátano', 'price' => 15.00, 'stock' => 50, 'category_id' => 1, 'image' => 'platano.jpg'],
            ['name' => 'Filete', 'description' => 'descripción para filete', 'price' => 25.50, 'stock' => 30, 'category_id' => 1, 'image' => 'filete.jpg'],
            ['name' => 'Arroz', 'description' => 'descripción para arroz', 'price' => 5.75, 'stock' => 100, 'category_id' => 1, 'image' => 'arroz.jpg'],

            ['name' => 'Portatil', 'description' => 'descripción para portatil', 'price' => 875.00, 'stock' => 20, 'category_id' => 2, 'image' => 'portatil.jpg'],
            ['name' => 'Tablet', 'description' => 'descripción para tablet', 'price' => 475.50, 'stock' => 50, 'category_id' => 2, 'image' => 'tablet.jpg'],
            ['name' => 'Pc Gaming', 'description' => 'descripción para pc gaming', 'price' => 1250.00, 'stock' => 10, 'category_id' => 2, 'image' => 'pc_gaming.jpg'],

            ['name' => 'Piscina', 'description' => 'descripción para piscina', 'price' => 7500.95, 'stock' => 5, 'category_id' => 3, 'image' => 'piscina.jpg'],
            ['name' => 'Manguera', 'description' => 'descripción para manguera', 'price' => 25.00, 'stock' => 80, 'category_id' => 3, 'image' => 'manguera.jpg'],
            ['name' => 'Cortacesped', 'description' => 'descripción para cortacesped', 'price' => 375.40, 'stock' => 15, 'category_id' => 3, 'image' => 'cortacesped.jpg']
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
