@php
    use App\Models\Product;
@endphp

@extends('frontend.user_master')

@section('main_content')   
        
<div class="span9">

    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">My Orders</li>
    </ul>
	<h3> Orders Details </h3>	
	<hr class="soft"/>
	
    <div class="row">
        <div class="span4">
            <table class="table table-striped table-bordered">
                <thead>
                    <th>Order Details</th>
                </thead>
                <tbody>
        
                    <tr>
                        <th>Order Date</th>
                        <td>{{ date('d-m-Y', strtotime($orderDetails['created_at'])) }}</td>
                    </tr>
                    <tr>
                        <th>Total Amount</th>
                        <td scope="row">${{ $orderDetails['grand_total'] }}</td>
                    </tr>
        
                    <tr>
                        <th>Order Status</th>
                        <td>
                            {{ $orderDetails['order_status'] }}
                        </td>
                    </tr>
                    <tr>
                        <th>payment method</th>
                        <td>{{ $orderDetails['payment_method'] }}</td>
                    </tr>
                    <tr>
                        <th>Shipping Charge</th>
                        <td>{{ $orderDetails['shipping_charge'] }}</td>
                    </tr>
                    <tr>
                        <th>Coupon Code</th>
                        <td>{{ $orderDetails['coupon_code'] }}</td>
                    </tr>
                    <tr>
                        <th>Coupon Amount</th>
                        <td>${{ $orderDetails['coupon_amount'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="span4">
            <table class="table table-striped table-bordered">
                <thead>
                    <th>Delivery Details</th>
                </thead>
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td>{{ $orderDetails['name'] }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td scope="row">{{ $orderDetails['email']  }}</td>
                    </tr>
        
                    <tr>
                        <th>Phone</th>
                        <td>
                            {{ $orderDetails['phone'] }}
                        </td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $orderDetails['address'] }}</td>
                    </tr>
                    <tr>
                        <th>Pin Code</th>
                        <td>{{ $orderDetails['pincode']  }}</td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td>{{ $orderDetails['city']  }}</td>
                    </tr>
                    <tr>
                        <th>Country</th>
                        <td>{{ $orderDetails['country']  }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <div class="row">
        <div class="span8">
            <table class="table table-striped table-bordered">
                <h5>Order Product Details</h5>
                <thead>
                  <tr>
                    <th scope="col">Produc Image</th>
                    <th scope="col">Produc Code</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Size</th>
                    <th scope="col">Product Color</th>
                    <th scope="col">Product Quantity</th>
                  </tr>
                </thead>
                <tbody>
        
                    @foreach($orderDetails['order_product'] as $item)
                    <tr>
                        <th scope="row">
                            @php
                                $img = Product::getProductImage($item['product_id']);
                                // print_r($img['main_image']);
                            @endphp
                            <a target="_blank" href="{{ url('product/'.$item['id']) }}">
                                <img src="{{URL::to('')}}/media/backend/product/large/{{ $img['main_image'] }}" alt="" style="width:40px ">
                            </a>
                        </th>
                        <th scope="row">{{ $item['product_code'] }}</th>
                        <td>
                            {{$item['product_name']}}
                        </td>
                        <td>{{ $item['product_size'] }}</td>
                        <td>${{ $item['product_color'] }}</td>
                        <td>{{ $item['product_qty'] }}</td>
                      </tr>
                    @endforeach
                  
                </tbody>
            </table>
        </div>
    </div>


 
</div>
        
        <!--/ wrapper -->

@endsection

