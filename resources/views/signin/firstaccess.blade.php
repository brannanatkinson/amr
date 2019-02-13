@extends('layout')

@section('content')

<div class="ui centered grid">
	<div class="left aligned eight wide computer sixteen wide mobile column">
		<h1>Your signin link is ready.</h1>
        <p>Hey, {{ Auth::user()->first_name }}.</p>
		<p>Atkinson Media Reports has created a signin link just for you. The link allows you to access Atkinson Media Reports any time without a username or password.</p>
		<p>We recommend bookmarking (CTRL+D or CMD+D) this page or saving this website address for future use.</p>
        <p>Of course, you can request a new login link at any time in the future.</p>
		<p><a class="ui button primary" id="login_link" href="/stories">Go to Mentions</a></p>
        <div class="ui divider"></div>
        <p>If other people in your organization need access, please <a href="mailto:brannan@amyacommunications.com">email Brannan Atkinson</a>.</p>
	</div>
</div>

@endsection