<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    // order product table details 
    public function order_product(){
        return $this -> hasMany(OrderProduct::class, 'order_id');
    }


    // order product table details 
    public function order_item(){
        return $this -> hasMany(OrderProduct::class, 'order_id');
    }


    // order status
    public static function getOrderStatus ($order_id){
        $orderStatus = Order::select('order_status') -> where('id', $order_id) -> first();

        return $orderStatus;
    }



}
