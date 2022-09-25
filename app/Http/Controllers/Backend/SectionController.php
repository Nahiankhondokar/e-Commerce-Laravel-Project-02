<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CreateSection;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    // section view
    public function SectionView () {

        $allData = CreateSection::get();
        return view('backend.section.section_view', compact('allData'));
    }


    // section active or inactive status
    public function SectionActiveInactive(Request $request){

        $status_data = CreateSection::find($request -> section_id);

        if($status_data -> status == 1){
            $update = CreateSection::find($request -> section_id);
            $update -> status = 0;
            $update -> update();
            return 'inactive';

        }else {
            $update = CreateSection::find($request -> section_id);
            $update -> status = 1;
            $update -> update();
            return 'active';
        }

    }
}
