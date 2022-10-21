<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

function totalCartItem(){
    if(Auth::check()){
        $user_id = Auth::id();
        $totalCartItem = Cart::where('user_id', $user_id) -> sum('quantity');
    }else {
        $session_id = Session::get('session_id');
        $totalCartItem = Cart::where('session_id', $session_id) -> sum('quantity');
    }

    return $totalCartItem;
}

?>