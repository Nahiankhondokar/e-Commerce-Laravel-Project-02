@extends('frontend.user_master')

@section('main_content')   
        
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">My Orders</li>
    </ul>
	<h3> My Orders</h3>	
	<hr class="soft"/>
	
    <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Order Product</th>
            <th scope="col">Payment Method</th>
            <th scope="col">Grand Total</th>
            <th scope="col">Created On</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>

            @foreach($order as $item)
            <tr>
                <th scope="row">{{ $item['id'] }}</th>
                <td>
                    @foreach($item['order_product'] as $product)
                    {{$product['product_code'] }} 
                    ({{$product['product_qty']}}) <br>
                    @endforeach
                </td>
                <td>{{ $item['payment_method'] }}</td>
                <td>${{ $item['grand_total'] }}</td>
                <td>{{ date('d-m-Y', strtotime($item['created_at'])) }}</td>
                <td>
                    <a href="{{route('order.details')}}" class="btn btn-sm btn-info"><i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                </td>
              </tr>
            @endforeach
          
        </tbody>
    </table>
      
	
</div>
        
        <!--/ wrapper -->
        

@endsection


