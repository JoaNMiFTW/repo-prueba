<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|string',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->failed();
        }

        $product = new Product($request->all());

        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('images', 'public');
        }

        $product->save();

        return response()->json($product, Response::HTTP_CREATED);
    }

    public function show(Product $product)
    {
        $product->load('category');
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'description' => 'nullable|string',
            'price' => 'numeric',
            'stock' => 'integer',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|string',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->failed();
        }

        $product->fill($request->all());

        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('images', 'public');
        }

        $product->save();

        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function getRandomProduct()
    {
        $product = $this->productService->getRandomProduct();

        if (!$product) {
            return response()->json([
                'error' => 'No products available',
                'message' => 'There are no products available at the moment.'
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json($product, Response::HTTP_OK);
    }
}
