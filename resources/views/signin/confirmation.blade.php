@extends('layout')

@section('content')

        <div class="ui centered grid">
        	<div class="left aligned eight wide column">
        		@if ( $confirmation_details['msg'] == 1 )
        		<h2>Great.</h2>
        		<p>We've sent you a signin link. Check your email for a message from brannan@amyacommunications.com.</p>
                        <p>Please <a href="mailto:brannan@amyacommunications.com">contact Brannan</a> if you don't receive it.</p>
        		@else
        		<h2>Something Went Wrong</h2>
        		<p>We didn't find your email in our list.</p>
        		<p>Please <a href="/signin">try again</a> or contact brannan@amyacommunications.com.</p>
        		@endif
        	</div>
        </div>

@endsection