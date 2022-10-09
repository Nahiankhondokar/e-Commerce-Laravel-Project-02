<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    // index page view
    public function IndexView(){
        $page_name = 'index';
        return view('frontend.index', compact('page_name'));
    }




}
