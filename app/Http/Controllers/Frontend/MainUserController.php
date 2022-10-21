<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

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


            // send mail to user for account activate
            $email = $request -> email;
            $message = [
                'name'      => $request -> name,
                'email'      => $request -> email,
                'phone'      => $request -> phone,
                'code'       => base64_encode($request -> email)
            ];
            Mail::send('frontend.email.confirmation', $message, function($msg) use($email){
                $msg->to($email)-> subject('Welcome to E-commerce website');
            });


            // msg
            $notify = [
                'message'       => 'Account Created, Please Activate Your Account. Check Your Email',
                'alert-type'    => "warning"
            ];

            return redirect() -> to('/login') -> with($notify);
        }

    }


    // user account activate
    public function UserAccountActivate($email){

        $email = base64_decode($email);

        // email check
        $userCount = User::where('email', $email) -> count();
        if($userCount > 0){

            $userDetails = User::where('email', $email) -> first();
            if($userDetails -> status == true){
                // msg
                $notify = [
                    'message'       => 'Account Already Activated, Please Login',
                    'alert-type'    => "warning"
                ];

                return redirect() -> to('/login') -> with($notify);
            }else {

                // user account acctivate
                User::where('email', $email) -> update(['status' => 1]);

                // send mail to user for account activate
                $email = $userDetails -> email;
                $message = [
                    'name'      => $userDetails -> name,
                    'email'      => $userDetails -> email,
                    'phone'      => $userDetails -> phone
                ];
                Mail::send('frontend.email.register', $message, function($msg) use($email){
                    $msg->to($email)-> subject('Welcome to E-commerce website');
                });

                // msg
                $notify = [
                    'message'       => 'Your Account Activated, Please Login',
                    'alert-type'    => "success"
                ];

                return redirect() -> to('/login') -> with($notify);
            }
            
        } else {
            abort(404);
        }

    }


    // user login
    public function LoginUser(Request $request){
        // dd($request -> all()) -> toArray();
        if(Auth::attempt(['email' => $request -> email, 'password' => $request -> password])){

            // account activation checking
            $userStateus = User::where('email', $request -> email) -> first();
            if($userStateus -> status == false){

                Auth::logout();

                // msg
                $notify = [
                    'message'       => 'Please Activate Your Account',
                    'alert-type'    => "warning"
                ];

                return redirect() -> to('/login') -> with($notify);
            }

            // cart product checking
            if(!empty(Session::get('session_id'))){

                $session_id = Session::get('session_id');
                $user_id = Auth::user() -> id;

                Cart::where(['session_id' => $session_id]) -> update(['user_id' => $user_id]);
            }

            // msg
            $notify = [
                'message'       => 'Account Login Successfull',
                'alert-type'    => "info"
            ];

            return redirect() -> to('/cart') -> with($notify);
            
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


    // user forgot password
    public function UserForgotPassword(Request $request){

        if($request -> isMethod('post')){

            // email check
            $userCount = User::where('email', $request -> email) -> count();
            if($userCount > 0){

                // create random password & update
                $random_pass = str_random(8);
                User::where('email', $request -> email) -> update(['password' => Hash::make($random_pass)]);

                // send mail to user with new password
                $userInfo = User::select('name') -> where('email', $request -> email) -> first();
                $email = $request -> email;
                $message = [
                    'name'      => $userInfo -> name,
                    'email'     => $request -> email,
                    'password'  => $random_pass,
                ];
                Mail::send('frontend.email.forgot_password', $message, function($msg) use($email){
                    $msg -> to($email) -> subject('New Password');
                });

                // confirm massage
                $notify = [
                    'message'       => 'New Password Sent To Your Email',
                    'alert-type'    => "success"
                ];

                return redirect() -> back() -> with($notify);


            }else {
                $notify = [
                    'message'       => 'Email Does not Exists',
                    'alert-type'    => "error"
                ];

                return redirect() -> to('/forgot-password') -> with($notify);
            }

        }
        return view('frontend.forgot_password.forgot_password');

    }



    // user details insert
    public function UserInsertDetails(Request $request){

        // user deatils 
        $user_id = Auth::user() -> id;
        $userDetails = User::find($user_id);

        if($request -> isMethod('post')){
            // dd($request -> all()) -> toArray();

            $update = User::find($user_id);
            $update -> name         = $request -> name;
            $update -> phone        = $request -> phone;
            $update -> country      = $request -> country;
            $update -> city         = $request -> city;
            $update -> address      = $request -> address;
            $update -> pincode      = $request -> pincode;
            $update -> update();


            // msg
            $notify = [
                'message'       => 'Contact Details Updated',
                'alert-type'    => "success"
            ];

            return redirect() -> back() -> with($notify);

        }

        return view('frontend.user.my_account', compact('userDetails'));

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
