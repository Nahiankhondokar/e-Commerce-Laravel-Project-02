<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    // rating view
    public function RatingView(){
        $ratings = Rating::with(['getUser', 'getProduct']) -> get();
        return view('backend.rating.rating_view', compact('ratings'));
    }


    // rating active or inactive status
    public function RatingActiveInactive(Request $request){

        $status_data = Rating::find($request -> rating_id);

        if($status_data -> status == 1){
            $update = Rating::find($request -> rating_id);
            $update -> status = 0;
            $update -> update();
            return 'inactive';

        }else {
            $update = Rating::find($request -> rating_id);
            $update -> status = 1;
            $update -> update();
            return 'active';
        }

    }


    // add rating
    public function AddRating(Request $request){

        if(!Auth::check()){
            // msg
            $notify = [
                'message'       => "You can not review without login",
                'alert-type'    => "warning"
            ];
            return redirect() -> back() -> with($notify);
        }else {
                // dd($request -> all()); die;
            $user_id = Auth::guard('web') -> user() -> id;
                // dd($user_id);die;

            // rating validation
            $ratings = Rating::where(['user_id' => $user_id, 'product_id' => $request -> product_id]) -> count();
            if($ratings > 0){
                // msg
                $notify = [
                    'message'       => "Your rating already exists for this product",
                    'alert-type'    => "warning"
                ];
                return redirect() -> back() -> with($notify);
            }else {

                // validation
                if(!$request -> rate || !$request -> review){
                    // msg
                    $notify = [
                        'message'       => "Ratign & Reviews are required",
                        'alert-type'    => "error"
                    ];
                    return redirect() -> back() -> with($notify);
                }

                // insert new rating
                Rating::insert([
                    'user_id'       => $user_id,
                    'product_id'    => $request -> product_id,
                    'review'        => $request -> review,
                    'rating'        => $request -> rate
                ]);
    
                // msg
                $notify = [
                    'message'       => "Review is submited",
                    'alert-type'    => "success"
                ];
                return redirect() -> back() -> with($notify);
            }
        }



    }

}
