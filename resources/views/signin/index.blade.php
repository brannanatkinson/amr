@extends('layout')

@section('content')

    <div class="ui middle aligned centered grid signin_form">
        
    	<div class="left aligned ten wide column">
            <div>
                <h2>Secure Login Link</h2>
                <p>Atkinson Media Reports now uses secure login links sent via email instead of usernames and passwords.</p>
        		<p>Please enter your email address below.</p>
                <p>We'll send your a login link once we confirm your email address.</p>
        		<form class="ui form" action="/signin" method="POST">
        			{{ csrf_field() }}
                    
                        <div class="ui field">
                            <input type="text" name="email" placeholder="email address">
                        </div>
                        <div class="ui field">
                            <button class="ui button" type="submit">Request Login Link</button>
                        </div>
                    
        		</form>
        	</div>
            <div style="padding-top: 30px;">
                <hr>
                <h4>How Secure Login Links Work</h4>
                <p style="font-size: .75em;">Amy Atkinson Communications has created a secure login link for each client. The link allows you to see
                all the media mentions and projects for your orgization without having to remember a username and password.</p>
                <p style="font-size: .75em;">The secure login doesn't expire. You can save the email to log in at any time. Or, you can create a bookmark in your browser.</p>
                <p style="font-size: .75em;">Recovering your link is easy. Go to atkinsonmediareports.com and follow the instructions.</a> </p>
                <p style="font-size: .75em;">Please contact Brannan Atkinson at brannan@amyacommunications.com if you have any issues.</p>
            </div>
        </div>
    </div>
@endsection