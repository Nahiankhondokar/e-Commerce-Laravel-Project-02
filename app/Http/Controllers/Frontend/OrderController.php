<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderLog;
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
    public function OrderDetails($id){

        $orderDetails = Order::with('order_product') -> where('user_id', Auth::user() -> id) -> where('id', $id) -> first() -> toArray();
        return view('frontend.order.order_details', compact('orderDetails'));
    }

    // order cancel
    public function OrderCancel($id, Request $request){
            // dd($request -> all()); die;

        // validaiton 
        if($request -> reason == ''){
            // msg
            $notify = [
                'message'       => "Order Cancel Reason Is Required !",
                'alert-type'    => "error"
            ];
            return redirect() -> back() -> with($notify);
        }

        // get logged in user id from Auth
        $user_id_auth = Auth::user() -> id;

        // get user id from order table
        $user_id_order_table = Order::select('user_id') -> where('id', $id) -> first(); 
    

        // validation or update data
        if($user_id_auth == $user_id_order_table -> user_id){
            // cancel order
            Order::where(['id' => $id]) -> update(['order_status'=> 'Cancel']);

            // order log update
            $order = new OrderLog();
            $order -> order_id      = $id;
            $order -> order_status  = 'Cancel';
            $order -> reason        = $request -> reason;
            $order -> updated_by    = "User";
            $order -> save();

            // msg
            $notify = [
                'message'       => "Order cancelled successfully",
                'alert-type'    => "success"
            ];
            return redirect() -> back() -> with($notify);
        }else {
            // msg
            $notify = [
                'message'       => "Invalid request !",
                'alert-type'    => "error"
            ];
            return redirect() -> back() -> with($notify);
        }

    }
}
