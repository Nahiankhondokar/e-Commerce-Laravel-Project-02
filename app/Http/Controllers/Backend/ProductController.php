<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
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

        if($id){
            $allData['title'] = 'Edit Product';
        }else {
            $allData['title'] = 'Add Product';
        }

        // filter Arrays
        $allData['fabricArr'] = ['Cotton', 'Colyster', 'Wool'];
        $allData['sleeveArr'] = ['Full Sleeve', 'Half Sleeve', 'Short Sleeve'];
        $allData['patternArr'] = ['Cehcked', 'Plain', 'Solid', 'Printed'];
        $allData['fitArr'] = ['Regular', 'Slim'];
        $allData['ocassionArr'] = ['Casual', 'Formal'];

        return view('backend.product.product_add_edit', $allData);

    }



}
