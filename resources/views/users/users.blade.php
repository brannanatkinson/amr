@extends('layout')

@section('content')
	
       {{-- @include('flash::message') --}}
    

    <h1>Users</h1>
	<table class="ui celled table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Admin</th>
				<th>Email</th>
				<th>Client</th>
                <th>User URL</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
			    <tr>
	                <td>
                        @if ( $user->filepath )
                            <img class="ui avatar image" src="{{ URL::to('/') }}/storage/{{$user->filepath}}">
                        @endif
	                	{{$user->first_name}} {{$user->last_name}}
	                	<a href="/users/{{ $user->id }}/edit"><h6 style="display: inline;"> [edit]</h6></a>
	                </td>
	                <td>
	                	@if ( !empty($user['admin']) )
                            <i class="ui star green icon"></i>
                        @endif
                    </td>
	                <td>{{$user->email}}</td>
	                <td>
	                	{{App\Client::find($user->client_id)['client_name']}}
	                </td>
                    <td><pre>{{$user->signed_url}}</pre></td>
	            </tr>
            @endforeach 
		</tbody>
	</table>
    

    <br /><a href="/users/new" class="ui button large">Create New User</a>
    

@endsection