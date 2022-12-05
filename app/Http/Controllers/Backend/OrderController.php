<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ExchangeProduct;
use App\Models\Order;
use App\Models\OrderLog;
use App\Models\OrderProduct;
use App\Models\OrderStatus;
use App\Models\ReturnProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class OrderController extends Controller
{
    // order view
    public function OrderViewAdmin(){
        $order = Order::with('order_product') -> orderBy('id', 'DESC') -> get() -> toArray();
        // dd($order);
        return view('backend.order.order_view', compact('order'));
    }


    
    // order details
    public function OrderDetailsAdmin($id){

        $orderDetails = Order::with('order_product') -> where('id', $id) -> first() -> toArray();
        $userDetails = User::where('id', $orderDetails['user_id']) -> first() -> toArray();
        $orderStatus = OrderStatus::where('status', 1) -> get() -> toArray();
        $orderLog = OrderLog::where('order_id', $id) -> orderBy('id', 'DESC') -> get() -> toArray();

        // dd($orderLog) -> toArray();

        return view('backend.order.order_details', compact('orderDetails', 'userDetails', 'orderStatus', 'orderLog'));
    }


    // order status update
    public function OrderStatusUpdateAdmin(Request $request){

            // dd($request -> all()); die;

        // order couiere or traking no udpate
        $update = Order::find($request -> order_id);

        /**
         * if status is shipped,
         * have to provide couriere name or tracking numer
         */
       if($request -> status == 'Shipped'){

            // validation
            if( !$request -> courier_name || !$request -> traking_number){
                // msg
                $notify = [
                    'message'       => "Courier & Tracking number are requierd",
                    'alert-type'    => "error"
                ];

                return redirect() -> back() -> with($notify);

            }

            $update -> courier_name = $request -> courier_name;
            $update -> traking_number = $request -> traking_number;
            $update -> update();

       }else {
            $update -> courier_name = $request -> courier_name ?? 'None';
            $update -> traking_number = $request -> traking_number ?? 'None';
            $update -> update();
       }

        // status update
        Order::where('id', $request -> order_id) -> update(['order_status' => $request -> status]);

        
        // **send main to customer
        // $orderDetails = Order::find($request -> order_id);
        // $email = $orderDetails -> email; 
        // $messageData = [
        //     'name'      => $orderDetails -> name,
        //     'email'      => $email,
        //     'status'     => $request -> status
        // ];

        // Mail::send('frontend.email.status', $messageData, function($msg) use($email) {
        //     $msg -> to($email) -> subject('Order Placed');
        // });


        // order status update report
        $log = new OrderLog();
        $log -> order_id        = $request -> order_id;
        $log -> order_status    = $request -> status;
        $log -> reason          = 'No reason';
        $log -> updated_by      = 'Admin';
        $log -> save();

         // msg
        $notify = [
            'message'       => "Order Status UPdated Succefully ",
            'alert-type'    => "info"
        ];

        return redirect() -> back() -> with($notify);

    }


    // generate order invoice
    public function OrderInvoiceNumver($id){

        $orderDetails = Order::with('order_product') -> where('id', $id) -> first() -> toArray();
        $userDetails = User::where('id', $orderDetails['user_id']) -> first() -> toArray();

        return view('backend.order.order_invoice', compact('orderDetails', 'userDetails'));
    }


    // PDF invoice
    public function OrderPDFInvoice($id){

        $data['orderDetails'] = Order::with('order_product') -> where('id', $id) -> first() -> toArray();
        $data['userDetails'] = User::where('id', $data['orderDetails']['user_id']) -> first() -> toArray();

        $pdf = Pdf::loadView('backend.pdf.pdf_invoice', $data) -> setPaper('a4', 'landscape');
        return $pdf->download('backend.pdf.pdf_invoice');

    }



    // oder charts
    public function ViewOrderChart(){

        $current_month_order = Order::whereYear('created_at', Carbon::now() -> year) -> whereMonth('created_at', Carbon::now() -> month) -> count();
        $last_1_month_order = Order::whereYear('created_at', Carbon::now() -> year) -> whereMonth('created_at', Carbon::now() -> subMonth(1)) -> count();
        $last_2_month_order = Order::whereYear('created_at', Carbon::now() -> year) -> whereMonth('created_at', Carbon::now() -> subMonth(2)) -> count();
        $last_3_month_order = Order::whereYear('created_at', Carbon::now() -> year) -> whereMonth('created_at', Carbon::now() -> subMonth(3)) -> count();

        $orderCount = array($current_month_order, $last_1_month_order, $last_2_month_order, $last_3_month_order);

        // dd($orderCount); die;

        // dd($current_month_user); die;
        return view('backend.order.view_order_chart', compact('orderCount'));
    }


    // order status delete
    public function OrderStatusDeleteAdmin($id){
        OrderLog::find($id) -> delete();
        // msg
        $notify = [
            'message'       => "Order Status Deleted",
            'alert-type'    => "info"
        ];

        return redirect() -> back() -> with($notify);
    }


    // order return request show
    public function ViewReturnOrder(){
        // get all return request
        $return_product = ReturnProduct::get();
        return view('backend.order.view_return_order', compact('return_product'));
    }


    // order return request approved or rejected
    public function UpdateReturnOrder($id, Request $request){
        // dd($request -> all()); die;

        if($request -> ajax()){
            // get all return request data
            $return_details = ReturnProduct::where('id', $id) -> first() -> toArray();

            // order product table status update
            $return_status = 'Return '.$request -> status;
            OrderProduct::where(['order_id' => $return_details['order_id'], 'product_size' => $return_details['product_size'], 'product_code' => $return_details['product_code']]) -> update(['return_order_status'=> $return_status]);

            // return product table status update
            ReturnProduct::where('id', $id) -> update(['return_status' => $request -> status]);

            // get user details
            $user_details = User::select('id', 'name', 'email') -> where('id', $return_details['user_id']) -> first() -> toArray();

            // send mail to customer
            // $email = $user_details['email']; 
            // $messageData = [
            //     'userDetails'       => $user_details,
            //     'returnDetails'     => $return_details,
            //     'return_status'     => $return_status

            // ];
            // Mail::send('backend.email.return_product', $messageData, function($msg) use($email, $return_status) {
            //     $msg -> to($email) -> subject('Return '.$return_status);
            // });

            return $request -> status;


        }
    }


    // Exchange Request view
    public function ViewExchangeRequest(){
        $exchange_product = ExchangeProduct::get();
        return view('backend.order.view_exchange_order', compact('exchange_product'));
    }


}
