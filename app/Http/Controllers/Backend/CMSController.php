<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CMSPage;
use Illuminate\Http\Request;

class CMSController extends Controller
{
    // cms view
    public function CMSView () {

        $cms = CMSPage::all();
        // $data = json_decode(json_encode($allData));
        // echo "<pre>"; print_r($data);
        return view('backend.cms.cms_view', compact('cms'));

    }




    
    // CMS active or inactive status
    public function CMSActiveInactive(Request $request){

        $status_data = CMSPage::find($request -> CMS_id);

        if($status_data -> status == 1){
            $update = CMSPage::find($request -> CMS_id);
            $update -> status = 0;
            $update -> update();
            return 'inactive';

        }else {
            $update = CMSPage::find($request -> CMS_id);
            $update -> status = 1;
            $update -> update();
            return 'active';
        }

    }


}
