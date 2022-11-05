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


    // CMS Page Add & Edit
    public function CMSPageAddEdit($id=null, Request $request){

        // checking add or edit
        if(!$id){
            // cms page add
            $title = 'Add CMS Page';
            $cmsPage = new CMSPage();
            $msg = "CMS Page Added Successful";
            $edit_data = '';
        }else {
            // cms page edit
            $title = 'Edit CMS Page';
            $cmsPage = CMSPage::find($id);
            $edit_data = CMSPage::find($id);
            $msg = "CMS Page Updated Successful";
        }

        // request method checking
        if($request -> isMethod('post')){

            // validation
            $this -> validate($request, [
                'title'         => 'required',
                'desc'          => 'required',
                'url'           => 'required'
            ]);

            // data insert
            $cmsPage -> title       = $request -> title;
            $cmsPage -> desc        = $request -> desc;
            $cmsPage -> url         = $request -> url;
            $cmsPage -> meta_desc   = $request -> meta_desc;
            $cmsPage -> meta_keyword = $request -> meta_keyword;
            $cmsPage -> meta_title  = $request -> titlemeta_title;
            $cmsPage -> save();


            // msg
            $notify = [
                'message'       => $msg,
                'alert-type'    => "success"
            ];

            return redirect() -> route('cms.view') -> with($notify);

        }

        return view('backend.cms.add_edit_cms', [
            'edit_data'     => $edit_data,
            'title'         => $title,
        ]);
    }


    // cms view
    public function CMSPageDelete ($id) {

        CMSPage::find($id) -> delete();

        // msg
        $notify = [
            'message'       => 'CMS Page Deleted',
            'alert-type'    => "info"
        ];

        return redirect() -> back() -> with($notify);
    }


}
