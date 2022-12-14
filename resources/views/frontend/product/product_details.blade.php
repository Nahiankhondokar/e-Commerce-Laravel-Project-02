@php
    use App\Models\Product;
    use Carbon\Carbon;
    use App\Models\Wishlist;
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
            <?php
                @$count = 0;
                while($count < @$averageRating){
            ?>
            <span>&#9733;</span> 
            <?php $count++; } ?>
            ({{ ($averageRating) ? $averageRating : "No Rating";}})
            <hr class="soft"/>

            @if(count($groupCode) > 0)
                <strong>More Colors</strong>
                @foreach($groupCode as $item)
                <div class="group-product">
                    @if($item['main_image'])
                    <a href="{{ route('product.details', $item['id']) }}">
                        <img src="{{URL::to('')}}/media/backend/product/large/{{@$item['main_image']}}" alt="" style="width: 60px"/>
                    </a>
                    @else 
                    <a href="{{ route('product.details', $item['id']) }}">
                        <img src="{{URL::to('')}}/media/no_image.jpg" alt="" style="width: 60px"/>
                    </a>
                    @endif
                    {{-- <p>{{ $item['product_name'] }}</p> --}}
                </div>
                @endforeach
            @endif

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
                    <h5 class="getAttrPriceWithDiscount"><del>${{ $productDetails -> product_price }}</del> - ${{ $discount }} 
                        
                    </h5>
                    @else
                    <h5 id="getAttrPriceWithOutDiscount">${{ $productDetails -> product_price }} </h5>
                    @endif 

                    <h5 class="currencie_items">
                        @foreach($all_currencie as $item)
                        {{ $item['currnecie_code'] }}  {{ round($productDetails -> product_price/$item['currnecie_rate'], 2) }} &nbsp; &nbsp;
                        @endforeach
                    </h5>

                    @error('quantity')
                        <span class="text-danger" style="color: red">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @error('size')
                    <span class="text-danger" style="color: red">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <select name="size" id="getPrice" product_id="{{ $productDetails -> id }}" class="span2 pull-left" >

                            <option value="">Select</option>
                            @foreach($productDetails -> getProductAttr as $item)
                            <option value="{{ $item -> size }}">{{ $item -> size }}</option>
                            @endforeach

                        </select> 
                        
                        <input type="number" class="span1" placeholder="Qty." name="quantity" />
            
                        <button type="submit" class="btn btn-large btn-primary pull-right"> Add to cart <i class=" icon-shopping-cart"></i></button> 

                        @if(Auth::check())
                        @php
                            $wishlistCount = Wishlist::getWishlistData($productDetails -> id);
                        @endphp
                            <a href="" class="btn btn-large btn-primary pull-right" style="margin-right: 5px" id="updateWishlist" product_id="{{$productDetails -> id}}"> Wishlist <i @if($wishlistCount > 0) class="icon-heart" @else class="icon-heart-empty" @endif ></i></a>
                        @else 
                            <a href="" class="btn btn-large btn-primary pull-right" id="wishlistUserLogin" style="margin-right: 5px">Wishlist <i class=" icon-heart-empty"></i></a>
                        @endif

                        <div class="postal-code-check d-flex">
                            <strong>Delivery</strong><br>
                            <div class="postal-input-tags">
                                <input type="number" placeholder="Postal Code" name="postal_code" class="form-control" class="span1" id="postal_code">
                                <input type="button" class="btn btn-sm" id="postalCheckBtn" value="Go">
                            </div>
                        </div>
                        <br>
                        <!-- social media share icons Addthis package -->
                        <div class="addthis_inline_share_toolbox"></div>
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
                @if(@$productDetails -> product_video)
                <li><a href="#video" data-toggle="tab">Product Video</a></li>
                @endif
                <li><a href="#review" data-toggle="tab">Product Review</a></li>

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
                @if(@$productDetails -> product_video)
                <div class="tab-pane fade" id="video">
                    <video src="{{ url('media/backend/product/videos/'.$productDetails -> product_video) }}" type="video/mp4" controls="" width="640" height="480"></video>
                </div>
                @endif

                <div class="tab-pane fade" id="review">
                    <div class="row">
                        <div class="span4">
                            <h4>Write Your Review</h4>
                            <form action="{{ route('add.rating') }}" method="post" name="ratingForm" id="ratingForm">
                                @csrf
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                                <div class="form-group">
                                    <textarea name="review" cols="0" rows="0" placeholder="Write Your Review" style="width: 100%" required></textarea> 
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="hidden" name="product_id" value="{{ $productDetails -> id }}">
                                </div>
                                <input type="submit" value="Submit" class="btn btn-info btn-sm">
                            </form>
                        </div>
                        <div class="span4">
                            <h3>User Reviews</h3>
                            @if(count($ratings) > 0)
                                @foreach($ratings as $item)
                                    <div>
                                        <?php
                                            $count = 0;
                                            while($count < $item['rating']){
                                        ?>
                                        <span>&#9733;</span>
                                        <?php $count++; } ?>

                                        <p>By {{ $item['get_user']['name'] }}</p>
                                        <p> {{ Carbon::parse($item['created_at'])->diffForHumans(); }}</p>
                                        <p>--{{ $item['review'] }}</p>
                                        
                                    </div>
                                    <hr>
                                @endforeach
                            @else 
                                <b style="color: red">No Reviews are available</b>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection