<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminRoleController extends Controller
{
    // adimin or subadmin page view
    public function AdminSubAmdinView(){
        $allAdmin = Admin::get();
        return view('backend.admin.admin_role') -> with(compact('allAdmin'));
    }



    // admin or subadmin active or inactive status
    public function AdminSubAmdinActiveInactive(Request $request){

        $status_data = Admin::find($request -> admin_id);

        if($status_data -> status == 1){
            $update = Admin::find($request -> admin_id);
            $update -> status = 0;
            $update -> update();
            return 'inactive';

        }else {
            $update = Admin::find($request -> admin_id);
            $update -> status = 1;
            $update -> update();
            return 'active';
        }

    }


}
