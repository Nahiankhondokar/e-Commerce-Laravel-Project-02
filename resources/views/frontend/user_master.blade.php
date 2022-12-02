<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	@if (!empty($meta_title))
	<title>{{ ucwords($meta_title) }}</title>
	@else
	<title>Stack Developers online Shopping cart</title>
	@endif

	@if (!empty($meta_description))
	<meta name="description" content="{{$meta_description}}">
	@else
	<meta name="description" content="This is an e-commerce online">
	@endif

	@if (!empty($meta_keywords))
	<meta name="keywords" content="{{$meta_keywords}}">
	@else
	<meta name="keywords" content="e-commerce, shop, webiste, course, laravel, php">
	@endif

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="">
	
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<!-- Front style -->
	<link id="callCss" rel="stylesheet" href="{{asset('')}}frontend/assets/css/front.min.css" media="screen"/>
	<link href="{{asset('frontend/assets/css/base.css')}}" rel="stylesheet" media="screen"/>
	<!-- Front style responsive -->
	<link href="{{asset('frontend/assets/css/front-responsive.min.css')}}" rel="stylesheet"/>
	<link href="{{asset('frontend/assets/css/font-awesome.css')}}" rel="stylesheet" type="text/css">
	<!-- Google-code-prettify -->
	<link href="{{asset('frontend/assets/js/google-code-prettify/prettify.css')}}" rel="stylesheet"/>

	<!-- Font Awesome --> 
	<link rel="stylesheet" href="{{ asset('frontend/assets/fontawesome-free/css/all.min.css') }}">

	<!-- fav and touch icons -->
	<link rel="shortcut icon" href="{{asset('frontend/assets/images/ico/favicon.ico')}}">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('frontend/assets/images/ico/apple-touch-icon-144-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('frontend/assets/images/ico/apple-touch-icon-114-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('frontend/assets/images/ico/apple-touch-icon-72-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" href="{{asset('frontend/assets/images/ico/apple-touch-icon-57-precomposed.png')}}">
	<style type="text/css" id="enject"></style>

	<!-- CSS File -->
	<link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet"/>

	{{-- Toster css file --}}
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
	
	{{-- // js validation css --}}
	<style>
		form.cmxform label.error, label.error {
		color: red;
		font-style: italic;
		}
	</style>

</head>
<body>

<!-- Header ================================================== -->
    @include('frontend.body.header')
<!-- Header end ================================================== -->
    @include('frontend.banner.banner')
<!-- Header End====================================================================== -->


<div id="mainBody">
	<div class="container">
		<div class="row">
			<!-- Sidebar ================================================== -->
			    @include('frontend.body.sidebar')
			<!-- Sidebar end=============================================== -->
                @yield('main_content')
		</div>
	</div>
</div>
<!-- Footer ================================================================== -->
    @include('frontend.body.footer')   
<!-- Placed at the end of the document so the pages load faster ============================================= -->

{{-- jQuery validate file --}}
<script src="{{asset('frontend/assets/js/jquery.js')}}" type="text/javascript"></script>
<script src="{{asset('frontend/assets/js/jquery.validate.js')}}" type="text/javascript"></script>

{{-- // sweet alert file --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{asset('frontend/assets/js/front.min.js')}}" type="text/javascript"></script>
<script src="{{asset('frontend/assets/js/google-code-prettify/prettify.js')}}"></script>


{{-- // custom js file --}}
<script src="{{asset('frontend/assets/js/custom.js')}}"></script>

<script src="{{asset('frontend/assets/js/front.js')}}"></script>
<script src="{{asset('frontend/assets/js/jquery.lightbox-0.5.js')}}"></script>

{{-- Toster js file --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-62df8b6973625adf"></script>

  {{-- // Toster --}}
  <script>
    
    @if (Session::has('message'))
    let type = "{{ Session::get('alert-type', 'info') }}"
    switch(type){
        case 'info':
        toastr.info("{{ Session::get('message') }}");
        break;
        case 'success':
        toastr.success("{{ Session::get('message') }}");
        break;
        case 'warning':
        toastr.warning("{{ Session::get('message') }}");
        break;
        case 'error':
        toastr.error("{{ Session::get('message') }}");
        break;  
    }
        
  @endif

</script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	(function(){
	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	s1.async=true;
	s1.src='https://embed.tawk.to/638a5f3bb0d6371309d25d3c/1gja880i9';
	s1.charset='UTF-8';
	s1.setAttribute('crossorigin','*');
	s0.parentNode.insertBefore(s1,s0);
	})();
	</script>
	<!--End of Tawk.to Script-->

</body>
</html>