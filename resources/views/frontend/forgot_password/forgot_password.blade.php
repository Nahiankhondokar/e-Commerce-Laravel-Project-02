@extends('frontend.user_master')

@section('main_content')   
        
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Login or Registration</li>
    </ul>
	<h3> Recover Your Password </h3>	
	<hr class="soft"/>
	
	<div class="row">
		<div class="span4">
			<div class="well" style="text-align: center">
        <h5>FORGOT PASSWORD ? </h5><br/>
        Enter your e-mail address to recover your password<br/><br/>
              
        <form method="POST" action="{{ route('forgot.password') }}">
          @csrf

          <div class="control-group">
            {{-- <label class="control-label" for="inputEmail1">Email</label> --}}
            <div class="controls">
              <input class="span3" type="email"  name="email" id="email" placeholder="Email">
            </div>
          </div>

          <div class="control-group">
            <div class="controls">
              <button type="submit" class="btn block">Submit</button>
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


