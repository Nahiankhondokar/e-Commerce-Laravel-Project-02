<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Wishlist extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    // get wishlist data
    public static function getWishlistData($product_id){
        $wishlistCount = Wishlist::where(['user_id' => Auth::user() -> id, 'product_id' => $product_id]) -> count();

        return $wishlistCount;
    }


    // get user details
    public function getUserDetails(){
        return $this -> belongsTo(User::class, 'user_id');
    }

    // get user details
    public function getProductDetails(){
        return $this -> belongsTo(Product::class, 'product_id');
    }


}
