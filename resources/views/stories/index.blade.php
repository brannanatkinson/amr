@extends('layout')

@section('content')
	<div class="ui container">
		    @if (\Request::is('projects/*'))
			    <h1>Mentions for {{ $project->project_name }}</h1>
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
					    	<div class="right floated">
					    		<a href="{{ $story->story_url }}" target="_blank"><i class="ui icon eye"></i></a>
					    	</div>
					    	<div class="story__details">
					    	    <span class="story__date story__weekday">{{ Carbon\Carbon::parse($story->story_date)->format('l,') }}</span>
							    <span class="story__date"><span class="story__day">{{ Carbon\Carbon::parse($story->story_date)->format('M d,') }}</span> </span>
							    <span class="story__year">{{ Carbon\Carbon::parse($story->story_date)->format('Y') }}</span>
							</div>
							@if(strpos($story->story_url, 'twitter') == true )
					        <h3>Twitter</h3>
					        @else
					        <i>{{ $story->org->org_name }}</i>
					        @endif
					    </div>
					    <div class="image">
					    	@if(strpos($story->story_url, 'twitter') == true )
					    	    <img style="height: 200px; object-fit: cover;" src="https://placehold.it/600/1CA1F2/ffffff" alt="" >
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
					        <h3>Twitter</h3>
					        @else
					        <h3>{{$story->headline()}}</h3>
					        @endif
					    </div>
					    <div class="extra content">
					        {{ $story->project->project_name }}
					        @if ( Auth::user()->hasRole('siteadmin') ) 
						        <p>{{ $story->client->client_name }}</p>
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
<div class="ui basic modal">
      <div class="ui icon header">
          Are you sure you want to delete this story?
      </div>
      <div class="actions">
        <div class="ui red basic cancel inverted button">
          <i class="remove icon"></i>
          No
        </div>
        <a id="modalID" href="/stories/{{$story->id}}/delete" class="ui green ok inverted button">
          <i class="checkmark icon"></i>
          Yes
        </a>
      </div>
    </div>
@stop