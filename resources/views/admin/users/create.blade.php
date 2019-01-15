@extends('layout')

@section('content')
    
    <h1>Create New User</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/users" method="POST" class="ui form">
    	{{ csrf_field() }}
        <div class="field">
            <label>First Name</label>
            <input type="text" name="first_name" required>
        </div>
        <div class="field">
            <label>Last Name</label>
            <input type="text" name="last_name" required>
        </div>
        <div class="field">
        	<label for="email">Email Address</label>
        	<input type="text" name="email" required>
        </div>
        <div class="field">
        	<label for="password">Password</label>
        	<input type="password" name="password" required>
        </div>
        <div class="field">
            <select name="client_id" id="" class="ui dropdown">
                <option disabled value> -- select an option -- </option>
                @foreach ($clients as $client)
                    <option value="{{$client->id}}">{{$client->client_name}}</option>
                @endforeach 
            </select>
        </div>
        <div class="field">
            <div class="ui checkbox">
                <input type="checkbox" tabindex="0" name="admin">
                <label>Admin</label>
            </div>
        </div>
        <button class="ui button" type="submit">Submit</button><a href="{{ url()->previous() }}" class="ui button">Cancel</a>
    </form>

@endsection