@extends('layout')

@section('content')
	<div class="ui container">
		    @if (\Request::is('projects/*'))
			    <h1 class="ui header">
					{{ $project->project_name }}
				   <div class="sub header">{{ $project->client->client_name }}</div>

				</h1>
				@if ( !(\Request::is('*/share')) )
					<div class="ui segment">
					
					<p>Public URL for sharing. Copy and paste to share this project.</p>
				    <pre>http://www.atkinsonmediareports.com/projects/{{ $project->project_share_id }}/share</pre>
				    </div>
			    @endif
			    <hr>
			    <h1 class="ui header">
					Mentions
				   <div class="sub header">{{ $project->stories->count() }} Mentions</div>
				</h1>	
			@else 
				@if ( Auth::user()->hasRole('siteadmin') && \Request::is('clients/*') ) 
				    @php
				    	$url = explode('/', request()->path() );
				    	$client = array_pop($url);
				    @endphp
					<h1>Mentions for {{ App\Client::find($client)->client_name }}</h1>
				
				@endif
			@endif
		
		<div class="ui three stackable cards">
			@foreach ($stories as $story)
				<div class="ui raised card">
					    <div class="content">
					    	{{-- <div class="right floated">
					    		<a href="{{ $story->story_url }}" target="_blank"><i class="large grey play icon"></i></a>
					    	</div> --}}
					    	<div class="story__details">
					    	    <span class="story__date story__weekday">{{ Carbon\Carbon::parse($story->story_date)->format('l,') }}</span>
							    <span class="story__date"><span class="story__day">{{ Carbon\Carbon::parse($story->story_date)->format('M d,') }}</span> </span>
							    <span class="story__year">{{ Carbon\Carbon::parse($story->story_date)->format('Y') }}</span>
							</div>
							 <i>{{ $story->org->org_name }}</i>
							{{-- @if(strpos($story->story_url, 'twitter') == true )
					            <h3>Twitter</h3>
					        @else
					            <i>{{ $story->org->org_name }}</i>
					        @endif --}}
					    </div>
					    <div class="image">
					    	@if(strpos($story->story_url, 'twitter') == true )
					    	    <img style="height: 200px; object-fit: cover;" src="/img/twitter_logo.png" alt="" >
					    	@else
						        @if ( is_null($story->story_image) )
									<img style="height: 200px; object-fit: cover;" src="{{ url ('/img/' . $story->id . '.jpg') }}" alt="">																			
							    @else
									<img style="height: 200px; object-fit: cover;" src="{{ $story->story_image }}" alt="" >
								{{-- @elseif(strpos($story->story_url, 'twitter') == true )
									<h3>placeholder:twitter</h3> --}}
							    @endif
						    @endif
					    </div>
					    <div class="content">
					        @if(strpos($story->story_url, 'twitter') == true )
					            <a href="{{ $story->story_url }}" target="_blank"><h3>View Tweet</h3></a>
					        @else 
					            <a href="{{ $story->story_url }}" target="_blank"><h3>{{ str_limit( $story->headline(), $limit = 60, $end = '...') }}</h3></a>
					            @if ( $story->notes() )
					                <p style="padding-top: 20px;">Notes: {{ $story->notes() }}</p>
					            @endif
					        @endif
					    </div>
					    <div class="extra content">
					        {{ $story->project->project_name }}
					        @if ( Auth::user()->hasRole('siteadmin') ) 
						        <p>{{ $story->getClientName() }}</p>
					        @endif
					        @if ( Auth::user()->hasRole('siteadmin') ) 
					            <a class="deleteStory right floated ui button" data-id="{{ $story->id }}">Delete</a>
						        <a class="right floated ui button" href="/stories/{{ $story->id }}/edit">Edit</a>

					        @endif
					    </div>
			    </div>
			@endforeach
		</div>
		
	</div>

{{ $stories->links() }}


		</div>
	</div>
		

	</div>

@stop