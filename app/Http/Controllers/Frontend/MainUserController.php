<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class MainUserController extends Controller
{

    // user login page view
    public function LoginRegPageView(){
        return view('frontend.user.login');
    }

    // user register 
    public function UserRegister(Request $request){
        
        // email checking
        $email = User::where('email', $request -> email) -> get() -> count();
        // dd($email);
        if(@$email > 0){
            // msg
            $notify = [
                'message'       => 'Email already Exists !',
                'alert-type'    => "error"
            ];

            return redirect() -> back() -> with($notify);
        }else {

            // user store
            User::insert([
                'name'              => $request -> name,
                'email'             => $request -> email,
                'phone'             => $request -> phone,
                'password'          => Hash::make($request -> password)
            ]);

            // msg
            $notify = [
                'message'       => 'Account Created Successfull',
                'alert-type'    => "success"
            ];

            return redirect() -> to('/login') -> with($notify);
        }

    }


    // user login
    public function LoginUser(Request $request){
        // dd($request -> all()) -> toArray();
        if(Auth::attempt(['email' => $request -> email, 'password' => $request -> password])){

            // msg
            $notify = [
                'message'       => 'Account Login Successfull',
                'alert-type'    => "info"
            ];

            return redirect() -> to('/') -> with($notify);
            
        }else {
            // msg
            $notify = [
                'message'       => 'Wrong Email or Password',
                'alert-type'    => "error"
            ];

            return redirect() -> to('/login-register') -> with($notify);
        }

    }


    // user email checking by js validation package
    public function UserEmailCheck(Request $request){

        // email checking
        $emailCount = User::where('email', $request -> email) -> count();
        if($emailCount>0){
            return "false";
        } else {
            return "true";
        }
    }
    

    /**
     *  user logout
     */
    public function Logout(){
        Auth::logout();
        return redirect() -> to('/');
    }


    /**
     *  user profile
     */
    public function UserProfile(){
        
        $id = Auth::user() -> id;
        $user = User::find($id);
        return view('frontend.user.user_profile', compact('user'));

    }

    /**
     *  user profile edit
     */
    public function UserProfileEdit($id){
       
        $user = User::find($id);
        return view('frontend.user.user_profile_edit', compact('user'));

    }

    /**
     *  user profile update
     */
    public function UserProfileUpdate($id, Request $request){
       
        // user photo
        if($request -> hasFile('image')){
            $img = $request -> file('image');
            $unique = md5(time() . rand()) . '.' . $img -> getClientOriginalExtension();
            $img -> move(public_path('media/frontend'), $unique);

            // image delete
            if(file_exists('media/frontend/' . $request -> old_image)){
                unlink('media/frontend/'. $request -> old_image);
            }

        }else {
            $unique = $request -> old_image;
        }

        // user updated
        $user = User::find($id);
        $user -> name               = $request -> name;
        $user -> email              = $request -> email;
        $user -> profile_photo_path = $unique;
        $user -> update();
        

        // toster msg
        $notify = [
            'message'   => "User profile updated",
            'alert-type'=> "info"
        ];

        return redirect() -> route('user.profile') -> with($notify);

    }


    /**
     *  user password view
     */
    public function PasswordChange(){

        $id = Auth::user() -> id;
        $user = User::find($id);
        return view('frontend.user.password_change', [
            "user"  => $user
        ]);
    }

    /**
     *  user password update
     */
    public function PasswordUpdate(Request $request){

        // validaiton
        $this -> validate($request, [
            'old_pass'      => 'required'
        ], [
            "old_pass.required"   => "Password Feild is require"
        ]);

        // checking password
        if($request -> new_pass != $request -> password_confirmation){
            // toster msg
            $msg = [
                'message'   => "Wrong Password",
                'alert-type'=> "error"
            ];
            return redirect() -> back() -> with($msg);
        }
        
        // find user
        $hasPass = Auth::user() -> password;

        // password hash
        if(Hash::check($request -> old_pass, $hasPass)){

            // user find 
            $user = User::find(Auth::id());

            // user password updated
            $user -> password  = Hash::make($request -> new_pass);
            $user -> update();
            Auth::logout();
            return redirect() -> route('login');
        
        }else {

            // toster msg
            $msg = [
                'message'   => "Wrong Password",
                'alert-type'=> "error"
            ];
            return redirect() -> back() -> with($msg);
        }
       
        
    }


    //     /**
    //  *  user logout
    //  */
    // public function Logout(){
    //     Auth::logout();
    //     return redirect() -> route('login');
    // }


}
