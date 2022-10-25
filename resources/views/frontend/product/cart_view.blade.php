<?php 
use App\Models\Cart; 
use App\Models\Product;
?>

@extends('frontend.user_master')

@section('main_content')


<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active"> SHOPPING CART</li>
    </ul>
	<h3>  SHOPPING CART [ <small><span class="totalCartItem">{{ totalCartItem() }}</span> Item(s) </small>]<a href="{{ url('/') }}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>	
	<hr class="soft"/>
		
			
	<div id="appendCartItem">
		@include('frontend.product.append_cart_item')
	</div>
		
	
	<table class="table table-bordered">
		<tbody>
			<tr>
				<td> 
					<form class="form-horizontal" method="post" id="applyCoupon" @if(Auth::check()) user="1" @endif>
						@csrf
						<div class="control-group">
							<label class="control-label"><strong> COUPON CODE: </strong> </label>
							<div class="controls">
								<input type="text" name="code" id="code" class="input-medium" placeholder="Endter Coupon Code">
								<button type="submit" class="btn"> ADD </button>
							</div>
						</div>
					</form>
				</td>
			</tr>
			
		</tbody>
	</table>
			
			<!-- <table class="table table-bordered">
			 <tr><th>ESTIMATE YOUR SHIPPING </th></tr>
			 <tr> 
			 <td>
				<form class="form-horizontal">
				  <div class="control-group">
					<label class="control-label" for="inputCountry">Country </label>
					<div class="controls">
					  <input type="text" id="inputCountry" placeholder="Country">
					</div>
				  </div>
				  <div class="control-group">
					<label class="control-label" for="inputPost">Post Code/ Zipcode </label>
					<div class="controls">
					  <input type="text" id="inputPost" placeholder="Postcode">
					</div>
				  </div>
				  <div class="control-group">
					<div class="controls">
					  <button type="submit" class="btn">ESTIMATE </button>
					</div>
				  </div>
				</form>				  
			  </td>
			  </tr>
            </table> -->		
	<a href="{{ url('/') }}" class="btn btn-large"><i class="icon-arrow-left"></i> Continue Shopping </a>
	<a href="{{ route('checkout') }}" class="btn btn-large pull-right">Next <i class="icon-arrow-right"></i></a>
	
</div>

@endsection