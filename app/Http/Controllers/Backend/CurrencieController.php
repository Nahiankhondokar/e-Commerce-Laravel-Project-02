<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Currencie;
use Illuminate\Http\Request;

class CurrencieController extends Controller
{
    // adimin or subadmin page view
    public function CurrencieView(){
        $allCurrencie = Currencie::get();
        return view('backend.currencie.currencie_view') -> with(compact('allCurrencie'));
    }
}
