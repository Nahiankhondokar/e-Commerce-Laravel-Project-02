@php
    use App\Models\Product;
    use App\Models\Order;
@endphp

@extends('frontend.user_master')

@section('main_content')   
        
<div class="span9">

    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">My Orders</li>
    </ul>
    <?php $orderStatus = Order::getOrderStatus($orderDetails['id']); ?>
	<h3> Orders Details 
        @if($orderStatus['order_status'] == 'New' )
            <a href="#" class="btn btn-danger" style="float: right" data-toggle="modal" data-target="#orderCancel">Cancel Order</a>
           
        @endif
        @if($orderStatus['order_status'] == 'Delivered' )
            <a href="#" class="btn btn-danger" style="float: right" data-toggle="modal" data-target="#orderReturn">Return or Exchange Order</a>
        @endif
    </h3>
    
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
                    @if($orderDetails['courier_name'])
                        <tr>
                          <th>Couirer Name</th>
                          <td>{{ $orderDetails['courier_name'] ?? 'None' }}</td>
                        </tr>
                        <tr>
                          <th>Tranking Number</th>
                          <td>{{ $orderDetails['traking_number']?? 'None' }}</td>
                        </tr>
                        @endif
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
                    <th scope="col">Rreturn Status</th>
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
                        <td style="color: red">{{ $item['return_order_status'] ?? 'None' }}</td>
                      </tr>
                    @endforeach
                  
                </tbody>
            </table>
        </div>
    </div> 
</div>
<!--/ wrapper -->

<!-- Order Cancel Modal -->
<div class="modal fade" id="orderCancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{ route('order.cancel', $orderDetails['id']) }}" method="post">
        @csrf
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Order Cancel Process</h5>
            </div>
            <div class="modal-body">
            <label for="">Order Cancel Reason</label>
            <select name="reason" id="" class="form-select" required>
                <option value="">Select</option>
                <option value="Order Created By Mistake">Order Created By Mistake</option>
                <option value="Item Not Arrive On Time">Item Not Arrive On Time</option>
                <option value="Shipping Cost Too High">Shipping Cost Too High</option>
                <option value="Found Cheeper Somewhere Else">Found Cheeper Somewhere Else</option>
            </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Confirmed</button>
            </div>
        </div>
        </div>
    </form>
</div>

<!-- Order Return Modal -->
<div class="modal fade" id="orderReturn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{ route('order.return', $orderDetails['id']) }}" method="post">
        @csrf
        <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLabel">Order Return or Exchange Process</h5>
            </div>
            <div class="modal-body" style="text-align: center;">
                <label for=""><b>Select Return or Exchange</b></label>
                <select name="returnOrExchange" id="" class="form-select returnOrExchange" required>
                    <option value="" selected disabled>-Select-</option>
                    <option value="Return">Return</option>
                    <option value="Exchange">Exchange</option>
                </select>
                
                <label for=""><b>Ordered Products</b></label>
                <select name="product_info" id="product_info" class="form-select" required>
                    <option value="" selected disabled>-Select Product-</option>
                    @foreach($orderDetails['order_product'] as $item)
                        @if($item['return_order_status'] != 'Return Request')
                        <option value="{{$item['product_code']}}-{{$item['product_size']}}">{{$item['product_code']}} -- {{$item['product_size']}}</option>
                        @endif
                    @endforeach
                </select>

                <label for=""><b>Order Return Reason</b></label>
                <select name="returnReason" id="" class="form-select" required>
                    <option value="">Select</option>
                    <option value="Quality is bad">Quality is bad</option>
                    <option value="Item Not Arrive Too Late">Item Not Arrive Too Late</option>
                    <option value="Wrong Item was sent">Wrong Item was sent</option>
                    <option value="Product Does not Work">Product Does not Work</option>
                </select>

                <div class="form-control showRequirdSize" style="display: none">
                    <label for=""><b>Select Required Size</b></label>
                    <select name="required_size" id="required_size" class="form-select">
                        
                    </select>
                </div>

                <label for=""><b>Order Return Comment</b></label>
                <textarea name="comment" id="" cols="30" rows="3"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Confirmed</button>
            </div>
        </div>
        </div>
    </form>
</div>

@endsection


