<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    // categroy view
    public function CouponView () {

        $coupon = Coupon::all();
        // $data = json_decode(json_encode($allData));
        // echo "<pre>"; print_r($data);
        return view('backend.coupon.coupon_view', compact('coupon'));

    }



    // banner active or inactive status
    public function CouponActiveInactive(Request $request){

        $status_data = Coupon::find($request -> coupon_id);

        if($status_data -> status == 1){
            $update = Coupon::find($request -> coupon_id);
            $update -> status = 0;
            $update -> update();
            return 'inactive';

        }else {
            $update = Coupon::find($request -> coupon_id);
            $update -> status = 1;
            $update -> update();
            return 'active';
        }

    

    }




}
