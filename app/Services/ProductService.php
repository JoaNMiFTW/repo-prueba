<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductService
{

    public function getPrice(int $id){
        $product = Product::findOrFail($id);
        return $product['price'];
    }

    public function getRandomProduct(){
        return Product::inRandomOrder()->first();
    }

}
