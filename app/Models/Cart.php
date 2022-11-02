<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];


    // get cart items
    public static function userCartItems() {
        if(Auth::check()){
            $userCartItems = Cart::with(['getProduct' => function($query){
                $query -> select('id', 'product_name', 'product_code', 'main_image', 'product_color', 'category_id', 'product_weight');
            }]) -> where('user_id', Auth::user() -> id) -> orderBy('id', 'Desc') -> get() -> toArray();
        }else {
            $userCartItems = Cart::with(['getProduct' => function($query){
                $query -> select('id', 'product_name', 'product_code', 'main_image', 'product_color', 'category_id', 'product_weight');
            }]) -> where('session_id', Session::get('session_id')) -> orderBy('id', 'Desc') -> get() -> toArray();
        }
        return $userCartItems;
    }

    // ger product details
    public function getProduct(){
        return $this -> belongsTo(Product::class, 'product_id');
    }


    // ger product price
    public static function getProductPrice($product_id, $size){
        $getProductPrice = ProductAttribute::select('price') -> where(['product_id' => $product_id, 'size' => $size]) -> first() -> toArray();
        return $getProductPrice['price'];
    }

}
