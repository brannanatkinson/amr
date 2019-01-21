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
						<table class="ui celled table">
							<thead>
								<tr>
									<th width="40%">Project</th>
									<th width="10%">Mentions</th>
									<th width="25%">First Mention</th>
									<th width="25%">Last Mention</th>
							    </tr>
							</thead>
							@foreach($client->projects as $project)
							    <tr>
							    	<td><a href="/projects/{{$project->id}}/">{{ $project->project_name }}</a> </td>
							    	<td style="text-align: center;">{{ $project->stories->count() }}</td>
							    	<td></td>
							    	<td></td>
							    </tr>
							@endforeach
						</table>
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