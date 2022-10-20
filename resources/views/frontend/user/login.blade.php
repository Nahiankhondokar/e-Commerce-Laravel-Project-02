@extends('frontend.user_master')

@section('main_content')
        <!-- wrapper -->
        {{-- <div class="wrapper without_header_sidebar">
            <!-- contnet wrapper -->
            <div class="content_wrapper">
                    <!-- page content -->
                    <div class="login_page center_container">
                        <div class="center_content">
                            <div class="logo">
                                <img src="panel/assets/images/logo.png" alt="" class="img-fluid">
                            </div>

                            @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                            @endif
                
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                
                                <div class="form-group icon_parent">
                                    <label for="password">Email</label>
                                    <input id="email" type="email" class="form-control"  name="email" required autocomplete="email" autofocus placeholder="Email Address" value="{{old('email')}}" >
                                    <span class="icon_soon_bottom_right"><i class="fas fa-envelope"></i></span>
                                 
                                </div>
                                <div class="form-group icon_parent">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" class="form-control"   name="password" required autocomplete="current-password" placeholder="Password">
                                        
                                    <span class="icon_soon_bottom_right"><i class="fas fa-unlock"></i></span>
                                </div>
                                <div class="form-group">
                                    <label class="chech_container">Remember me
                                        <input type="checkbox" name="remember" id="remember" >
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <a class="registration" href="{{ route('register') }}">Create new account</a><br>
                                    <a href="{{ route('password.request') }}" class="text-white">I forgot my password</a>
                                    <button type="submit" class="btn btn-blue">Login</button>
                                </div>
                            </form>
                            <div class="footer">
                               <p>Copyright &copy; 2020 <a href="https://easylearningbd.com/">easy Learning</a>. All rights reserved.</p>
                            </div>
                            
                        </div>
                    </div>
            </div><!--/ content wrapper -->
        </div> --}}
        
        
        
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Login or Registration</li>
    </ul>
	<h3> Login or Registration</h3>	
	<hr class="soft"/>
	
	<div class="row">
		<div class="span4">
			<div class="well" style="text-align: center">
        <h5>CREATE YOUR ACCOUNT</h5><br/>
        Enter your e-mail address to create an account.<br/><br/>
              
        <form id="registerForm" method="POST" action="{{ route('user.register') }}">
          @csrf

          <div class="control-group">
            {{-- <label class="control-label" for="inputEmail0">E-mail address</label> --}}
            <div class="controls">
                <input type="text" class="span3"  name="name" id="name"  placeholder="Name" value="{{old('name')}}" >
            </div>
          </div>

          <div class="control-group">
            {{-- <label class="control-label" for="inputEmail1">Email</label> --}}
            <div class="controls">
              <input class="span3" type="email"  name="email" id="email" placeholder="Email">
            </div>
          </div>

          <div class="control-group">
              {{-- <label class="control-label" for="inputEmail0">E-mail address</label> --}}
              <div class="controls">
                  <input type="text" class="span3"  name="phone" id="phone"  placeholder="Phone" value="{{old('phone')}}" >
              </div>
          </div>

          <div class="control-group">
            {{-- <label class="control-label" for="inputPassword1">Password</label> --}}
            <div class="controls">
              <input type="password" name="password" id="password"  class="span3"  placeholder="Password">
            </div>
          </div>

          <div class="control-group">
            <div class="controls">
              <button type="submit" class="btn block">Create Your Account</button>
            </div>
          </div>
        </form>

		  </div>
		</div>

		<div class="span1"> &nbsp;</div>


		<div class="span4">
			<div class="well" style="text-align: center">
			<h5>ALREADY REGISTERED ?</h5>
		
			<form id="loginForm" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="control-group">
				{{-- <label class="control-label" for="inputEmail0">E-mail address</label> --}}
          <div class="controls">
              <input id="email" type="email" class="form-control"  name="email" placeholder="Email Address" value="{{old('email')}}" >
          </div>
			  </div>

        <div class="control-group">
          {{-- <label class="control-label" for="inputEmail0">Password</label> --}}
          <div class="controls">
            <input id="password" type="password" class="form-control" name="password" placeholder="Password">
          </div>
			  </div>

            

			  <div class="controls">
          <button type="submit" class="btn">Sign in</button> <br>
          <a href="forgetpass.html">Forget password?</a>
			  </div>
			</form>

		</div>
		</div>
	</div>	
	
</div>
        
        <!--/ wrapper -->

@endsection


