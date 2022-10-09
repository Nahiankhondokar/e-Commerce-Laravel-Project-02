@php
	$section = App\Models\CreateSection::with('getCategory') -> where('status', 1) -> get();
	// dd($section) -> toArray();
@endphp
<div id="sidebar" class="span3">
    <div class="well well-small"><a id="myCart" href="product_summary.html"><img src="frontend/assets/images/ico-cart.png" alt="cart">3 Items in your cart</a></div>
    <ul id="sideManu" class="nav nav-tabs nav-stacked">
        @foreach($section as $section)
            @if(count($section -> getCategory) > 0)
                <li class="subMenu"><a>{{ ucwords($section -> name) }}</a>
                    <ul>
                        @foreach($section -> getCategory as $cat)
                        <li>
                            <a href="products.html"><i class="icon-chevron-right"></i><strong>{{ $cat -> category_name }}</strong></a>
                        </li>
                            @foreach($cat -> subcategories as $subcat)
                            <li><a href="products.html"><i class="icon-chevron-right"></i>{{ $subcat -> category_name }}</a></li>
                            @endforeach
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach
    </ul>
    <br/>
    <div class="thumbnail">
        <img src="frontend/assets/images/payment_methods.png" title="Payment Methods" alt="Payments Methods">
        <div class="caption">
            <h5>Payment Methods</h5>
        </div>
    </div>
</div>