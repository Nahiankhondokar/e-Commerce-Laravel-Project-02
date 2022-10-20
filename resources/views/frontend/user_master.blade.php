<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Stack Developers online Shopping cart</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
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
	<!-- fav and touch icons -->
	<link rel="shortcut icon" href="{{asset('frontend/assets/images/ico/favicon.ico')}}">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('frontend/assets/images/ico/apple-touch-icon-144-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('frontend/assets/images/ico/apple-touch-icon-114-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('frontend/assets/images/ico/apple-touch-icon-72-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" href="{{asset('frontend/assets/images/ico/apple-touch-icon-57-precomposed.png')}}">
	<style type="text/css" id="enject"></style>

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

</body>
</html>