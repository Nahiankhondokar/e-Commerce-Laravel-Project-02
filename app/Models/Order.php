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

    /**
     * third party will deliver customer product from your store
     * api details of shiprocket
     */
    public function push_order($order_id){
        $order_details = Order::with('order_item') -> where('id', $order_id) -> first() -> toArray();
        // dd($order_details); die;

    }


}
