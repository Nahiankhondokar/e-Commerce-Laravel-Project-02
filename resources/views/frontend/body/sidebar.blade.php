@php
	$section = App\Models\CreateSection::with('getCategory') -> where('status', 1) -> get();
	// dd($section) -> toArray();
@endphp
<div id="sidebar" class="span3">
    <div class="well well-small">
        <a id="myCart" href="{{ url('/cart') }}">
        <img src="frontend/assets/images/ico-cart.png" alt="cart"> <span class="totalCartItem">{{ totalCartItem() }}</span> Items in your cart</a>
    </div>
        <ul id="sideManu" class="nav nav-tabs nav-stacked">
            @foreach($section as $section)
                @if(count($section -> getCategory) > 0)
                    <li class="subMenu"><a>{{ ucwords($section -> name) }}</a>
                        <ul>
                            @foreach($section -> getCategory as $cat)
                            <li>
                                <a href="{{ url('/'.$cat -> url) }}"><i class="icon-chevron-right"></i><strong>{{ $cat -> category_name }}</strong></a>
                            </li>
                                @foreach($cat -> subcategories as $subcat)
                                <li>
                                    <a href="{{ url('/'.$subcat -> url) }}"><i class="icon-chevron-right"></i>{{ $subcat -> category_name }}</a>
                                </li>
                                @endforeach
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
        </ul>
        <br>
        
        @if(@$page_name && $page_name == 'list')
            <div class="well well-small filter-item">
                <h5> Fabric</h5>
                @foreach($fabricArr as $key => $item)
                    <div class="item" style="display: flex">
                        <input class="fabric" type="checkbox" value="{{ $item }}" name="fabric[]" id="fabric-{{$key}}"> <label style="padding-top: 8px; font-weight:600;" for="fabric-{{$key}}">&nbsp; {{ $item }}</label>
                    </div>
                @endforeach
            </div>

            <div class="well well-small filter-item">
                <h5>Sleeve </h5>
                @foreach($sleeveArr as $key => $item)
                    <div class="item" style="display: flex">
                        <input class="sleeve" type="checkbox" value="{{ $item }}" name="sleeve[]" id="slevve-{{$key}}"> <label style="padding-top: 8px; font-weight:600;" for="slevve-{{$key}}">&nbsp; {{ $item }}</label>
                    </div>
                @endforeach
            </div>
            
            <div class="well well-small filter-item">
                <h5>Fit</h5>
                @foreach($fitArr as $key => $item)
                    <div class="item" style="display: flex">
                        <input class="fit" type="checkbox" value="{{ $item }}" name="fit[]" id="fit-{{$key}}"> <label style="padding-top: 8px; font-weight:600;" for="fit-{{$key}}">&nbsp; {{ $item }}</label>
                    </div>
                @endforeach
            </div>

        @endif

        <div class="thumbnail mt-10">
            <img src="frontend/assets/images/payment_methods.png" title="Payment Methods" alt="Payments Methods">
            <div class="caption">
                <h5>Payment Methods</h5>
            </div>
        </div>
</div>