<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

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



}
