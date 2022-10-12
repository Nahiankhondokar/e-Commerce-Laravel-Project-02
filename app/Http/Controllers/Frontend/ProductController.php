<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // product listin page category wise
    public function ProductListing($url){
        $catCount = Category::where(['url' => $url, 'status' => 1]) -> get() -> count();
        $searchUrl = Category::where(['url' => $url, 'status' => 1]) -> first();

        if($catCount > 0){
            $catDetails = Category::select('id', 'category_name', 'url', 'description', 'parent_id') -> with('subcategories', function($query){
                $query -> select('id', 'parent_id', 'description', 'category_name', 'parent_id') -> where('status', 1);
            }) -> where(['url' => $url]) -> first() -> toArray();

            // dd($catDetails);

            // cat or subcat all Ids array
            $catIds = [$catDetails['id']];

            foreach($catDetails['subcategories'] as $key => $item){
                // $catIds = $item['id'];
                array_push($catIds, $item['id']);
            }
            // print_r($catIds);

            // breadcum define
            $breadcum = Category::find($searchUrl -> parent_id);

            // get data with loop
            // foreach($catIds as $key => $item){
            //     $catWiseProduct = Product::where('category_id', $item) -> where('status', 1) -> get();
            // }

            // get data without loop
            $catWiseProduct = Product::with('getBrand') -> whereIn('category_id', $catIds) -> where('status', 1) -> paginate(3);
            $catCount = count($catWiseProduct);
            // dd($catWiseProduct);
            // print_r($catWiseProduct);

            return view('frontend.product.product_list', compact('catWiseProduct', 'catDetails', 'catCount', 'breadcum'));
        }else{
            abort(404);
        }
    }


}
