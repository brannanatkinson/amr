@extends('layout')

@section('content')
    
    <h1>Users</h1>
	<table class="ui celled table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Client</th>
				<th>User URL</th>

			</tr>
		</thead>
		<tbody>
			@foreach ($users as $user)
			    <tr>
	                <td>
	                	@if ( !empty($user['admin']) )
                            <i class="star orange icon"></i>
                        @endif
	                	{{$user->first_name}} {{$user->last_name}}
	                	<a href="/admin/users/{{ $user->id }}/edit"><i class="edit grey icon"></i></a>
	                </td>
	                <td>{{$user->email}}</td>
	                <td>
	                	{{App\Client::find($user->client_id)['client_name']}}
	                </td>
	                <td>{{$user->signed_url}}</td>
	            </tr>
            @endforeach 
		</tbody>
	</table>
    

    <br /><a href="/users/new" class="ui button large">Create New User</a>


@endsection