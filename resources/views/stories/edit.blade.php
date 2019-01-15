@extends('layout')

@section('content')

		<div class="row">
			<div class="large-12 columns">
				<h1 id="page_title">Edit Story</h1>
			</div>
		</div>

		@foreach ($stories as $story)

		<form action="/stories/{{ $story->id}}" method="POST" enctype="multipart/form-data">{{ csrf_field() }}{{ method_field('PATCH')}}
		<div class="row">
			<div class="large-6 columns">
				<label for="datepicker">Story Date</label>
				<input type="text" id="story_date" name="story_date" value="{{ $story->story_date }}">
			</div>
		</div>

		<div class="row">
			<div class="large-6 columns">
				<label for="client_id">Client</label>
				<select name="client_id" id="clientSelect">
					<option value="" disabled selected hidden>Choose client...</option>
					@foreach ($clients as $client)
						@if ($client->id == $story->client_id)
							<option value="{{ $client->id }}" selected>{{ $client->client_name }}</option>
						@else
							<option value="{{ $client->id }}">{{ $client->client_name }}</option>
						@endif
					@endforeach
				</select>
			</div>
			<div class="large-6 columns">
				{{-- Project --}}
				<label for="project_id">Client Project</label>
				<select name="project_id" id="projectSelect">

					<option value="" disabled selected hidden>Select project...</option>
					@foreach ($projects as $project)
						@if ( $project->client_id == $story->client_id )
							@if ( $story->project_id == $project->id ) 
								<option value="{{ $project->id }}" selected>{{ $project->project_name }}</option>
							@else 
								<option value="{{ $project->id }}" >{{ $project->project_name }}</option>
							@endif 
						@endif
					@endforeach
				  	   
				</select>
				<button type="button" class="button" id="addNewProject">Add New Project</button>
			</div>

		</div>
		<div class="row">
			<div class="large-12 columns">
				<label for="story_url">Story URL</label>
				<input type="text" name="story_url" value="{{ $story->story_url }}">
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				{{-- twitter display --}}
				<div id="twitterOembed"></div>
				<label for="story_headline">Story Headline</label>
				<input type="text" name="story_headline" value="{{ $story->story_headline }}">
			</div>
		</div>
		<div class="row">
				<div class="large-8 columns">
					@if ( is_null($story->story_image) )
						<img id="ogImage" src="{{ url ('/img/' . $story->id . '.jpg') }}" alt="" width="600">									
					@else
						<img id="ogImage" src="{{ $story->story_image }}" alt="" width="600">
					@endif
					<input type="hidden" id="story_image" name="story_image" value="{{ $story->story_image }}" readonly>
				</div>
				<div class="large-4 columns">
					<h3>Add a photo</h3>
					<input type="file" name="story_file" id="story_file" onchange="readURL(this);">
				</div>
			</div>
		<div class="row">
			<div class="large-12 columns">
				<label for="story_description">Story Description (typically story lede)</label>
				<input type="text" name="story_description" value="{{ $story->story_description }}">
			</div>
		</div>
		<div class="row">
			<div class="large-6 columns">
				{{-- Media --}}
				<label for="media_id">Media</label>
				<select name="media_id" id="mediaSelect">

					<option value="" disabled selected hidden>Select media outlet...</option>
					
					@foreach ($orgs as $outlet)
						@if ( $outlet->id == $story->org_id )
							<option value="{{ $outlet->id }}" selected>{{ $outlet->org_name }}</option>
						@else
							<option value="{{ $outlet->id }}">{{ $outlet->org_name }}</option>
						@endif
					@endforeach

				</select>

				<button type="button" id="addNewMedia" class="button">Add New Media</button>
			</div>

			<div class="large-6 columns">
				<label for="contactSelect">Choose Contact</label>
				<select name="contact_id" id="contactSelect">
					<option value="0" selected="selected" disabled hidden>Choose contact...</option>

					@foreach ($contacts as $contact)
						@if ( $contact->id == $story->contact_id )
							<option value="{{ $contact->id }}" selected>{{ $contact->contact_first_name }} {{ $contact->contact_last_name }}</option>
						@else
							<option value="{{ $contact->id }}">{{ $contact->contact_first_name }} {{ $contact->contact_last_name }}</option>
						@endif
					@endforeach
					
				</select>
				{{-- <button type="button" id="addNewMedia" class="button">Add New Media</button> --}}
			</div>
			
		</div>
		<div class="row">
			<div class="large-6 columns">
				<label for="story_notes">Notes</label>
				<textarea name="story_notes" id="story_notes" cols="30" rows="10">{{ $story->story_notes }}</textarea>
			</div>
		</div>
		<div class="row">
			<div class="large-12 columns">
				<button type="submit" class="button primary">Update Mention</button>
			</div>
		</div>		
		</form>
		
		{{-- modal for Media --}}
		<div class="reveal" id="mediaModal" data-reveal>
		  	<form action="">
		  	{{ csrf_field() }}
		  	<label for="addMedia">Add Media</label>
			<input type="text" name="addMedia" id="addMedia">
			<label for="mediaURL">Media URL</label>
			<input type="text" name="mediaURL" id="mediaURL">
		  	<button id='btn-save-media' class='button success'>Save New Media</button>
		  	<button class="close-button" data-close aria-label="Close modal" type="button">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </form>

		</div>

		{{-- modal for Reporters --}}
		<div class="reveal" id="reporterModal" data-reveal>
		  	<form action="">
		  	{{ csrf_field() }}
			<label for="addReporterFirst">Reporter First Name</label>
			<input type="text" name="ReporterModalFirst">
			<label for="addReporterLast">Reporter Last Name</label>
			<input type="text" name="ReporterModalLast">
		  	<button id="btn-save-reporter" class='button success'>Save New Reporter</button>
		  	<button class="close-button" data-close aria-label="Close modal" type="button">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </form>

		</div>

		{{-- modal for Projects --}}
		<div class="reveal" id="projectModal" data-reveal>
		  	<form action="">
		  	{{ csrf_field() }}
			<label for="addProject">New Project</label>
			<input type="text" name="project_name">
		  	<button id="btn-save-project" type="button" class='button success'>Save New Project</button>
		  	<button class="close-button" data-close aria-label="Close modal" type="button">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </form>

		</div>

		@endforeach



		{{-- <p><a data-open="exampleModal1">Click me for a modal</a></p> --}}


	</div>

@stop