<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderLog;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        $orderLog = OrderLog::where('order_id', $id) -> orderBy('id', 'DESC') -> get() -> toArray();

        // dd($orderLog) -> toArray();

        return view('backend.order.order_details', compact('orderDetails', 'userDetails', 'orderStatus', 'orderLog'));
    }


    // order status update
    public function OrderStatusUpdateAdmin(Request $request){

        // dd($request -> order_id); die;
        // status update
        Order::where('id', $request -> order_id) -> update(['order_status' => $request -> status]);

        // order couiere or traking no udpate
        $update = Order::find($request -> order_id);
        $update -> courier_name = $request -> courier_name;
        $update -> traking_number = $request -> traking_number;
        $update -> update();

        
        // **send main to customer
        // $orderDetails = Order::find($request -> order_id);
        // $email = $orderDetails -> email; 
        // $messageData = [
        //     'name'      => $orderDetails -> name,
        //     'email'      => $email,
        //     'status'     => $request -> status
        // ];

        // Mail::send('frontend.email.status', $messageData, function($msg) use($email) {
        //     $msg -> to($email) -> subject('Order Placed');
        // });


        // order status update report
        $log = new OrderLog();
        $log -> order_id        = $request -> order_id;
        $log -> order_status    = $request -> status;
        $log -> save();

         // msg
        $notify = [
            'message'       => "Order Status UPdated Succefully ",
            'alert-type'    => "info"
        ];

        return redirect() -> back() -> with($notify);

    }


}
