@extends('layout')

@section('content')



	<div class="row">

		<div class="column">
			

			@if ( Auth::user()->hasRole('siteadmin') ) 

				<h1>Projects for All Clients</h1>

			@else

				<h1>Projects for {{ $clientName->client_name }}</h1>

			@endif

			@if ( Auth::user()->hasRole('siteadmin') )

				@foreach($clients as $client)

					<h3>{{ $client->client_name }}</h3>

					@if($client->projects->count() > 0)

						<div class="ui segments">
							
							@foreach($client->projects as $project)

							    <div class="ui secondary segment">
							    	<div class="ui content">
							    		<a href="/projects/{{$project->id}}/">{{ $project->project_name }}</a> <span class="ui tiny blue circular label">{{ $project->stories->count() }}</span>
							    	</div>
							    </div>
								

							@endforeach

						</div>

					@endif 

				@endforeach

			@else

				<ul>

				@foreach($projects as $project)

					<li><a href="/projects/{{$project->id}}/">{{$project->project_name}}</a> <span class="ui grey circular label">{{$project->stories->count()}}</span></li>

				@endforeach

				</ul>

			@endif
		
		</div>
	</div>

	

		</div>
	</div>
		

	</div>

@stop