<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\CreateSection;
use App\Models\User;
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


    // coupon Add or Edit
    public function CouponAddOrEdit($id = null, Request $request){

        // edit data or add data checking
        if($id == ''){
            // update data
            $title = "Add Coupon";
            $coupon = new Coupon();
            $msg = "Coupon Inserted Succefully";
            $allCat = [];
            $allUser = [];
            // dd($request -> all()) -> toArray();
        }else {
            // insert data
            $title = "Edit Coupon";
            $coupon = Coupon::find($id);
            $allCat = explode(',', $coupon -> categories);
            // dd($allCat); die;
            $allUser = explode(',', $coupon -> users);
            $msg = "Coupon Updated Succefully";
          
        }

        // mehtod checking
        if($request -> isMethod('post')){

            // dd($request -> coupon_option);
            // validation 
            $this -> validate($request, [
                'coupon_option'         => 'required',
                'expire_date'           => 'required',
                'categories'            => 'required',
                'amount'                => 'required|numeric',
                'amount_type'            => 'required',
                'coupon_type'            => 'required',
            ]);

            // categories
            if(@$request -> categories){
                $allCat = implode(',', $request -> categories);
            }
            // users
            if(@$request -> users){
                $allUser = implode(',', $request -> users);
            }

            // coupon option checking
            if($request -> coupon_option == 'Automatic'){
                $coupon_code = str_random(8);
            }else {
                $coupon_code = $request -> coupon_code;
            }

            // dd($allCat); die;

            $coupon -> coupon_option    = $request -> coupon_option; 
            $coupon -> coupon_code      = $coupon_code; 
            $coupon -> categories       = $allCat; 
            $coupon -> users            = $allUser; 
            $coupon -> coupon_type      = $request -> coupon_type; 
            $coupon -> amount_type      = $request -> amount_type;
            $coupon -> amount           = $request -> amount;
            $coupon -> expire_date      = $request -> expire_date;
            $coupon -> save();

            // msg
            $notify = [
                'message'       => $msg,
                'alert-type'    => "success"
            ];

            return redirect() -> route('coupon.view') -> with($notify);

        }
        
        // get all category
        $allData['section'] = CreateSection::with('getCategory') -> get();
        $allData['users'] = User::where('status', 1) -> get();

        return view('backend.coupon.coupon_add_edit', [
            'title'         => $title,
            'edit_data'     => $coupon,
            'allCat'        => $allCat,
            'allUser'       => $allUser,

        ], $allData);

    }


    // coupon delete
    public function CouponDelete ($id){

        Coupon::find($id) -> delete();

         // msg
         $notify = [
            'message'       => "Coupon Deleted Succefully ",
            'alert-type'    => "info"
        ];

        return redirect() -> route('coupon.view') -> with($notify);
    }

    



}
