<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // section view
    public function CategoryView () {

        $allData = Category::get();
        return view('backend.category.category_view', compact('allData'));

    }


    // category active or inactive status
    public function CategoryActiveInactive(Request $request){

        $status_data = Category::find($request -> category_id);

        if($status_data -> status == 1){
            $update = Category::find($request -> category_id);
            $update -> status = 0;
            $update -> update();
            return 'inactive';

        }else {
            $update = Category::find($request -> category_id);
            $update -> status = 1;
            $update -> update();
            return 'active';
        }

    }


}
