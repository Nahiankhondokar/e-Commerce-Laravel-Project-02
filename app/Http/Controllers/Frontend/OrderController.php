<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ExchangeProduct;
use App\Models\Order;
use App\Models\OrderLog;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductAttribute;
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

            // return or exchange product functionality
            if($request -> returnOrExchange == 'Return'){
                // get product info
                $product_arr = explode('-', $request -> product_info);
                $product_code = $product_arr[0];
                $product_size = $product_arr[1];

                // cancel order
                OrderProduct::where(['order_id' => $id, 'product_size' => $product_size, 'product_code' => $product_code]) -> update(['return_order_status'=> 'Return Request']);

                // order return update
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
                    'message'       => "Order return is pendding",
                    'alert-type'    => "warning"
                ];
                return redirect() -> back() -> with($notify);

            }else if($request -> returnOrExchange == 'Exchange'){

                // get product info
                $product_arr = explode('-', $request -> product_info);
                $product_code = $product_arr[0];
                $product_size = $product_arr[1];

                // exchange order
                OrderProduct::where(['order_id' => $id, 'product_size' => $product_size, 'product_code' => $product_code]) -> update(['return_order_status'=> 'Exchange Request']);

                // order exchange update
                $exchange = new ExchangeProduct();
                $exchange -> order_id         = $id;
                $exchange -> user_id          = $user_id_auth;
                $exchange -> product_code     = $product_code;
                $exchange -> product_size     =  $product_size;
                $exchange -> required_size    =  $request -> required_size;
                $exchange -> exchange_reason  = $request -> returnReason;
                $exchange -> exchange_status  = "Pendding";
                $exchange -> comment          = $request -> comment;
                $exchange -> save();

                // msg
                $notify = [
                    'message'       => "Order exchange is pendding",
                    'alert-type'    => "warning"
                ];
                return redirect() -> back() -> with($notify);
                
            }else{
                // msg
                $notify = [
                    'message'       => "Invalid request !",
                    'alert-type'    => "error"
                ];
                return redirect() -> back() -> with($notify);
            }
            
        }else {
            // msg
            $notify = [
                'message'       => "Invalid request !",
                'alert-type'    => "error"
            ];
            return redirect() -> back() -> with($notify);
        }



    }

    // get product size for exchange
    public function getProductSizes(Request $request){
        // dd($request -> all()); die;

        // get product info
        $product_arr = explode('-', $request -> product_info);
        $product_code = $product_arr[0];
        $product_size = $product_arr[1];

        // get product id
        $product_id = Product::select('id') -> where('product_code', $product_code) -> first() -> toArray();
        $productId = $product_id['id'];

        //  get product size
        $productSizes = ProductAttribute::select('size') -> where('product_id', $productId) -> where('size', '!=', $product_size) -> where('stock', '>', 0) -> get() -> toArray();

        // show producdt sizes
        $appendSizes = '<option value="" disabled>Select Required Size</option>';
        foreach($productSizes as $key => $item){
            $appendSizes .= '<option value="'.$item["size"].'">'.$item["size"].'</option>';
        }

        return $appendSizes;

    }
}
