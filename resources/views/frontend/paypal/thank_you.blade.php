<?php 
use App\Models\Cart; 
use App\Models\Product;
?>

@extends('frontend.user_master')

@section('main_content')


<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active"> Thanks For Shopping</li>
    </ul>
	<h4 style="text-align: center;">Thansk For Shopping</h4>
    <span style="text-align: center; display: block;">Your order number is <strong>{{Session::get('order_id')}}</strong> & Total Payable Amount is <strong>${{ Session::get('grand_total') }}</strong></span>
    <p style="text-align: center">Please make your <strong>Paypal</strong> payment : </p>
    <form action="https://sandbox.paypal.com/cgi-bin/webscr" method="post" style="text-align: center">
      <input type="hidden" name="cmd" value="_xclick" />
      <input type="hidden" name="business" value="sb-vqgo121290206@business.example.com" />
      <input type="hidden" name="item_name" value="{{ Session::get('order_id') }}" />
      <input type="hidden" name="item_number" value="{{ Session::get('order_id') }}" />
      <input type="hidden" name="amount" value="{{ Session::get('grand_total') }}" />
      {{-- <input type="text" name="tax" value="1" /> --}}
      <input type="hidden" name="quantity" value="1" />
      <input type="hidden" name="currency_code" value="USD" />
      <!-- Enable override of buyers's address stored with PayPal . -->
      {{-- <input type="text" name="address_override" value="1" /> --}}
      <!-- Set variables that override the address stored with PayPal. -->
      <input type="hidden" name="first_name" value="{{ $nameArr[0] ?? '' }}" />
      <input type="hidden" name="last_name" value="{{ $nameArr[1] ?? 'No Last Name' }}" />
      <input type="hidden" name="address1" value="{{$orderDetails['address']}}" />
      <input type="hidden" name="city" value="{{$orderDetails['city']}}" />
      <input type="hidden" name="zip" value="{{$orderDetails['pincode']}}" />
      <input type="hidden" name="country" value="{{$orderDetails['country']}}" />
      <input type="hidden" name="email" value="{{$orderDetails['email']}}" />
      <input type="hidden" name="return" value="{{ url('paypal/success') }}" />
      <input type="hidden" name="cancel_return" value="{{ url('paypal/fail') }}" />
      <input
          type="image"
          name="submit"
          src="https://www.paypalobjects.com/en_US/i/btn/btn_paynow_LG.gif"
          alt="PayPal - The safer, easier way to pay online"
      />
  </form>
  
</div>

@endsection


@php
    // session delete
    Session::forget('couponCode');
    Session::forget('order_id');
@endphp