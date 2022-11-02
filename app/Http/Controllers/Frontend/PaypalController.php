<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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



}
