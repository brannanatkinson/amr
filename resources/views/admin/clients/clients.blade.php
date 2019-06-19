@extends('layout')

@section('content')
    
    <h1>Clients</h1>
	<table class="ui celled table">
		<thead>
			<tr>
				<th>Client Name</th>
				<th>Client Logo</th>
				<th>Users</th>
				
			</tr>
		</thead>
		<tbody>
			@foreach ($clients as $client)
			    <tr>
	                <td>{{$client->client_name}} <a href="/clients/{{$client->id}}/edit"><i class="pencil alternate grey icon"></i></a></td>
	                <td>{{$client->client_logo}}</td>
	                <td>
	                	@php
	                	    $users = App\User::where('client_id', '=', $client->id)->orderBy('last_name')->get();
	                	@endphp
	                	<div class="ul list">
						@foreach ($users as $user)
						   <div class="item"><a href="/users/{{ $user->id }}/edit">{{ $user->first_name }} {{ $user->last_name }}</a></div>
						@endforeach
						</div>
	                </td>
	                
	                
	            </tr>
            @endforeach 
		</tbody>
	</table>
    

    <br /><a href="/admin/clients/new" class="ui button large">Create New Client</a>
    <hr>
    <br /><a href="/admin/clients/signed_url" class="ui button large">Create New URLs</a>


@endsection