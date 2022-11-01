<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCharge extends Model
{
    use HasFactory;
    
    protected $guarded = [];


    // get shipping charge
    public static function getShippingCharge($weight, $country) {
        // get shipping details
        $shippingCharge = ShippingCharge::where('country', $country) -> first() -> toArray();

        // weight calculation 
        if($weight <= 500){
            return $shippingCharge['0_500g'];
        }else if($weight <= 1000){
            return $shippingCharge['501_1000g'];
        }else if($weight <= 2000){
            return $shippingCharge['1001_2000g'];
        }else if($weight <= 5000){
            return $shippingCharge['1001_2000g'];
        }else if($weight > 5000){
            return $shippingCharge['above_5000g'];
        }else {
            return $shippingCharge = 0;
        }

        
    }

}
