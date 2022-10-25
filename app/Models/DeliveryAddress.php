<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DeliveryAddress extends Model
{
    use HasFactory;

    protected $guarded = [];

    // get all delivery address 
    public static function getDeliveryAddress(){
        $user_id = Auth::id();
        $deliveryAddress = DeliveryAddress::where('user_id', $user_id) -> get() -> toArray();

        return $deliveryAddress;
    }
    
}
