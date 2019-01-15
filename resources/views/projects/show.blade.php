@extends('layout')

@section('content')



	<div class="row">

		<div class="large-12 columns">
			

			<h1>Media -- {{ $project->project_name }}</h1>

		
		</div>
	</div>

	

	<div class="row">
		<div class="large-12 columns">
			<h4>Total Media Mentions: {{ $project->stories->count() }}</h4>
		</div>
	</div>


	<div class="row">
		<div class="large-12 columns">
		

		@foreach ($project->stories as $story)


		@if ( Auth::user()->hasRole('siteadmin') )
			<div class="details"><span class="story__client">{{{ $project->client->client_name }}}</span><span class="story__edit"><a href="/stories/{{ $story->id }}/edit">Edit</a></span></div>
		@endif

		<div class="story">

			<div class="row">
				<div class="large-12 columns">
					<div class="story__details"><span class="story__date story__weekday">{{ Carbon\Carbon::parse($story->story_date)->format('l') }}</span>
					<span class="story__date"><span class="story__day">{{ Carbon\Carbon::parse($story->story_date)->format('M d') }}</span> </span>
					<span class="story__year">{{ Carbon\Carbon::parse($story->story_date)->format('Y') }}</span>
					@if(strpos($story->story_url, 'twitter') == true )
						&nbsp;|&nbsp; <span class="story__media">Twitter</span>
					@else
						&nbsp;|&nbsp;<span class="story__media"><i>{{ $story->org->org_name }}</i></span>
					@endif
					</div>
				</div>
			</div>


			<div class="row">
				
					@if(strpos($story->story_url, 'twitter') == true )
						<div class="large-6 columns">
							<div class="twitterDisplay">{{$story->story_url}}</div>
						</div>
						@if($story->story_notes != '')
						<div class="large-6 columns">
							<p class="story__noteshead">Notes from Amy Atkinson Communications</p>
							<p class="story__notes">{{{ $story->story_notes }}}</p>
						</div>
						@endif
					@else
						<div class="large-4 columns">
							@if ( is_null($story->story_image) )
								<img id="ogImage" src="{{ url ('public/img/' . $story->id . '.jpg') }}" alt=""  class="displayimage">									
							@else
								<img id="ogImage" src="{{ $story->story_image }}" alt="" class="displayimage">
							@endif
						</div>
						<div class="large-8 columns">
							<h3 class="story__headline"><a href="{{{ $story->story_url }}}">{{{ $story->story_headline }}}</a></h3>
							<p class="story__description">{{ $story->story_description }}</p>
							<hr>
							<p class="story__projecthead">PROJECT</p>
							<p class="story__project">{{$project->project_name}}</p>
						
							@if($story->story_notes != '')
								
								<p class="story__noteshead">Notes from Amy Atkinson Communications</p>
								<p class="story__notes">{{{ $story->story_notes }}}</p>
							@endif
						</div>
					@endif
			</div>
		</div>


	@endforeach

		</div>
	</div>
		

	</div>

@stop