@php
    use App\Models\Product;
@endphp



@extends('frontend.user_master')

@section('main_content')

<div class="span9">
    <ul class="breadcrumb">
        <li><a href="index.html">Home</a> <span class="divider">/</span></li>
        <li><a href="products.html">{{ ucwords($productDetails -> getCategory -> category_name) }}</a> <span class="divider">/</span></li>
        <li class="active">{{ ucwords(@$productDetails -> product_name ) }}</li>
    </ul>
    <div class="row">
        <div id="gallery" class="span3">
            <a href="{{URL::to('')}}/media/backend/product/large/{{@$productDetails -> main_image}}" title="{{ ucwords($productDetails -> product_name) }}">
                @if($productDetails -> main_image)
                <img src="{{URL::to('')}}/media/backend/product/large/{{@$productDetails -> main_image}}" style="width:100%" alt="{{ ucwords($productDetails -> product_name) }}" style="width: 160px"/>
                @else 
                <img src="{{URL::to('')}}/media/no_image.jpg" alt="" style="width: 160px"/>
                @endif
            </a>
            <div id="differentview" class="moreOptopm carousel slide">
                <div class="carousel-inner">
                    <div class="item active">
                        @foreach(@$productGalleris as $item)
                        <a href="{{URL::to('')}}/media/backend/product/gallery/{{$item}}"> 
                            <img style="width:29%" src="{{URL::to('')}}/media/backend/product/gallery/{{$item}}" alt=""/>
                        </a>
                        @endforeach
                    </div>
                </div>
                <!--
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                -->
            </div>
            
            <div class="btn-toolbar">
                <div class="btn-group">
                    <span class="btn"><i class="icon-envelope"></i></span>
                    <span class="btn" ><i class="icon-print"></i></span>
                    <span class="btn" ><i class="icon-zoom-in"></i></span>
                    <span class="btn" ><i class="icon-star"></i></span>
                    <span class="btn" ><i class=" icon-thumbs-up"></i></span>
                    <span class="btn" ><i class="icon-thumbs-down"></i></span>
                </div>
            </div>
        </div>
        <div class="span6">
            <h3> {{ ucwords($productDetails -> product_name) }} </h3>
            <h5>- {{ ucwords(@$productDetails -> getBrand -> name ?? 'No Brand') }}</h5>
            <hr class="soft"/>
            <h5> {{ $totalStock }} items in stock</h5>
            <form class="form-horizontal qtyFrm" action="{{ route('add.to.cart') }}" method="POST">
                @csrf
                <div class="control-group">
                    <input type="hidden" name="product_id" value="{{ $productDetails -> id }}">

                    @php
                        $discount = Product::getDiscountPrice($productDetails -> id);
                    @endphp
                    {{-- <h3>Product Price</h3> --}}
                    @if($discount > 0)
                    <h4 class="getAttrPrice"><del>${{ $productDetails -> product_price }}</del> - ${{ $discount }} 
                        
                    </h4>
                    
                    @else
                    <h4 class="">${{ $productDetails -> product_price }}</h4>
                    @endif 

                    <select name="size" id="getPrice" product_id="{{ $productDetails -> id }}" class="span2 pull-left" required>

                            <option value="">Select</option>
                            @foreach($productDetails -> getProductAttr as $item)
                            <option value="{{ $item -> size }}">{{ $item -> size }}</option>
                            @endforeach

                        </select>
                        <input type="number" class="span1" placeholder="Qty." name="quantity" required/>
                        <button type="submit" class="btn btn-large btn-primary pull-right"> Add to cart <i class=" icon-shopping-cart"></i></button>
                    </div>
                </div>
            </form>
        
            <hr class="soft clr"/>
            <p class="span6">
                {{ ucwords($productDetails -> description) }}
            </p>
            <a class="btn btn-small pull-right" href="#detail">More Details</a>
            <br class="clr"/>
            <a href="#" name="detail"></a>
            <hr class="soft"/>
        </div>
        
        <div class="span9">
            <ul id="productDetail" class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
                <li><a href="#profile" data-toggle="tab">Related Products</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="home">
                    <h4>Product Information</h4>
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
                            <tr class="techSpecRow"><td class="techSpecTD1">Brand: </td><td class="techSpecTD2">{{ ucwords($productDetails -> getBrand -> name ?? 'No Brand') }}</td></tr>
                            <tr class="techSpecRow"><td class="techSpecTD1">Code:</td><td class="techSpecTD2">{{ ucwords($productDetails -> product_code) }}</td></tr>
                            <tr class="techSpecRow"><td class="techSpecTD1">Color:</td>
                                <td class="techSpecTD2">{{ ucwords($productDetails -> product_color) }}</td>
                            </tr>
                            @if(@$productDetails -> fabric)
                            <tr class="techSpecRow">
                                <td class="techSpecTD1">Fabric:</td>
                                <td class="techSpecTD2">{{ ucwords($productDetails -> fabric) }}</td>
                            </tr>
                            @endif 
                            @if(@$productDetails -> fit)
                            <tr class="techSpecRow"><td class="techSpecTD1">Fit:</td>
                                <td class="techSpecTD2">{{ ucwords($productDetails -> fit) }}</td>
                            </tr>
                            @endif 
                            @if(@$productDetails -> sleeve)
                            <tr class="techSpecRow"><td class="techSpecTD1">Sleeve:</td>
                                <td class="techSpecTD2">{{ ucwords($productDetails -> sleeve) }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    
                    <h5>Washcare</h5>
                    <p>{{ ucwords($productDetails -> wash_care) }}</p>
                    <h5>Disclaimer</h5>
                    <p>
                        There may be a slight color variation between the image shown and original product.
                    </p>
                </div>

                <div class="tab-pane fade" id="profile">
                    <div id="myTab" class="pull-right">
                        <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
                        <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
                    </div>
                    <br class="clr"/>
                    <hr class="soft"/>
                    <div class="tab-content">

                        <div class="tab-pane" id="listView">
                            @foreach($relatedProduct as $item)
                            <div class="row">
                                <div class="span2">
                                    @if($item -> main_image)
                                    <img src="{{URL::to('')}}/media/backend/product/large/{{$item -> main_image}}" alt="" style="width: 160px"/>
                                    @else 
                                    <img src="{{URL::to('')}}/media/no_image.jpg" alt="" style="width: 160px"/>
                                    @endif
                                </div>
                                <div class="span4">
                                    <h3>{{ $item -> getBrand -> name ?? 'No Brand' }} </h3>
                                    <hr class="soft"/>
                                    <h4>{{ $item -> product_name }} </h4>
                                    
                                    <p>
                                        {{ $item -> description }} 
                                    </p>
                                    <a class="btn btn-small pull-right" href="product_details.html">View Details</a>
                                    <br class="clr"/>
                                </div>
                                <div class="span3 alignR">
                                    <form class="form-horizontal qtyFrm">


                                        @php
                                            $discount = Product::getDiscountPrice($item -> id);
                                        @endphp
                                        @if($discount > 0)
                                        <h4 class="getAttrPrice">${{ $discount }}</h4>
                                        <del>${{ $item -> product_price }}</del>
                                        @else
                                        <h4 class="">${{ $item -> product_price }}</h4>
                                        @endif 


                                        <label class="checkbox">
                                            <input type="checkbox">  Adds product to compair
                                        </label><br/>
                                        <div class="btn-group">
                                            <a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
                                            <a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <hr class="soft"/>
                            @endforeach
                            
                        </div> 
                        {{-- end list view --}}

                        <div class="tab-pane active" id="blockView">
                            <ul class="thumbnails">
                                @foreach($relatedProduct as $item)
                                <li class="span3">
                                    <div class="thumbnail" style="text-align: center !important">
                                        <a href="product_details.html">
                                            @if($item -> main_image)
                                            <img src="{{URL::to('')}}/media/backend/product/large/{{$item -> main_image}}" alt="" style="width: 160px"/>
                                            @else 
                                            <img src="{{URL::to('')}}/media/no_image.jpg" alt="" style="width: 160px"/>
                                            @endif
                                        </a>
                                        <div class="caption">
                                            <h4>{{ $item -> product_name }}</h4>
                                            <h5>{{ $item -> getBrand -> name ?? 'No Brand' }} </h5>
                                            <p>
                                                {{ $item -> description }}
                                            </p>
                                            <h4 style="text-align:center">
                                                <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> 
                                                

                                                @php
                                                $discount = Product::getDiscountPrice($item -> id);
                                                @endphp

                                                @if($discount > 0)
                                                <a class="btn btn-primary" href="#">${{ round($discount) }}</a>
                                                <a class="btn btn-primary" href="#" disabled><del>${{ $item -> product_price }}</del></a>
                                                @else
                                                <a class="btn btn-primary" href="#">${{ $item -> product_price }}</a>
                                                @endif

                                            </h4>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            <hr class="soft"/>
                        </div>
                        {{-- end block view --}}

                    </div>
                    <br class="clr">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection