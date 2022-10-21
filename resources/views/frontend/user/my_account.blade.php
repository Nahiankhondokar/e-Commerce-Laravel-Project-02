@extends('frontend.user_master')

@section('main_content')   
        
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">My Account</li>
    </ul>
	<h3> My Account</h3>	
	<hr class="soft"/>
	
	<div class="row">
		<div class="span4">
			<div class="well" style="text-align: center">
                <h5>Contact Details</h5><br/>
                    
                <form id="UserContactForm" method="POST" action="{{ route('myaccount') }}">
                @csrf

                    <div class="control-group">
                        {{-- <label class="control-label" for="inputEmail0">E-mail address</label> --}}
                        <div class="controls">
                            <input type="text" class="span3"  name="name" id="name"  placeholder="Name" value="{{ $userDetails -> name }}">
                        </div>
                    </div>
                    
                    <div class="control-group">
                        {{-- <label class="control-label" for="inputEmail1">Email</label> --}}
                        <div class="controls">
                        <input class="span3" type="email" id="email" placeholder="Email" readonly value="{{ $userDetails -> email }}">
                        </div>
                    </div>

                    <div class="control-group">
                        {{-- <label class="control-label" for="inputEmail0">E-mail address</label> --}}
                        <div class="controls">
                            <input type="text" class="span3"  name="phone" id="phone"  placeholder="Phone" value="{{ $userDetails -> phone }}">
                        </div>
                    </div>

                    <div class="control-group">
                        {{-- <label class="control-label" for="inputEmail0">E-mail address</label> --}}
                        <div class="controls">
                            <input type="text" class="span3"  name="address" id="address"  placeholder="Address" value="{{old('address')}}" >
                        </div>
                    </div>

                    <div class="control-group">
                        {{-- <label class="control-label" for="inputEmail0">E-mail address</label> --}}
                        <div class="controls">
                            <input type="text" class="span3"  name="city" id="city"  placeholder="City" value="{{old('city')}}" >
                        </div>
                    </div>

                    <div class="control-group">
                        {{-- <label class="control-label" for="inputEmail0">E-mail address</label> --}}
                        <div class="controls">
                            <input type="text" class="span3"  name="country" id="country"  placeholder="Country" value="{{old('country')}}" >
                        </div>
                    </div>

                    <div class="control-group">
                        {{-- <label class="control-label" for="inputEmail0">E-mail address</label> --}}
                        <div class="controls">
                            <input type="text" class="span3"  name="pincode" id="pincode"  placeholder="Pincode" value="{{old('pincode')}}" >
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
                <h5> Password Update </h5>
            
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="control-group">
                        {{-- <label class="control-label" for="inputEmail0">Password</label> --}}
                        <div class="controls">
                            <input id="" type="password" class="form-control" name="current_password" placeholder="Current Password">
                        </div>
                    </div>

                    <div class="control-group">
                        {{-- <label class="control-label" for="inputEmail0">Password</label> --}}
                        <div class="controls">
                            <input id="" type="password" class="form-control" name="new_password" placeholder="New Password">
                        </div>
                    </div>

                    <div class="control-group">
                        {{-- <label class="control-label" for="inputEmail0">Password</label> --}}
                        <div class="controls">
                            <input id="" type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                        </div>
                    </div>

                    <div class="controls">
                        <button type="submit" class="btn">Update Password</button> <br>
                    </div>
                </form>

		    </div>
		</div>
	</div>	
	
</div>
        
        <!--/ wrapper -->

@endsection


