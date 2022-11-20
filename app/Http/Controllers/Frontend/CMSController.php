<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CMSPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

class CMSController extends Controller
{
    // cms view page
    public function CMSPageView(){

        // get curretn uri
        $currentRoute = Route::getFacadeRoot() -> current() -> uri();
        // url() -> current(); // get Full url
        // echo $currentRoute;

        $csmPage = CMSPage::where(['url' => $currentRoute, 'status' => 1]) -> first();

        // seo items & page title
        $meta_title = $csmPage -> title;
        $meta_description = $csmPage -> meta_desc;
        $meta_keywords = $csmPage -> meta_keyword;

        return view('frontend.cms.cms_view', compact('meta_title', 'meta_description', 'meta_keywords', 'csmPage'));

    }


    // cms contact view page
    public function ContactPage(Request $request){

        if($request -> isMethod('post')){
            $allData = $request -> all();
            // dd($allData); die;

            // validaiton
            $this->validate($request, [
                'name'      => 'required',
                'message'   => 'required'
            ]);

            $adminEmail = 'emaildefaultemail@gmail.com';
            // user question for admin
            $messageData = [
                'name'      => $allData['name'],
                'email'     => $allData['email'],
                'subject'   => $allData['subject'],
                'comment'   => $allData['message']
            ];

            // send mail to admin
            Mail::send('frontend.email.contact_page', $messageData,  function($message) use($adminEmail){
                $message -> to($adminEmail) -> subject('Question From Contact Page');
            });

             // msg  
             $notify = [
                'message'       => 'Message Sent Successfully',
                'alert-type'    => "info"
            ];

            return redirect() -> back() -> with($notify);

        }

        return view('frontend.cms.contact_page');

    }


}
