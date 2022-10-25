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
    <span style="text-align: center; display: block;">Your order number is <strong>{{Session::get('order_id')}}</strong> & Total Amount is <strong>${{ Session::get('grand_total') }}</strong></span>
</div>

@endsection


@php
    // session delete
    Session::forget('grand_total');
    Session::forget('couponAmount');
    Session::forget('couponCode');
    Session::forget('order_id');
@endphp