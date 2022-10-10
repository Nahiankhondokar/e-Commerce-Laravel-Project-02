<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    // index page view
    public function IndexView(){

        $featureItemCount = Product::where('is_featured', 'Yes') -> count();
        $featureProduct = Product::where('is_featured', 'Yes') -> get() -> toArray();
        $featureItemChunk = \array_chunk($featureProduct, 4);
        // dd($featureItemChunk);
        $page_name = 'index';
        return view('frontend.index', compact('page_name', 'featureItemChunk', 'featureItemCount'));
    }




}
