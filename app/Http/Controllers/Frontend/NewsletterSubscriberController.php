<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubcriber;
use Illuminate\Http\Request;

class NewsletterSubscriberController extends Controller
{
    // subscriber email add
    public function SubscriberEmailAdd(Request $request){
        
        if($request -> ajax()){
            $emailCheck = NewsletterSubcriber::where('email', $request -> subscriber_email) -> count();

            if($emailCheck > 0){
                return 'exists';
            }else {
                $subscriber = new NewsletterSubcriber();
                $subscriber -> email = $request -> subscriber_email;
                $subscriber -> save();

                return 'add';
            }
        }

    }
}
