<?php 
use App\Models\Cart; 
use App\Models\Product;
?>

@extends('frontend.user_master')

@section('main_content')


<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active"> CHECK-OUT</li>
    </ul>
	<h3>  CHECK-OUT [ <small><span class="totalCartItem">{{ totalCartItem() }}</span> Item(s) </small>]<a href="{{ url('/cart') }}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Back to Cart </a></h3>	
	<hr class="soft"/>

	<form action="{{ route('checkout') }}" method="POST">
		@csrf

		<table class="table table-bordered">
			<tbody>
			<tr>
				<th> 
					<span style="font-size: 20px">Deliver Address</span> <a href="{{ route('delivery.address.add.edit') }}" class="btn btn-info btn-sm" style="float: right;">Add</a> 
				</th>
			</tr>
			<tr> 
				<td>
					<form class="">
						<div class="controls">
							@foreach($deliveryAddress as $item)
							<input type="radio" name="address_id" id="{{$item['name']}}" style="float: left; margin-right: 5px;" value="{{$item['id']}}">
							 <label for="{{$item['name']}}">  {{  $item['name'] }}, {{ $item['address'] }}, {{ $item['city'] }}, {{ $item['country'] }}</label>
							 <div>
								<a style="color: rgb(66, 66, 39); font-size: 15px"  href="{{ route('delivery.address.add.edit', $item['id']) }}" ><i class="fa fa-edit"></i></a> &nbsp;
								
								<a id="delete" href="{{ route('address.delete', $item['id']) }}" style="color: red; font-size: 12px" ><i class="fa fa-trash"></i></a>
							 </div>
							@endforeach
						</div>
					</form>
				</td>
			</tr>
			</tbody>
		</table>
			
				
		<table class="table table-bordered">
			<thead>
			<tr>
				<th>Product</th>
				<th colspan="2">Description</th>
				<th>Quantity/Update</th>
				<th>Price/Unit</th>
				<th>Discount</th>
				<th>Sub Total</th>
			</tr>
			</thead>
			<tbody>
			<?php $total = 0; ?>
			
			@foreach($userCartItems as $item)
			<?php 
				$getProductPrice = Cart::getProductPrice($item['product_id'], $item['size']);
				$discount = Product::getAttrDiscountPrice($item['product_id'], $item['size']);
	
				// dd($discount) -> toArray();
			?>
			<tr>
				<td> 
					@if($item['get_product']['main_image'])
					<img src="{{URL::to('')}}/media/backend/product/large/{{$item['get_product']['main_image']}}" alt="" style="width: 60px"/>
					@else 
					<img src="{{URL::to('')}}/media/no_image.jpg" alt="" style="width: 60px"/>
					@endif
				</td>
				<td colspan="2">{{ $item['get_product']['product_name'] }}<br/>
					Color : {{ $item['get_product']['product_color'] }} <br>
					Size : {{ $item['size'] }}
				</td>
				<td>
					{{$item['quantity']}}
				</td>
				{{-- {{ print_r($discount) }} --}}
				<td>${{ $getProductPrice }}</td>
				<td>${{$discount['discountAmount']}}</td>
				<td>
					{{$discount['attrDiscountPrice'] * $item['quantity']}}
				</td>
				</tr>
				<?php 
				$total = $total + ($discount['attrDiscountPrice'] * $item['quantity']); 
				?>
					
			@endforeach
			
			
			<tr>
				<td colspan="6" style="text-align:right">Sub Total Price:	</td>
				<td> ${{$total}}</td>
			</tr>
				<tr>
				<td colspan="6" style="text-align:right">Coupon Discount:	</td>
				<td class="couponDiscount">
					@if(Session::has('couponAmount'))
					${{ Session::get('couponAmount') }}
					@else 
					$00
					@endif
				</td>
			</tr>
				<tr>
					<td colspan="6" style="text-align:right">
						<strong>
							GRAND TOTAL (${{$total}}  - <span class="couponDiscount"> 
								@if(Session::has('couponAmount'))
								${{ Session::get('couponAmount') }}
								@else 
								$00
								@endif</spanc> ) =
						</strong>
					</td>
				<td class="label label-important" style="display:block"> 
					<strong class="grandTotal"> 
						${{$grand_total = $total - Session::get('couponAmount') }}  
						@php
							Session::put('grand_total', $grand_total);
						@endphp
					</strong>
				</td>
			</tr>
			</tbody>
		</table>
			
		
		<table class="table table-bordered">
			<tbody>
				<tr>
					<td> 
						<h4>Payment Methods</h4>
						<div class="payment">
							<input type="radio" name="payment_gateway" id="PAYPAL" style="float: left; margin-right: 5px;" value="PAYPAL">
							<label for="PAYPAL">PAYPAL</label>
							<input type="radio" name="payment_gateway" id="COD" style="float: left; margin-right: 5px;">
							<label for="COD">COD</label>
						</div>
					</td>
				</tr>
				
			</tbody>
		</table>

		<a href="{{ url('/cart') }}" class="btn btn-large"><i class="icon-arrow-left"></i> Back to Cart </a>
		<button type="submit" class="btn btn-large pull-right">Place Order <i class="icon-arrow-right"></i></button>
		

	</form>

				

</div>

@endsection