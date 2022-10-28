<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    // shipping view
    public function ShippingChargeView(){
        $shippingCharge = ShippingCharge::all() -> toArray();
        return view('backend.shipping.shipping_charge_view', compact('shippingCharge'));
    }

    // shipping edit
    public function ShippingChargeEdit($id){
        $edit = ShippingCharge::find($id);
        $shippingCharge = ShippingCharge::all() -> toArray();
        return view('backend.shipping.shipping_charge_edit', compact('edit', 'shippingCharge'));
    }

    // shipping edit
    public function ShippingChargeUpdate($id, Request $request){
        $update = ShippingCharge::find($id);
        $update -> country = $request -> country;
        $update -> shipping_charge = $request -> shipping_charge;
        $update -> update();

        $msg = [
            'message'       => 'Shipping Details Updated',
            'alert-type'    => "success"
        ];

        return redirect() -> route('shipping.view') -> with($msg);
    }


    
    // shipping charge active or inactive status
    public function ShippingActiveInactive(Request $request){

        $status_data = ShippingCharge::find($request -> shippe_id);

        if($status_data -> status == 1){
            $update = ShippingCharge::find($request -> shippe_id);
            $update -> status = 0;
            $update -> update();
            return 'inactive';

        }else {
            $update = ShippingCharge::find($request -> shippe_id);
            $update -> status = 1;
            $update -> update();
            return 'active';
        }

    }


}
