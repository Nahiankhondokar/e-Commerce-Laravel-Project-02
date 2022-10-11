<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    // banner view
    public function BannerView () {

        $banner = Banner::all();

        // $data = json_decode(json_encode($product));
        // echo "<pre>"; print_r($data);
        return view('backend.banner.banner_view', compact('banner'));

    }



    // get all banner item & show by ajax
    public function GetAllBanner(){
        $all_banner = Banner::get();
        
        $data = '';
        foreach($all_banner as $key => $item){

            // status chekcing
            if($item -> status == 1){
                $status = 'success';
            }else {
                $status = 'danger';
            }

            // data rendering
            $data .= '<tr>';
            $data .= '<td>'. $key + 1 .'</td>';
            $data .= '<td><img src="/media/backend/banner/'. $item -> image .'" alt="" style="width: 50px"></td>';
            $data .= '<td>'. $item -> title .'</td>';
            $data .= '<td>'. $item -> link .'</td>';
            $data .= '<td>'. $item -> alt .'</td>';
            $data .= '<td>'. ($item -> status == 1 ? '<div class="bannerActiveInactive" id="banner-'. $item -> id .'" banner_id="'. $item -> id .'">
                <a id="banner_active-btn-'. $item -> id .'" class="badge badge-'. $status .'"  href="javascript:void(0)"><i class="fa fa-toggle-on" style="font-size : 20px"></i></a>
            </div>' 
            : 
            '<div class="bannerActiveInactive" id="banner-'. $item -> id .'" banner_id="'. $item -> id .'">
                <a id="banner_inactive-btn-'. $item -> id .'" class="badge badge-'. $status .'"  href="javascript:void(0)"><i class="fa fa-toggle-off" style="font-size : 20px"></i></a>
            </div>').'</td>';
            $data .= '<td>
            '.  
                '<a id="bannerEditBtn" class="btn btn-warning btn-sm" edit_id="'. $item -> id .'" href="#" data-toggle="modal"><i class="fa fa-edit"></i></a> &nbsp;'. 
                '<a id="deleteBanner" class="btn btn-danger btn-sm" delete_id="'. $item -> id .'" href="#"><i class="fa fa-trash"></i></a>' 
            .'
            </td>';
            $data .= '</tr>';
        }

        return $data;
    }


    // Product add or edit
    public function BannerAddEdit ($id=null, Request $request) {


        // img upload 
        if($request -> hasFile('image')){

            $img = $request -> file('image');
            $unique = md5(time() . rand()) . '.' . $img -> getClientOriginalExtension();
            $img -> move(public_path('media/backend/banner'), $unique);

            @unlink('media/backend/banner/'.$request -> old_image);

        }else {
            $unique = $request -> old_image;
        }


        // banner add & update
        if(!empty($request -> update_id)){

            // banner update
            $update = Banner::find($request -> update_id);
            $update -> title    = $request -> tittle;
            $update -> link     = $request -> link;
            $update -> alt      = $request -> alt;
            $update -> image    = $unique;
            $update -> update();

        }else{

            // banner store            
            Banner::insert([
                'title'         => $request -> tittle,
                'link'          => $request -> link,
                'alt'           => $request -> alt,
                'image'         => $unique
            ]);
        }

    }


    // banner active or inactive status
    public function BannerActiveInactive(Request $request){
 
        $status_data = Banner::find($request -> banner_id);

        if($status_data -> status == 1){
            $update = Banner::find($request -> banner_id);
            $update -> status = 0;
            $update -> update();
            return 'inactive';

        }else {
            $update = Banner::find($request -> banner_id);
            $update -> status = 1;
            $update -> update();
            return 'active';
        }

    }
    

    // banner edit data show
    public function BannerEdit($id){

        $edit = Banner::find($id);
        return $edit;

    }


    // banner delete
    public function BannerDelete($id){
    
        $del = Banner::find($id);
        @unlink('media/backend/banner/'.$del -> image);
        $del -> delete();

    }

        
}
