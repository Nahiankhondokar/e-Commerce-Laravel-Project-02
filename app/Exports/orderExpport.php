<?php

namespace App\Exports;

use App\Models\Order;
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
        $data = Order::select('id', 'name','phone', 'order_status', 'payment_method', 'grand_total') -> get();
        return $data;
    }

    // heading
    public function headings(): array{
        return ['Id', 'Name', 'Phone', 'Status', 'Payment', 'Total'];
    }
}
