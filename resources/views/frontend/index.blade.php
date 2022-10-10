@extends('frontend.user_master')
@section('main_content')

<div class="span9">
    <div class="well well-small">
        <h4>Featured Products <small class="pull-right">{{$featureItemCount}} featured products</small></h4>
        <div class="row-fluid">
            <div id="featured" class="{{ ($featureItemCount > 4) ? 'carousel slide' : '' }}">
                <div class="carousel-inner">
                    @foreach($featureItemChunk as $key => $chunkItem)
                    <div class="item {{ $key == 0 ?? 'active' }}">
                        <ul class="thumbnails">
                            @foreach($chunkItem as $key => $item)
                            <li class="span3">
                                <div class="thumbnail">
                                    <i class="tag"></i>
                                    <a href="product_details.html">
                                        @if(@$item['main_image'])
                                        <img src="{{URL::to('')}}/media/backend/product/large/{{ $item['main_image'] }}" alt="" style="height: 160px">
                                        @else
                                        <img src="{{URL::to('')}}/media/no_image.jpg" alt="" style="height: 160px">
                                        @endif
                                    </a>
                                    <div class="caption">
                                        <h5>{{ $item['product_name'] }}</h5>
                                        <h4><a class="btn" href="">VIEW</a> <span class="pull-right">$ {{ $item['product_price'] }}</span></h4>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>
                {{-- <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
                <a class="right carousel-control" href="#featured" data-slide="next">›</a> --}}
            </div>
        </div>
    </div>
    <h4>Latest Products </h4>
    <ul class="thumbnails">
        @foreach($new_product_arr as $key => $latest)
        <li class="span3">
            <div class="thumbnail">
                <a href="product_details.html">
                    @if(@$latest -> main_image)
                    <img src="{{URL::to('')}}/media/backend/product/large/{{ $latest -> main_image }}" alt="" style="height: 160px">
                    @else
                    <img src="{{URL::to('')}}/media/no_image.jpg" alt="" style="height: 160px">
                    @endif
                </a>
                <div class="caption">
                    <h5>{{ $latest -> product_name }}</h5>
                    <p>
                        {{ $latest -> description  }}
                    </p>
                    
                    <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
</div>

@endsection