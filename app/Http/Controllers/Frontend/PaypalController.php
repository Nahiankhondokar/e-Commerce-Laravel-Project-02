<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\ProductAttribute;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Termwind\Components\Raw;

class PaypalController extends Controller
{
    // paypal thanks view
    public function ThanksToPaypal(){

        if(Session::has('order_id')){
            // delete all cart item after order is placed
            Cart::where('user_id', Auth::id()) -> delete();
            $orderDetails = Order::where('id', Session::get('order_id')) -> first() -> toArray();
            $nameArr = explode(' ', $orderDetails['name']);
            return view('frontend.paypal.thank_you', compact('orderDetails', 'nameArr'));

             // session delete
             Session::forget('couponCode');
             Session::forget('order_id');
 
        }else {
            return  redirect() -> route('cart.view');
        }
    }



     // paypal success
     public function PaypalSuccess(){

        if(Session::has('order_id')){
            // delete all cart item after order is placed
            Cart::where('user_id', Auth::id()) -> delete();
            return view('frontend.paypal.success');

             // session delete
             Session::forget('grand_total');
             Session::forget('couponAmount');
             Session::forget('couponCode');
             Session::forget('order_id');

 
        }else {
            return  redirect() -> route('cart.view');
        }
    }



    // paypal fail
    public function PaypalFail(){
        return view('frontend.paypal.fail');
    }


    
    // paypal IPN (instant payment notification)
    public function PaypalIPN(Request $request){
        
        $data = $request -> all();
        if($data['payment_status'] == 'Completed'){
            $order_id = Session::get('order_id');
            Order::where('id', $order_id) -> update(['order_status' => 'Paid']);

            // send mail
            $orderDetails = Order::with('order_product') -> where('id', $order_id) -> first() -> toArray();
            $userDetails = User::where('id', $orderDetails['user_id']) -> first() -> toArray();

            // stock reduce
            foreach($orderDetails as $item){
                $getStock = ProductAttribute::where(['product_id' => $item['product_id'], 'size' => $item['size']]) -> first() -> toArray();
                
                // new stock after reduce cart quantity
                $newStock = $getStock['stock'] - $item['quantity'];

                // new stock update
                ProductAttribute::where(['product_id' => $item['product_id'], 'size' => $item['size']]) -> update(['stock' => $newStock]);
            }

            $email = Auth::user() -> email;
            $messageData = [
                'name'              => Auth::user() -> name,
                'email'             => $email,
                'order_id'          => $order_id,
                'userDetails'       => $userDetails,
                'orderDetails'      => $orderDetails
            ];

            // Mail::send('frontend.email.order', $messageData, function($msg) use($email) {
            //     $msg -> to($email) -> subject('Order Placed');
            // });

            // // message
            // $notify = [
            //     'message'       => "Paypal Payment Completed",
            //     'alert-type'    => "success"
            // ];

            // return redirect() -> route('paypal.thanks') -> with($notify);


        }

    }



}
