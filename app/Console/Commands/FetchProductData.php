<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchProductData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recoge datos de una API y los vuelca a la base de datos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $response = Http::get('https://fakestoreapi.com/products');

        if ($response->successful()) {
            $products = $response->json();

            foreach ($products as $product) {
                $category = Category::create(['name' => $product['category']]);

                Product::create([
                        'name' => $product['title'],
                        'description' => $product['description'],
                        'price' => $product['price'],
                        'stock' => rand(1, 100),
                        'category_id' => $category->id,
                        'image' => $product['image']
                    ]
                );
            }

            echo "Product data has been successfully fetched and saved.";
        } else {
            echo "Failed to fetch product data from external API.";
        }
    }
}
