<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderItemController extends Controller
{
    public function index()
    {
        $orderItems = OrderItem::with('product')->get();
        return response()->json($orderItems);
    }

    public function store(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->failed();
        }

        $orderItem = OrderItem::create($request->all());

        return response()->json($orderItem, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $orderItem = OrderItem::with('product')->findOrFail($id);
        return response()->json($orderItem);
    }

    public function update(Request $request, $id)
    {

        $validatedData = Validator::make($request->all(), [
            'quantity' => 'nullable|integer',
            'price' => 'nullable|numeric',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->failed();
        }

        $orderItem = OrderItem::findOrFail($id);
        $orderItem->update($request->all());

        return response()->json($orderItem);
    }

    public function destroy($id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
