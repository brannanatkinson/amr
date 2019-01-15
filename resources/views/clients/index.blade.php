@extends('layout')

@section('content')



	

	<div class="row">
		<div class="large-12 columns">
			<h2>Clients</h4>
		</div>
	</div>


	<div class="row">
		<div class="large-12 columns">


			@foreach ($clients as $client)


				<div class="row client__section">

					<div class="small-2 columns"><img src="{{ url ('/img/' . $client->client_logo)}}" class="client__logo" alt="">{{ $client->client_name}}</div>
					<div class="small-5 columns end">
						<ul class="client__data">
							<li><span class="label">{{$client->projects->count()}}</span> Projects </li>
							<hr>
							<li><a href="/clients/{{ $client->id }}"><span class="label">{{$client->stories->count()}}</span> Stories </a></li>
						</ul>
					</div>
					

				</div>


			@endforeach


		</div>
	</div>
		

	</div>

@stop