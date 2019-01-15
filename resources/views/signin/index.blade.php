@extends('layout')

@section('content')

    <div class="ui middle aligned centered grid signin_form">
        
    	<div class="left aligned eight wide column">
            <div class="ui segment">
    		<p>Please enter your email address. We'll send your a login link once we confirm your email address.</p>
    		<form class="ui form" action="/signin" method="POST">
    			{{ csrf_field() }}
                
                    <div class="ui field">
                        <input type="text" name="email" placeholder="email address">
                    </div>
                    <div class="ui field">
                        <button class="ui button" type="submit">Get Login Link</button>
                    </div>
                
    		</form>
    	</div>
        </div>
    </div>
@endsection