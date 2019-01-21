@extends('layout')

@section('content')

<div class="ui centered grid">
	<div class="left aligned eight wide computer sixteen wide mobile column">
		<h1>Your signin link is ready.</h1>
		<p>Atkinson Media Reports has created a signin link just for you. The link allows you to access Atkinson Media Reports any time without a username or password.</p>
		<p>We recommend bookmarking (CTRL+D or CMD+D) this page or saving this website address for future use.</p>
        <p>Of course, you can request a new login link at any time in the future.</p>
        <form method="POST" action="/ajax/loginlink">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <div class="ui checkbox" style="padding: 20px 0px 30px;">
                <input type="checkbox" id="login_link">
                <label>Yes, I have bookmarked this page or saved  the link.</label>
            </div>
        </form>
		<p><a class="ui button disabled primary" id="btn_stories" href="/stories">Go to Mentions</a></p>
        <div class="ui divider"></div>
        <p>If other people in your organization need access, please <a href="mailto:brannan@amyacommunications.com">email Brannan Atkinson</a>.</p>
	</div>
</div>

@endsection