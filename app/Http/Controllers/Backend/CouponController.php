<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AdminRole;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\CreateSection;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CouponController extends Controller
{
    // categroy view
    public function CouponView () {

        $coupon = Coupon::all();
        // $data = json_decode(json_encode($allData));
        // echo "<pre>"; print_r($data);

        // admin coupon permission
        $couponPermission = AdminRole::where(['admin_id' => Auth::guard('admin') -> user() -> id, 'module' => 'coupon']) -> count(); 
        // dd($catPermission); die;
        if(Auth::guard('admin') -> user() -> type == 'superadmin'){
            $couponModule['view_access'] = 1;
            $couponModule['edit_access'] = 1;
            $couponModule['full_access'] = 1;
        }else if($couponPermission == 0){
            // msg
            $notify = [
                'message'       => "You Can not Access Coupon",
                'alert-type'    => "error"
            ];
            return redirect() -> back() -> with($notify);
        }else {
            $couponModule = AdminRole::where(['admin_id' => Auth::guard('admin') -> user() -> id, 'module' => 'coupon']) -> first() -> toArray(); 
        }
        return view('backend.coupon.coupon_view', compact('coupon', 'couponModule'));

    }



    // coupon active or inactive status
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

    
    // coupon apply
    public function CouponApply (Request $request){

        // coupon check
        $couponCount = Coupon::where('coupon_code', $request -> code) -> count();
        $userCartItems = Cart::userCartItems();
        $totalCartItem = totalCartItem();

        if($couponCount == 0){
            // Session forget
            Session::forget('couponCode');
            Session::forget('couponAmount');

            $total_amount = 0;

            foreach($userCartItems as $key => $item){

                // get total amount
                $atttrPrice = Product::getAttrDiscountPrice($item['product_id'], $item['size']);
                $total_amount = $total_amount + ($atttrPrice['attrDiscountPrice'] * $item['quantity']);
                // dd($total_amount);

            }
            

            // invalid couppon
            return response() -> json([
                'status'        => false,
                'message'        => 'Invalid Coupon',
                'totalAmount'    => $total_amount,
                'totalCartItem'  => $totalCartItem,
                'view'          => (String)View::make('frontend.product.cart_view')->with(compact('userCartItems'))
            ]);

        }else{

            $couponDetails = Coupon::where('coupon_code', $request -> code) -> first();
            // coupon active or inactive checking
            if($couponDetails -> status == false){
                $message = 'Coupon is not active';
            }

            // coupon expire date checking
            $expire = $couponDetails -> expire_date;
            $current = date('Y-m-d');
            if($current > $expire){
                $message = 'Coupon is expired';
            }

            // get all cart product
            $userCartItems = Cart::userCartItems(); // dd($userCartItems) -> toArray(); die; 

            // product checking with coupon or without coupon
            $catArr = explode(',', $couponDetails -> categories); 
            // coupon checking for user
            if(!empty($couponDetails -> users)){
                $userArr = explode(',', $couponDetails -> users);
                        
                // valid user checking for coupon
                foreach($userArr as $key => $item){
                    $getUserId = User::select('id') -> where('email', $item) -> first();
                    $userID[] = $getUserId -> id;
                }
            }

            // get total amount
            $total_amount = 0;

            foreach($userCartItems as $key => $item){
                // product checking with coupon or without coupon
                if(!in_array($item['get_product']['category_id'], $catArr)){
                    $message = "Coupon is not valid for this product";
                }
                 // coupon checking for user
                if(!empty($couponDetails -> users)){
                    if(!in_array($item['user_id'], $userID)){
                        $message = "Coupon is not valid for this user";
                    }
                }

                // get total amount
                $atttrPrice = Product::getAttrDiscountPrice($item['product_id'], $item['size']);
                $total_amount = $total_amount + ($atttrPrice['attrDiscountPrice'] * $item['quantity']);
                // dd($total_amount);

            }

            // single or multipel coupon status checking
            // if($couponDetails -> coupon_type == 'Single'){
            //     // checking this coupon already applied or not in order table
            //     $couponCount = Order::where('coupon_code', $request -> code) -> where('user_id', Auth::user() -> id) -> count();

            //     if($couponCount > 0){
            //        $message = "You have used this coupon";
            //     }
            // }


            // common error message return 
            if(@$message){
                $userCartItems = Cart::userCartItems();
                $totalCartItem = totalCartItem();
                return response() -> json([
                    'status'            => false,
                    'message'           => $message,
                    'totalCartItem'     => $totalCartItem,
                    'view'              => (String)View::make('frontend.product.cart_view')->with(compact('userCartItems'))
                ]);
            }else {

                // coupno discount amount
                if($couponDetails -> amount_type == 'Fixed'){
                    $couponAmount = $couponDetails -> amount;
                }else {
                    $couponAmount = $total_amount * ($couponDetails -> amount/100);
                }
                $totalAmountAfterCouponDiscount = $total_amount - $couponAmount;

                // dd($couponAmount);

                // make session for coupon
                Session::put('couponAmount', $couponAmount);
                Session::put('couponCode', $request -> code);

                // data
                $userCartItems = Cart::userCartItems();
                $totalCartItem = totalCartItem();

                return response() -> json([
                    'status'            => true,
                    'message'           => 'Coupon Added Successfully',
                    'couponDiscount'    =>  $couponAmount,
                    'AfterCouponDiscount' => $totalAmountAfterCouponDiscount,
                    'totalCartItem'     => $totalCartItem,
                    'view'              => (String)View::make('frontend.product.append_cart_item')->with(compact('userCartItems'))
                ]);

            }

        }


        //  // msg
        //  $notify = [
        //     'message'       => "Coupon Deleted Succefully ",
        //     'alert-type'    => "info"
        // ];

        // return redirect() -> route('coupon.view') -> with($notify);
    }



}
