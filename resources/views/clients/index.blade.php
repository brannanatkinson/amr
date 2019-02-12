@extends('layout')

@section('content')



	

	<h2>Clients</h2>


	<div class="row">
		<div class="large-12 columns">
			<table class="ui celled table">
				<thead>
				<tr>
					<th>Client</th>
					<th>Mentions</th>
					<th>Projects</th>
				</tr>
				</thead>
				<tbody>
				@foreach ($clients as $client)
					<tr>
						<td>{{ $client->client_name}}</td>
						<td><a href="/clients/{{ $client->id }}"><span class="label">{{$client->stories->count()}}</span> Stories </a></td>
						<td>{{$client->projects->count()}}</td>
					</tr>
				@endforeach
				</tbody>
            </table>

		</div>
	</div>
		

	</div>

@stop