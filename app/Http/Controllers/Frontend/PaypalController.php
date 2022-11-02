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
            // Cart::where('user_id', Auth::id()) -> delete();
            $orderDetails = Order::where('id', Session::get('order_id')) -> first() -> toArray();
            $nameArr = explode(' ', $orderDetails['name']);

                
            $orderDetails = Order::with('order_product') -> where('id', Session::get('order_id')) -> first() -> toArray();
            $userDetails = User::where('id', $orderDetails['user_id']) -> first() -> toArray();

            $email = Auth::user() -> email;


            return view('frontend.paypal.thank_you', compact('orderDetails', 'nameArr'));

             // session delete
             Session::forget('grand_total');
             Session::forget('couponAmount');
             Session::forget('couponCode');
             Session::forget('order_id');
 
        }else {
            return  redirect() -> route('cart.view');
        }
    }
}
