<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderLog;
use App\Models\OrderProduct;
use App\Models\ReturnProduct;
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


    // order return
    public function OrderReturn($id, Request $request){
        // dd($request -> all()); die;

        // validaiton 
        if(!$request -> product_info || !$request -> returnReason){
            // msg
            $notify = [
                'message'       => "Product info & Reason are required!",
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

            // get product info
            $product_arr = explode('-', $request -> product_info);
            $product_code = $product_arr[0];
            $product_size = $product_arr[1];

            // cancel order
            OrderProduct::where(['order_id' => $id, 'product_size' => $product_size, 'product_code' => $product_code]) -> update(['return_order_status'=> 'Return Request']);

            // order log update
            $return = new ReturnProduct();
            $return -> order_id         = $id;
            $return -> user_id          = $user_id_auth;
            $return -> product_code     = $product_code;
            $return -> product_size     =  $product_size;
            $return -> return_reason    = $request -> returnReason;
            $return -> return_status    = "Pendding";
            $return -> comment          = $request -> comment;
            $return -> save();

            // msg
            $notify = [
                'message'       => "Order return pendding",
                'alert-type'    => "warning"
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
