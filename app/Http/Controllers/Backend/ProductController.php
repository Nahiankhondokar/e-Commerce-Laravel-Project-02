<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CreateSection;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    // Product view
    public function ProductView () {

        $product = Product::with(['getCategory' => function($query){
            $query -> select('id', 'category_name');
        }, 'getSection']) -> get();

        // $data = json_decode(json_encode($product));
        // echo "<pre>"; print_r($data);
        return view('backend.product.product_view', compact('product'));

    }


    
    // Product active or inactive status
    public function ProductActiveInactive(Request $request){

        $status_data = Product::find($request -> product_id);

        if($status_data -> status == 1){
            $update = Product::find($request -> product_id);
            $update -> status = 0;
            $update -> update();
            return 'inactive';

        }else {
            $update = Product::find($request -> product_id);
            $update -> status = 1;
            $update -> update();
            return 'active';
        }

    }

    // product add 
    public function ProductAddOrEdit(Request $request, $id=null){
 
        
        // indevidual title
        if($id){
            $allData['title'] = 'Edit Product';
        }else {
            $allData['title'] = 'Add Product';
            $product = new Product();
        }


        if($request -> isMethod('post')){
            // dd($request -> all());

            // validation
            $request -> validate([
                'product_name'      => 'required|regex:/^[\pL\s\-]+$/',
                'product_code'      => 'required|regex:/^[a-zA-Z0-9_-]*$/',
                'category_id'       => 'required',
                'product_price'     => 'required|numeric',
                'product_weight'    => 'required|regex:/^[0-9]*$/'
            ], [
                'product_name.required'         => 'Product Name is required',
                'category_id.required'          => 'Category is required',
                'product_weight.required'       => 'Product Weight is not correct',
            ]);


            // img upload 
            if($request -> hasFile('main_image')){

                $img = $request -> file('main_image');
                $unique = md5(time() . rand()) . '.' . $img -> getClientOriginalExtension();
                $img -> move(public_path('media/backend/product'), $unique);

            }

            // product store
            $cat_details = Category::find($request -> category_id);
            $product -> product_name    = $request -> product_name;
            $product -> category_id     = $request -> category_id;
            $product -> section_id      = $cat_details -> section_id;
            $product -> product_code    = $request -> product_code;
            $product -> product_color   = $request -> product_color;
            $product -> product_price   = $request -> product_price;
            $product -> product_discount = $request -> product_discount;
            $product -> product_weight  = $request -> product_weight;
            $product -> product_video   = $request -> product_video ?? '';
            $product -> main_image      = $unique;
            $product -> description     = $request -> description;
            $product -> wash_care       = $request -> wash_care;
            $product -> fabric          = $request -> fabric;
            $product -> pattern         = $request -> pattern;
            $product -> sleeve          = $request -> sleeve;
            $product -> fit             = $request -> fit;
            $product -> occassion       = $request -> occassion;
            $product -> meta_title      = $request -> meta_title;
            $product -> meta_desc       = $request -> meta_desc;
            $product -> meta_keyword    = $request -> meta_keyword;
            $product -> is_featured     = $request -> is_featured ?? 0;
            $product -> is_featured     = 1;
            $product -> save();

        // msg
        $notify = [
            'message'       => "Product Inserted Succefully",
            'alert-type'    => "success"
        ];

        return redirect() -> route('product.view') -> with($notify);


        }

    
       
        // get all sesction
        $allData['section'] = CreateSection::with('getCategory') -> get();
        // $data = json_decode(json_encode($section));
        // echo "<pre>"; print_r($data);


        // filter Arrays
        $allData['fabricArr'] = ['Cotton', 'Colyster', 'Wool'];
        $allData['sleeveArr'] = ['Full Sleeve', 'Half Sleeve', 'Short Sleeve'];
        $allData['patternArr'] = ['Cehcked', 'Plain', 'Solid', 'Printed'];
        $allData['fitArr'] = ['Regular', 'Slim'];
        $allData['ocassionArr'] = ['Casual', 'Formal'];

        return view('backend.product.product_add_edit', $allData);

    }



}
