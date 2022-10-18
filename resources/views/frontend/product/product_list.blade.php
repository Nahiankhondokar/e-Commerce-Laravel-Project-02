@extends('frontend.user_master')

@section('main_content')

<div class="span9">
    <ul class="breadcrumb">
        <li><a href="{{url('/')}}">Home</a> <span class="divider">/</span></li>

        @if(@$catDetails['parent_id'] == 0)
        <li class="active"> <a href="{{ url('/'.$catDetails['category_name']) }}">{{ $catDetails['category_name'] }}</a> </li>
        @else
        <li class="active"> <a href="{{ url('/'.$breadcum -> category_name) }}">{{ $breadcum -> category_name }}</a> <span class="divider">/</span> <a href="{{ url('/'.$catDetails['category_name']) }}">{{ $catDetails['category_name'] }}</a> </li>
        @endif

    </ul>
    <h3> {{ ucwords($catDetails['category_name']) }} <small class="pull-right"> {{ count($catWiseProduct) }} products are available </small></h3>
    <hr class="soft"/>
    <p>
        {{ (@$catDetails['description']) ? $catDetails['description'] : 'No Description Found' }}
    </p>
    <hr class="soft"/>
    <form class="form-horizontal span6" method="GET" name="sortProducts" id="sortProducts">
        <input type="hidden" name="url" id="url" value="{{ $catDetails['url'] }}">
        <div class="control-group">
            <label class="control-label alignL">Sort By </label>
            <select name="sort" id="sort">
                <option value="">Select</option>
                <option value="product_a_z" @if(isset($_GET['sort']) && $_GET['sort'] == 'product_a_z') selected @endif>Product Name A - Z</option>

                <option value="product_z_a" @if(isset($_GET['sort']) && $_GET['sort'] == 'product_z_a') selected @endif>Product Name Z - A</option>

                <option value="latest_product" @if(isset($_GET['sort']) && $_GET['sort'] == 'latest_product') selected @endif>Latest Product</option>

                <option value="lower_price" @if(isset($_GET['sort']) && $_GET['sort'] == 'lower_price') selected @endif>Price Lowest</option>

                <option value="highest_price" @if(isset($_GET['sort']) && $_GET['sort'] == 'highest_price') selected @endif>Price Highest</option>
            </select>
        </div>
    </form>

    <br class="clr"/>
    <div class="tab-content filter_products">
        @include('frontend.product.ajax_product_listing')
    </div>
    <a href="compair.html" class="btn btn-large pull-right">Compare Product</a>
    <div class="pagination">

        {{-- // pagination with product filtering  --}}
        @if(isset($_GET['sort']) && !empty($_GET['sort']))
            {{  $catWiseProduct->appends(['sort' => $_GET['sort']]) -> links() }}
        @else 
            {{ $catWiseProduct -> links() }}
        @endif
        



        {{-- <ul>
            <li><a href="#">&lsaquo;</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">...</a></li>
            <li><a href="#">&rsaquo;</a></li>
        </ul> --}}
    </div>
    <br class="clr"/>
</div>

@endsection