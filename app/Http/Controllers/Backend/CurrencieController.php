<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Currencie;
use Illuminate\Http\Request;

class CurrencieController extends Controller
{
    // adimin or subadmin page view
    public function CurrencieView(){
        $allCurrencie = Currencie::get();
        return view('backend.currencie.currencie_view') -> with(compact('allCurrencie'));
    }


    // Currencie active or inactive status
    public function CurrencieActiveInactive(Request $request){

        $status_data = Currencie::find($request -> currencie_id);

        if($status_data -> status == 1){
            $update = Currencie::find($request -> currencie_id);
            $update -> status = 0;
            $update -> update();
            return 'inactive';

        }else {
            $update = Currencie::find($request -> currencie_id);
            $update -> status = 1;
            $update -> update();
            return 'active';
        }

    }
}
