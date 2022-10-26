<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // order view
    public function OrderView(){
        $order = Order::with('order_product') -> where('user_id', Auth::user() -> id) -> orderBy('id', 'DESC') -> get() -> toArray();
        // dd($order);
        return view('frontend.order.order_view', compact('order'));
    }

    // order details
    public function OrderDetails(){

        $orderDetails = Order::with('order_product') -> where('user_id', Auth::user() -> id) -> first() -> toArray();
        return view('frontend.order.order_details', compact('orderDetails'));
    }
}
