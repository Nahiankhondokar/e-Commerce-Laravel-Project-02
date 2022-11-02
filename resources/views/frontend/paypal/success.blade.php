<?php 
use App\Models\Cart; 
use App\Models\Product;
?>

@extends('frontend.user_master')

@section('main_content')


<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Confirmed</li>
    </ul>
    <h2 style="text-align: center;">Your Paypal Payment Has Been Confrimed</h2>
	<h6 style="text-align: center;">Thansk For Shopping. We will process your order soon.</h6>

  
</div>

@endsection


@php
    // session delete
    Session::forget('grand_total');
    Session::forget('couponAmount');
    Session::forget('couponCode');
    Session::forget('order_id');
@endphp