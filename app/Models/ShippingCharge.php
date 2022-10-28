<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCharge extends Model
{
    use HasFactory;
    
    protected $guarded = [];


    // get shipping charge
    public static function getShippingCharge($country) {
        $shippingCharge = ShippingCharge::where('country', $country) -> first() -> toArray();
        return $shippingCharge['shipping_charge'];
    }

}
