<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\NewsletterSubcriber;
use Illuminate\Http\Request;

class NewsletterSubscriberController extends Controller
{
    // subscriber email add
    public function SubscriberEmailView(){
        
        $subscriber = NewsletterSubcriber::where('status', 1) -> get();
        return view('backend.newsletter.newsletter_view', compact('subscriber'));

    }


    // subscriber active or inactive status
    public function SubscriberActiveInactive(Request $request){

        $status_data = NewsletterSubcriber::find($request -> subscriber_id);

        if($status_data -> status == 1){
            $update = NewsletterSubcriber::find($request -> subscriber_id);
            $update -> status = 0;
            $update -> update();
            return 'inactive';

        }else {
            $update = NewsletterSubcriber::find($request -> subscriber_id);
            $update -> status = 1;
            $update -> update();
            return 'active';
        }

    }



    // Currencie Delete
    public function SubscriberDelete ($id) {

        NewsletterSubcriber::find($id) -> delete();

        // msg
        $notify = [
            'message'       => 'Subscriber Deleted',
            'alert-type'    => "info"
        ];

        return redirect() -> back() -> with($notify);
    }

}
