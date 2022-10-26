<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // order view
    public function OrderViewAdmin(){
        $order = Order::with('order_product') -> orderBy('id', 'DESC') -> get() -> toArray();
        // dd($order);
        return view('backend.order.order_view', compact('order'));
    }


    
    // order details
    public function OrderDetailsAdmin($id){

        $orderDetails = Order::with('order_product') -> where('id', $id) -> first() -> toArray();
        $userDetails = User::where('id', $orderDetails['user_id']) -> first() -> toArray();
        $orderStatus = OrderStatus::where('status', 1) -> get() -> toArray();

        return view('backend.order.order_details', compact('orderDetails', 'userDetails', 'orderStatus'));
    }


    // order status update
    public function OrderStatusUpdateAdmin(Request $request){

        // dd($request -> order_id); die;
        // status update
        Order::where('id', $request -> order_id) -> update(['order_status' => $request -> status]);

         // msg
        $notify = [
            'message'       => "Order Status UPdated Succefully ",
            'alert-type'    => "info"
        ];

        return redirect() -> back() -> with($notify);

    }


}
