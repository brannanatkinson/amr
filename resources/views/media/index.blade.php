@extends('layout')

@section('content')
<a name="top"></a>
<div class="ui grid container">
	<div class="sixteen wide column">
		<h2>Media Outlets</h4>
	</div>
	<div style="text-align: center; line-height: 2;">
		@foreach ($outlets as $outlet)
			<a style="margin: 0px 16px;" href="#{{$outlet->id}}">{{ $outlet->org_name }}</a>
		@endforeach
	</div>
	<div class="sixteen wide column">
			@foreach ($outlets as $outlet)
				<a name="{{$outlet->id}}"></a>
				<h2 style="font-weight: bolder; padding-top: 20px;">{{ $outlet->org_name }} <a class="ui label" style="float:right; " href="#top">Back to Top</a></h2> 
				<!-- <div style="margin-top: -10px; " class="media__count">~ Mentions: {{ $outlet->stories(Auth::user()->client_id)->count() }} ~</div> 
				@if ($outlet->stories(Auth::user()->client_id)->count() > 0)
                    <ul>
					@foreach ($outlet->stories(Auth::user()->client_id)->get() as $story)
			        	<li style="margin-bottom: 8px;"><a href="{{ $story->story_url }}">{{ $story->headline() }}</a><br> <span>{{ \Carbon\Carbon::parse($story->story_date)->toFormattedDateString() }} -- {{ $story->project->project_name }}</span></li>
					@endforeach
					</ul>
				@endif -->
			@endforeach
	</div>
</div>

@stop