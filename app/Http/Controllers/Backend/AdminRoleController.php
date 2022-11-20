<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminRoleController extends Controller
{
    // adimin or subadmin page view
    public function AdminSubAmdinView(){
        if(Auth::guard('admin') -> user() -> type == 'admin' || Auth::guard('admin') -> user() -> type == 'superadmin'){
            $allAdmin = Admin::get();
            return view('backend.admin.admin_role') -> with(compact('allAdmin'));
        }else {
            return redirect('admin/dashboard');
        }
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
    

    // product attribuet delete
    public function AdminSubAmdinDelete($id){

        $Admin = Admin::find($id);
        $Admin -> delete();

            // msg
        $notify = [
            'message'       => 'Admin Role Deleted',
            'alert-type'    => "info"
        ];

        return redirect() -> back() -> with($notify);
    
    }



    // admin role edit or add 
    public function AdminSubAmdinAddEdit(Request $request, $id=null){
        // dd($request -> all()); die;


        // indevidual title
        if($id){
            // admin or subadmim edit
            $allData['title'] = 'Edit Admin or Sub-Admin';
            $allData['edit'] = Admin::find($id);
            $adminData = Admin::find($id);
            $message = "Admin Role Updated Successfully";
        }else {
             // admin or subadmim add
            $allData['title'] = 'Add Admin or Sub-Admin';
            $allData['edit'] = '';
            $adminData = new Admin();
            $message = "Admin Role Inserted Successfully";
        }

        // admin or subadmim add or update
        if($request -> isMethod('post')){
            // dd($request -> all());

            // validation
            if($id){
                $request -> validate([
                    'name'          => 'required',
                    'email'         => 'required',
                    'password'      => 'required'
                ]);
            }else {
                $request -> validate([
                    'name'          => 'required',
                    'email'         => 'required',
                    'type'          => 'required',
                    'password'      => 'required'
                ]);
            }

            // email validation 
           if($id == ''){
            $emailCount = Admin::where('email', $request -> email) -> count();
            if($emailCount > 0){
                // msg
                $notify = [
                    'message'       => 'Email is exists',
                    'alert-type'    => "warning"
                ];

                return redirect() -> back() -> with($notify);
            }
           }

            // img upload 
            if($request -> hasFile('photo')){

                $img = $request -> file('photo');
                $unique = md5(time() . rand()) . '.' . $img -> getClientOriginalExtension();
                $img -> move(public_path('media/backend/admin'), $unique);
                // Image::make($unique)->save('media/backend/product/large'); // w:1080 h:1200
                // Image::make($unique)->resize(520, 600)->save('media/backend/product/medium');
                // Image::make($unique)->resize(260, 300)->save('media/backend/product/small');

                @unlink('media/backend/admin/'.$request -> old_img);

            }else {
                $unique = $request -> old_img;
            }

            // admin or subadmim store
            $adminData -> name      = $request -> name;
            $adminData -> phone     = $request -> phone;
            if($id == ''){
                $adminData -> email     = $request -> email;
                $adminData -> type      = $request -> type;
            }
            $adminData -> password  = Hash::make($request -> password);
            $adminData -> profile_photo_path     = $unique ?? '';
            $adminData -> save();

            // msg
            $notify = [
                'message'       => $message,
                'alert-type'    => "success"
            ];

            return redirect() -> route('admin.subadmin.view') -> with($notify);


        }

        // // get all sesction or brand
        // $allData['section'] = CreateSection::with('getCategory') -> get();
        // $allData['brand'] = ProductBrand::where('status', 1) -> get();
        // // $data = json_decode(json_encode($section));
        // // echo "<pre>"; print_r($data);


        // // filter Arrays
        // $allFilters = Product::getAllFilters();

        return view('backend.admin.admin_role_add_edit', $allData);

    }
    

}
