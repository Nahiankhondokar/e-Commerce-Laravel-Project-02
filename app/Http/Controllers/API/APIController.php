<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class APIController extends Controller
{
    // pushOrder
    public function pushOrder($id){
        $getResults = Order::pushOrder($id);
        return redirect() -> json(['status' => $getResults]);
    }


}
