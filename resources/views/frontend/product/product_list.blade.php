@extends('frontend.user_master')

@section('main_content')

<div class="span9">
    <ul class="breadcrumb">
        <li><a href="index.html">Home</a> <span class="divider">/</span></li>

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
    
    <div id="myTab" class="pull-right">
        <a href="#listView" data-toggle="tab"><span class="btn btn-large"><i class="icon-list"></i></span></a>
        <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
    </div>
    <br class="clr"/>
    <div class="tab-content">
        <div class="tab-pane" id="listView">
           
            @forelse($catWiseProduct as $item)
                <div class="row">
                    <div class="span2">
                        @if(@$item -> main_image)
                        <img style="width: 160px" src="{{ URL::to('') }}/media/backend/product/large/{{ $item -> main_image}}" alt=""/>
                        @else
                        <img style="width: 160px" src="{{URL::to('')}}/media/no_image.jpg" alt="">
                        @endif
                    </div>
                    <div class="span4">
                        <h3>{{ $item -> getBrand -> name ?? 'No Brand Found' }}</h3>
                        <hr class="soft"/>
                        <h5>{{ $item -> product_name }} </h5>
                        <p>
                            {{ $item -> description ?? "No Description Found" }}
                        </p>
                        <a class="btn btn-small pull-right" href="product_details.html">View Details</a>
                        <br class="clr"/>
                    </div>
                    <div class="span3 alignR">
                        <form class="form-horizontal qtyFrm">
                            <h3> ${{ $item -> product_price }}</h3>
                            <label class="checkbox">
                                <input type="checkbox">  Adds product to compare
                            </label><br/>
                            
                            <a href="product_details.html" class="btn btn-large btn-primary"> Add to <i class=" icon-shopping-cart"></i></a>
                            <a href="product_details.html" class="btn btn-large"><i class="icon-zoom-in"></i></a>
                            
                        </form>
                    </div>
                </div>
            @empty 
                <h4 style="color: red!important; text-align: center;">Data Not Found</h4>
            @endforelse
          
            <hr class="soft"/>
        </div>


        <div class="tab-pane  active" id="blockView">
            <ul class="thumbnails">
               
                @forelse($catWiseProduct as $item)
                    <li class="span3">
                        <div class="thumbnail">
                            <a href="product_details.html">
                                @if(@$item -> main_image)
                                <img style="width: 160px" src="{{ URL::to('') }}/media/backend/product/large/{{ $item -> main_image}}" alt=""/>
                                @else
                                <img style="width: 160px" src="{{URL::to('')}}/media/no_image.jpg" alt="">
                                @endif
                            </a>
                            <div class="caption">
                                <h5>{{ $item -> product_name }} {{ $item -> id }}</h5>
                                <p>
                                    {{ $item -> getBrand -> name ?? 'No Brand Found' }}
                                </p>
                                <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">${{ $item -> product_price }}</a></h4>
                            </div>
                        </div>
                    </li>
                @empty
                    <h4 style="color: red!important; text-align: center;">Data Not Found</h4>
                @endforelse
                
            </ul>
            <hr class="soft"/>
        </div>
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