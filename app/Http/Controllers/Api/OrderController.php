<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Services\OrderService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function __construct(OrderService $orderService, ProductService $productService)
    {
        $this->orderService = $orderService;
        $this->productService = $productService;
    }

    public function index()
    {
        $orders = Order::with('orderItems')->get();
        return response()->json($orders);
    }

    public function store(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'status' => 'required|string',
            'order_items' => 'required|array',
            'order_items.*.product_id' => 'required|exists:products,id',
            'order_items.*.quantity' => 'required|integer',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->failed();
        }

        $request = $this->orderService->calculateTotalAmount($request);

        $order = Order::create($request->only(['user_id', 'total_amount', 'status']));

        foreach ($request->input('order_items') as $item) {
            $item['price'] = $this->productService->getPrice($item['product_id']);
            $order->orderItems()->create($item);
        }

        return response()->json($order, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        return response()->json($order);
    }

    public function update(Request $request, $id)
    {

        $validatedData = Validator::make($request->all(), [
            'total_amount' => 'nullable|numeric',
            'status' => 'nullable|string',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->failed();
        }

        $order = Order::findOrFail($id);
        $order->update($request->only(['total_amount', 'status']));

        return response()->json($order);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->orderItems()->delete(); // Delete related order items
        $order->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function getStatus(Order $order)
    {
        return response()->json(['status' => $order->status], Response::HTTP_OK);
    }

    public function cancelOrder(Order $order)
    {
        if($this->orderService->cancelOrder($order)){
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }

        return response()->json($order, Response::HTTP_BAD_REQUEST);
    }
}
