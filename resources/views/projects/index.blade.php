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
					@if($client->projects->count() > 0)
					    <h3>{{ $client->client_name }}</h3>
						<ul>
							@foreach($client->projects as $project)
							    <tr>
							    	<li><a href="/projects/{{$project->project_share_id}}/">{{$project->project_name}}</a> <span class="ui grey circular label">{{$project->stories->count()}}</span></li>
							    </tr>
							@endforeach
						</ul>
					@endif 
				@endforeach
			@else

				<ul>

				@foreach($projects as $project)

					<li><a href="/projects/{{$project->project_share_id}}/">{{$project->project_name}}</a> <span class="ui grey circular label">{{$project->stories->count()}}</span></li>

				@endforeach

				</ul>

			@endif
		
		</div>
	</div>

	

		</div>
	</div>
		

	</div>

@stop