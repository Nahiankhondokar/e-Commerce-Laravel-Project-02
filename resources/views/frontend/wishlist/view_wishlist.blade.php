<?php 
use App\Models\Cart; 
use App\Models\Product;
?>

@extends('frontend.user_master')

@section('main_content')


<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Wishlist</li>
    </ul>
	<h3>  Wishlist [ <small><span class="totalCartItem">{{ count($wishlistProduct) }}</span> Item(s) </small>]<a href="{{ url('/') }}" class="btn btn-large pull-right"><i class="icon-arrow-left"></i> Continue Shopping </a></h3>	
	<hr class="soft"/>
		
			
	<div>
		@include('frontend.wishlist.append_wishlist_item')
	</div>
		
	
</div>

@endsection