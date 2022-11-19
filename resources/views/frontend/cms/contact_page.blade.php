@extends('frontend.user_master')

@section('main_content')

<div id="mainBody">
    <div class="container">	
        <div class="row">
            <div class="span4"> 
                <h4>Contact Details</h4>
                <p>	18 Fresno,<br/> CA 93727, USA
                    <br/><br/>
                    info@sitemakers.in<br/>
                    ﻿Tel 00000-00000<br/>
                    Fax 00000-00000<br/>
                    web: https://www.youtube.com/StackDevelopers
                </p>		
            </div> 
            
            <div class="span4">
                <h4>Email Us</h4>
                <form class="form-horizontal" action="{{ route('contact') }}" method="post" autocomplete="off">
                    @csrf
                    <fieldset>
                    <div class="control-group">
                    
                        <input type="text" placeholder="name" class="input-xlarge" name="name"/>
                        <br>
                        @error('name')
                            <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="control-group">
                    
                        <input type="text" placeholder="email" class="input-xlarge" name="email"/>
                    
                    </div>
                    <div class="control-group">
                    
                        <input type="text" placeholder="subject" class="input-xlarge" name="subject"/>
                    
                    </div>
                    <div class="control-group">
                        <textarea rows="3" id="textarea" class="input-xlarge" name="message"></textarea>
                        <br>
                        @error('message')
                            <span style="color: red;">{{$message}}</span>
                        @enderror
                    </div>
            
                        <button class="btn btn-large" type="submit">Send Messages</button>
            
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    </div>

@endsection