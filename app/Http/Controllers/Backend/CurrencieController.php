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


    // Currencie Add & Edit
    public function CurrencieAddEdit($id=null, Request $request){

        // checking add or edit
        if(!$id){
            // cms page add
            $title = 'Add Currencie';
            $currencie = new Currencie();
            $msg = "Currencie Added Successful";
            $edit_data = '';
        }else {
            // cms page edit
            $title = 'Edit Currencie';
            $currencie = Currencie::find($id);
            $edit_data = Currencie::find($id);
            $msg = "Currencie Updated Successful";
        }

        // request method checking
        if($request -> isMethod('post')){
            // dd($request -> all()); die;
            
            // validation
            $this -> validate($request, [
                'currnecie_code'   => 'required',
                'currnecie_rate'   => 'required'
            ]);

            // data insert
            $currencie -> currnecie_code      = $request -> currnecie_code;
            $currencie -> currnecie_rate      = $request -> currnecie_rate;
            $currencie -> save();


            // msg
            $notify = [
                'message'       => $msg,
                'alert-type'    => "success"
            ];

            return redirect() -> route('currencie.view') -> with($notify);

        }

        return view('backend.currencie.currencie_add_edit', [
            'edit_data'     => $edit_data,
            'title'         => $title,
        ]);
    }

}
