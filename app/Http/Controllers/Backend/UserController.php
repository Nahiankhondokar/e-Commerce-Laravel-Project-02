<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    /**
     *  All user show
     */
    public function getAllUser (){
        $users = User::all();

        return view('backend.user.all_user', compact('users'));
    }


    // user active or inactive status
    public function UserActiveInactive(Request $request){

        $status_data = User::find($request -> user_id);

        if($status_data -> status == 1){
            $update = User::find($request -> user_id);
            $update -> status = 0;
            $update -> update();
            return 'inactive';

        }else {
            $update = User::find($request -> user_id);
            $update -> status = 1;
            $update -> update();
            return 'active';
        }

    }


    // user charts
    public function ViewUserChart(){

        $current_month_user = User::whereYear('created_at', Carbon::now() -> year) -> whereMonth('created_at', Carbon::now() -> month) -> count();
        $last_1_month_user = User::whereYear('created_at', Carbon::now() -> year) -> whereMonth('created_at', Carbon::now() -> subMonth(1)) -> count();
        $last_2_month_user = User::whereYear('created_at', Carbon::now() -> year) -> whereMonth('created_at', Carbon::now() -> subMonth(2)) -> count();
        $last_3_month_user = User::whereYear('created_at', Carbon::now() -> year) -> whereMonth('created_at', Carbon::now() -> subMonth(3)) -> count();

        $userCount = array($current_month_user, $last_1_month_user, $last_2_month_user, $last_3_month_user);

        // dd($current_month_user); die;
        return view('backend.user.view_user_chart', compact('userCount'));
    }
    

}
