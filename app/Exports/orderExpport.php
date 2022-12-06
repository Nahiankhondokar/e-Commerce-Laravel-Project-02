<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\OrderProduct;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class orderExpport implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // get all order data
        $orderData = Order::select('id', 'name','phone', 'order_status', 'payment_method', 'grand_total') -> get();

        // order product details
        foreach($orderData as $key => $item){
            $orderProduct = OrderProduct::select('id', 'product_code', 'product_name') -> where('order_id', $item -> id) -> get();
            // $orderItem = json_decode(json_encode($orderProduct));

            // get product code
            $product_codes = '';
            $product_name = '';
            foreach($orderProduct as $item){
                $product_codes .= $item -> product_code.',';
                $product_name .= $item -> product_name.',';
            }

            /**
             *  create a key with value
             *  bind this key with the main array
             */
            $orderData[$key]['product_codes'] = $product_codes;
            $orderData[$key]['product_name'] = $product_name;
            // $orderData = json_decode(json_encode($orderData));
            // echo '<pre>'; print_r($orderData); die; 
            
        }
        // echo '<pre>'; print_r($orderData); die; 
        return $orderData;
    }

    // heading for all the coloum
    public function headings(): array{
        return ['Id', 'Name', 'Phone', 'Status', 'Payment', 'Total', 'Product Code', 'Product Name'];
    }
}
