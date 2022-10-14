<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // product listin page category wise
    public function ProductListing($url, Request $request){

        // filtering system by ajax
        if($request -> ajax()){
            // echo '<pre>'; print_r($request -> all()); die;

            $data = $request -> all();
            $url = $data['url'];

            $catCount = Category::where(['url' => $url, 'status' => 1]) -> get() -> count();
            $searchUrl = Category::where(['url' => $url, 'status' => 1]) -> first();

            if($catCount > 0){
                $catDetails = Category::select('id', 'category_name', 'url', 'description', 'parent_id') -> with('subcategories', function($query){
                    $query -> select('id', 'parent_id', 'description', 'category_name', 'parent_id') -> where('status', 1);
                }) -> where(['url' => $url]) -> first() -> toArray();

                // cat or subcat all Ids array
                $catIds = [$catDetails['id']];

                foreach($catDetails['subcategories'] as $key => $item){
                    // $catIds = $item['id'];
                    array_push($catIds, $item['id']);
                }

                // breadcum define
                $breadcum = Category::find($searchUrl -> parent_id);

                // get data without loop
                $catWiseProduct = Product::with('getBrand') -> whereIn('category_id', $catIds) -> where('status', 1) -> paginate(3);
                

                // product filtering by ajax
                if(isset($data['sort']) && !empty($data['sort'])){
                    if($data['sort'] == 'latest_product'){
                        $catWiseProduct = Product::with('getBrand') -> whereIn('category_id', $catIds) -> where('status', 1) -> orderBy('id', 'DESC') -> paginate(3);
                    }elseif($data['sort'] == 'highest_price'){
                        $catWiseProduct = Product::with('getBrand') -> whereIn('category_id', $catIds) -> where('status', 1) -> orderBy('product_price', 'DESC') -> paginate(3);
                    }elseif($data['sort'] == 'lower_price'){
                        $catWiseProduct = Product::with('getBrand') -> whereIn('category_id', $catIds) -> where('status', 1) -> orderBy('product_price', 'ASC') -> paginate(3);
                    }elseif($data['sort'] == 'product_z_a'){
                        $catWiseProduct = Product::with('getBrand') -> whereIn('category_id', $catIds) -> where('status', 1) -> orderBy('product_name', 'DESC') -> paginate(3);
                    }elseif($data['sort'] == 'product_a_z'){
                        $catWiseProduct = Product::with('getBrand') -> whereIn('category_id', $catIds) -> where('status', 1) -> orderBy('product_name', 'ASC') -> paginate(3);
                    }
                }else{
                    $catWiseProduct;
                }

                return view('frontend.product.ajax_product_listing', compact('catWiseProduct', 'catDetails', 'breadcum'));
            }else{
                abort(404);
            }
            
        }else{
            
            $catCount = Category::where(['url' => $url, 'status' => 1]) -> get() -> count();
            $searchUrl = Category::where(['url' => $url, 'status' => 1]) -> first();

            if($catCount > 0){
                $catDetails = Category::select('id', 'category_name', 'url', 'description', 'parent_id') -> with('subcategories', function($query){
                    $query -> select('id', 'parent_id', 'description', 'category_name', 'parent_id') -> where('status', 1);
                }) -> where(['url' => $url]) -> first() -> toArray();

                // cat or subcat all Ids array
                $catIds = [$catDetails['id']];

                foreach($catDetails['subcategories'] as $key => $item){
                    // $catIds = $item['id'];
                    array_push($catIds, $item['id']);
                }

                // breadcum define
                $breadcum = Category::find($searchUrl -> parent_id);

                // get data with loop
                // foreach($catIds as $key => $item){
                //     $catWiseProduct = Product::where('category_id', $item) -> where('status', 1) -> get();
                // }

                // get data without loop
                $catWiseProduct = Product::with('getBrand') -> whereIn('category_id', $catIds) -> where('status', 1) -> paginate(3);

                // product fabric filter option
                $page_name = 'list';

                // all static filter item from product model
                $allFilters = Product::getAllFilters();

                return view('frontend.product.product_list', compact('catWiseProduct', 'catDetails', 'breadcum', 'page_name'), $allFilters);

            }else{
                abort(404);
            }
        }


    }


}