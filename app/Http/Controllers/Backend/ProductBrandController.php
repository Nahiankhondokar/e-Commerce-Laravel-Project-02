<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ProductBrand;
use Illuminate\Http\Request;

class ProductBrandController extends Controller
{
    // Product view
    public function BrandView () {

        $brand = ProductBrand::all();

        // $data = json_decode(json_encode($product));
        // echo "<pre>"; print_r($data);
        return view('backend.brand.product_brand_view', compact('brand'));

    }


    // product brand edit data show
    public function ProductBrandEdit($id){

        $edit = ProductBrand::find($id);
        return $edit;

    }


    // Product add or edit
    public function BrandAddEdit ($id=null, Request $request) {

        if(!empty($request -> edit_id)){

            $update = ProductBrand::find($request -> edit_id);
            $update -> name = $request -> brand;
            $update -> update();

        }else{
            ProductBrand::insert([
                'name'      => $request -> brand
            ]);
        }

    }


    // get all brand item & show by ajax
    public function GetAllProductBrand(){
        $all_brands = ProductBrand::get();
        
        $data = '';
        foreach($all_brands as $key => $item){

            // status chekcing
            if($item -> status == 1){
                $status = 'success';
            }else {
                $status = 'danger';
            }

            // data rendering
            $data .= '<tr>';
            $data .= '<td>'. $key + 1 .'</td>';
            $data .= '<td>'. $item -> name .'</td>';
            $data .= '<td>'. ($item -> status == 1 ? '<div class="brandActiveInactive" id="brand-'. $item -> id .'" brand_id="'. $item -> id .'">
                <a id="brand_active-btn-'. $item -> id .'" class="badge badge-'. $status .'"  href="javascript:void(0)"><i class="fa fa-toggle-on" style="font-size : 20px"></i></a>
            </div>' : '<div class="brandActiveInactive" id="brand-'. $status .'" brand_id="'. $item -> id .'">
                <a id="brand_inactive-btn-'. $item -> id .'" class="badge badge-'. $status .'"  href="javascript:void(0)"><i class="fa fa-toggle-off" style="font-size : 20px"></i></a>
            </div>').'</td>';
            $data .= '<td>
            '.  
                '<a id="productBrandEditBtn" class="btn btn-warning btn-sm" edit_id="'. $item -> id .'" href="#" data-toggle="modal"><i class="fa fa-edit"></i></a> &nbsp;'. 
                '<a id="deleteBrand" class="btn btn-danger btn-sm"  delete_id="'. $item -> id .'" href="#"><i class="fa fa-trash"></i></a>' 
            .'
            </td>';
            $data .= '</tr>';
        }

        return $data;
    }


    // Product brand active or inactive status
    public function ProductBrandActiveInactive(Request $request){

        $status_data = ProductBrand::find($request -> brand_id);

        if($status_data -> status == 1){
            $update = ProductBrand::find($request -> brand_id);
            $update -> status = 0;
            $update -> update();
            return 'inactive';

        }else {
            $update = ProductBrand::find($request -> brand_id);
            $update -> status = 1;
            $update -> update();
            return 'active';
        }

    }

    
    // product brand delete
    public function ProductBrandDelete($id){
        
        ProductBrand::find($id) -> delete();

    }


    // '<a id="brand_active-btn-'. $item -> id .'" class="badge badge-'.$status.'" href="javascript:void(0)">'. ($item -> status == 1) ? 'Active' : 'Inactive' .'</a>'





    // // msg
    // $notify = [
    //     'message'       => 'Brand Added',
    //     'alert-type'    => "success"
    // ];

    // return redirect() -> route('product.view') -> with($notify);

}
