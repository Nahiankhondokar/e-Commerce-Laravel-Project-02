@php
    use App\Models\Banner;
    $getBanner = Banner::getAllBanner();
    // dd($getBanner);
@endphp

@if(@$page_name && $page_name == 'index')
    <div id="carouselBlk">
        <div id="myCarousel" class="carousel slide">
            <div class="carousel-inner">
                @foreach($getBanner as $key => $item)
                <div class="item {{ ($key == 0) ? 'active' : '' }}">
                    <div class="container">
                        <a href="{{ url(@$item['link']) }}"><img style="width:100%" src="{{URL::to('')}}/media/backend/banner/{{$item['image']}}" alt="{{ @$item['alt'] }}" title="{{ @$item['title'] }}"/></a>
                    </div>
                </div>
                @endforeach
            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
        </div>
    </div>
@endif