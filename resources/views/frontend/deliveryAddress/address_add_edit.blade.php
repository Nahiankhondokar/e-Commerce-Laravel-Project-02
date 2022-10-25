@extends('frontend.user_master')

@section('main_content')   
        
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Delivery Address</li>
    </ul>
	{{-- <h3> {{ $title }}</h3>	 --}}
	<hr class="soft"/>
	
	<div class="row">
		<div class="span4">
			<div class="well" style="text-align: center">
                <h4>{{ $title }}</h4><br/>
                    
                <form id="DeliveryAddressForm" method="POST" action="{{ route('delivery.address.add.edit', @$edit_data -> id) }}">
                    @csrf

                    <div class="control-group">
                        {{-- <label class="control-label" for="inputEmail0">E-mail address</label> --}}
                        <div class="controls">
                            <input type="text" class="span3"  name="name" id="name"  placeholder="Name" @if(@$edit_data -> name) value="{{ @$edit_data -> name }}" @else value="{{ old('name') }}" @endif>
                            <br>
                            @error('name')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    

                    <div class="control-group">
                        {{-- <label class="control-label" for="inputEmail0">E-mail address</label> --}}
                        <div class="controls">
                            <input type="text" class="span3"  name="phone" id="phone"  placeholder="Phone" @if(@$edit_data -> phone) value="{{ @$edit_data -> phone }}" @else value="{{ old('phone') }}" @endif>
                            <br>
                            @error('phone')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="control-group">
                        {{-- <label class="control-label" for="inputEmail0">E-mail address</label> --}}
                        <div class="controls">
                            <input type="text" class="span3"  name="address" id="address"  placeholder="Address" @if(@$edit_data -> address) value="{{ @$edit_data -> address }}" @else value="{{ old('address') }}" @endif>
                            <br>
                            @error('address')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="control-group">
                        {{-- <label class="control-label" for="inputEmail0">E-mail address</label> --}}
                        <div class="controls">
                            <input type="text" class="span3"  name="city" id="city"  placeholder="City" @if(@$edit_data -> city) value="{{ @$edit_data -> city }}" @else value="{{ old('city') }}" @endif><br>
                            @error('city')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="control-group">
                        {{-- <label class="control-label" for="inputEmail0">E-mail address</label> --}}
                        <div class="controls">
                            <select name="country" id="" class="span3" width="100%" >
                                <option value="">Select</option><br>
                                @foreach(@$country as $item)
                                <option value="{{$item -> country_name}}" @if($item -> country_name == @$edit_data -> country) selected @elseif($item -> country_name == old('country')) selected @endif>{{ $item -> country_name }}</option>
                                @endforeach
                                
                            </select>
                            @error('country')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="control-group">
                        {{-- <label class="control-label" for="inputEmail0">E-mail address</label> --}}
                        <div class="controls">
                            <input type="text" class="span3"  name="pincode" id="pincode"  placeholder="Pincode" @if(@$edit_data -> pincode) value="{{ @$edit_data -> pincode }}" @else value="{{ old('pincode') }}" @endif><br>
                            @error('pincode')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="control-group">
                        <div class="controls">
                        <button type="submit" class="btn block">{{ ($edit_data -> id) ? "Update" : "Submit" }}</button>

                        <a href="{{ url('/user/checkout') }}" class="btn btn-sm"><i class="icon-arrow-left"></i> Back to Checkout </a>
                        </div>
                    </div>
                </form>

		    </div>
		</div>

		<div class="span1"> &nbsp;</div>


	</div>	
	
</div>
        
        <!--/ wrapper -->

@endsection


