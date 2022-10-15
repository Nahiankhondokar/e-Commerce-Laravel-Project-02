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
                    <h5>{{ $item -> fabric }}</h5>
                    <h5>{{ $item -> sleeve }}</h5>
                </div>
            </li>
        @empty
            <h4 style="color: red!important; text-align: center;">Data Not Found</h4>
        @endforelse
        
    </ul>
    <hr class="soft"/>
</div>