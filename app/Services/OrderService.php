<?php

namespace App\Services;

use App\Http\Controllers\Api\OrderController;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderService
{

    public function calculateTotalAmount(Request $request){
        $totalAmount = 0;
        foreach ($request->input('order_items') as $item) {
            $product = Product::findOrFail($item['product_id']);

            $totalAmount += $item['quantity'] * $product['price'];
        }

        $request['total_amount'] = $totalAmount;

        return $request;
    }

    public function cancelOrder(Order $order){
        $order->status = 'cancelled';
        return $order->save();
    }


}
