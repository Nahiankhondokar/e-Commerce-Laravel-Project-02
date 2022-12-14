@php
    use App\Models\Product;
@endphp

<div class="tab-pane  active" id="blockView">
    <ul class="thumbnails">
       
        @forelse($catWiseProduct as $item)
        
            <li class="span3">
                <div class="thumbnail">
                    <a href="{{route('product.details', $item -> id)}}">
                        @if(@$item -> main_image)
                        <a href="{{ route('product.details', $item -> id) }}">
                            <img style="width: 160px" src="{{ URL::to('') }}/media/backend/product/large/{{ $item -> main_image}}" alt=""/>
                        </a>
                        @else
                        <img style="width: 160px" src="{{URL::to('')}}/media/no_image.jpg" alt="">
                        @endif
                    </a>
                    <div class="caption">
                        <h5>{{ $item -> product_name }}</h5>
                        <p>
                            {{ $item -> getBrand -> name ?? 'No Brand Found' }}
                        </p>
                        <h4 style="text-align:center">
                            {{-- <a class="btn" href="{{route('product.details', $item -> id)}}"> <i class="icon-zoom-in"></i></a>  --}}

                            <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> 
                            
                            @php
                                $discount = Product::getDiscountPrice($item -> id);
                            @endphp
                            @if(@$discount > 0)
                            <a class="btn btn-primary" href="#">${{ $discount }}</a>
                            <a class="btn btn-primary" href="#" disabled><del>${{ $item -> product_price }}</del></a>
                            @else
                            <a class="btn btn-primary" href="#">${{ $item -> product_price }}</a>
                            @endif

                        </h4>
                    </div>

                    {{-- // debug perpouse --}}
                    {{-- <h5>{{ $item -> fabric }}</h5>
                    <h5>{{ $item -> sleeve }}</h5>
                    <h5>{{ $item -> fit }}</h5> --}}
                    
                </div>
            </li>
        @empty
            <h4 style="color: red!important; text-align: center;">Data Not Found</h4>
        @endforelse
        
    </ul>
    <hr class="soft"/>
</div>