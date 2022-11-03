<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
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
    

}
