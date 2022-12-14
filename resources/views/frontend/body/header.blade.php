@php
	$section = App\Models\CreateSection::with('getCategory') -> where('status', 1) -> get();
	// dd($section) -> toArray();
@endphp
<div id="header">
	<div class="container">
		<div id="welcomeLine" class="row">
			<div class="span6">Welcome!<strong> User</strong></div>
			<div class="span6">
				<div class="pull-right" id="subscriber_option">
					<input type="text" name="subscriber_email" id="subscriber_email" placeholder="Enter Email...">
					<button class="btn btn-sm btn-info" id="subscriber_btn">Subscribe</button>
					<a href="{{ url('/cart') }}"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [ <span class="totalCartItem">{{ totalCartItem() }}</span>  ] Items in your cart </span> </a>
				</div>
			</div>
		</div>
		<!-- Navbar ================================================== -->
		<section id="navbar">
		  <div class="navbar">
		    <div class="navbar-inner">
		      <div class="container">
		        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		          <span class="icon-bar"></span>
		        </a>
		        <a class="brand" href="{{ url('/') }}">Stack Developers</a>
		        <div class="nav-collapse">
		          <ul class="nav">
		            <li class="active"><a href="#">Home</a></li>
					@foreach($section as $section)
						@if(count($section -> getCategory) > 0)
		            	<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ ucwords($section -> name) }}<b class="caret"> </b>
							</a>
							<ul class="dropdown-menu">
								@foreach($section -> getCategory as $cat)
								<li class="divider"></li>
								<li class="nav-header">
									<a href="{{ url('/'.$cat -> url) }}">{{ $cat -> category_name }}</a>
									@foreach($cat -> subcategories as $subcat)
									<li><a href="{{ url('/'.$subcat -> url) }}">{{ $subcat -> category_name }}</a></li>
									@endforeach
								</li>
								@endforeach
							</ul>
		            	</li>
						@endif
					@endforeach
		            <li><a href="about-us">About</a></li>
		          </ul>
		          <form class="navbar-search pull-left" action="#" method="get">
		            <input name="search" type="text" class="search-query span2" placeholder="Search" width="60%"/>
					<button type="submit" id="searchBtn">Search</button>
		          </form>
		          <ul class="nav pull-right">
		            <li><a href="{{ route('order.view') }}">Orders</a></li>
					<li><a href="{{ route('wishlist.view') }}">Wishlist</a></li>
		            <li class="divider-vertical"></li>
					@if(Auth::check())
					<li><a href="{{ route('myaccount') }}">My Account</a></li>
					<li><a href="{{ route('user.logout') }}">Logout</a></li>
					@else 
					<li><a href="{{ url('/login') }}">Login|Register</a></li>
					@endif
		            

		          </ul>
		        </div><!-- /.nav-collapse -->
		      </div>
		    </div><!-- /navbar-inner -->
		  </div><!-- /navbar -->
		</section>
	</div>
</div>