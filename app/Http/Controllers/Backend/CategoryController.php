<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CreateSection;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // categroy view
    public function CategoryView () {

        $allData = Category::with(['section', 'parentCategory', 'subcategories']) -> get();
        // $data = json_decode(json_encode($allData));
        // echo "<pre>"; print_r($data);
        return view('backend.category.category_view', compact('allData'));

    }


    // category add view
    public function CategoryAddView () {

        $allData['sections'] = CreateSection::all();
        return view('backend.category.category_add', $allData);

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


    // get category leve section wise
    public function GetCategorySectionWise (Request $request) {

        $category_level = Category::with('subcategories') -> where('section_id', $request -> section_id) -> where('parent_id', 0) -> where('status', 1) -> get();
        return view('backend.category.append_category_view', compact('category_level'));

    }


    // category store
    public function CategoryStore(Request $request){
        // dd($request -> all());

         // img upload 
         if($request -> hasFile('category_image')){

            $img = $request -> file('category_image');
            $unique = md5(time() . rand()) . '.' . $img -> getClientOriginalExtension();
            $img -> move(public_path('media/category'), $unique);

        }

        // category store
        Category::insert([
            'category_name'         => $request -> category_name,
            'parent_id'             => $request -> parent_id,
            'section_id'            => $request -> section_id,
            'category_image'         => $unique,
            'category_discount'      => $request -> category_discount,
            'description'           => $request -> description,
            'url'                   => $request -> url,
            'meta_title'            => $request -> meta_title,
            'meta_description'      => $request -> meta_description,
            'meta_keyword'          => $request -> meta_keyword,
        ]);



         // msg
         $notify = [
            'message'       => "Category Inserted Succefully",
            'alert-type'    => "success"
        ];

        return redirect() -> route('category.view') -> with($notify);

    }

    
    // get category leve section wise
    public function GetEditCategorySectionWise (Request $request) {

        $edit_category_level = Category::with('subcategories') -> where('section_id', $request -> section_id) -> where('parent_id', 0) -> where('status', 1) -> get();
        return view('backend.category.append_edit_category_view', compact('edit_category_level'));

    }

    // categroy edit
    public function CategoryEdit ($id) {

        $allData['category'] = Category::where('id', $id) -> first();
        $allData['sections'] = CreateSection::all();
        $allData['edit_cat'] = Category::where('section_id', $allData['category'] -> section_id) -> where('parent_id', 0) -> get();
        // $data = json_decode(json_encode($allData['category']));
        // echo "<pre>"; print_r($data);
        return view('backend.category.category_edit', $allData);

    }


}
