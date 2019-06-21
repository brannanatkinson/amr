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
    <form action="/users" method="POST" class="ui form" enctype="multipart/form-data">
    	{{ csrf_field() }}
        <div class="two fields">
            <div class="field">
                <label for="">Name</label>
                <div class="inline fields">  
                     <div class="field">
                         <input type="text" name="first_name" required placeholder="First Name">
                     </div>
                     <div class="field">
                         <input type="text" name="last_name" required placeholder="Last Name">
                     </div>
            </div>
        </div>
            <div class="field">
                <label for="client_id">Client</label>
                <select name="client_id" id="" class="ui dropdown">
                    <option value=""> -- select an option -- </option>
                    @foreach ($clients as $client)
                        <option value="{{$client->id}}">{{$client->client_name}}</option>
                    @endforeach 
                </select>
            </div>
        </div>
        <div class="two fields">
            <div class="field">
            	<label for="email">Email Address</label>
            	<input type="text" name="email" required>
            </div>
            {{-- <div class="field">
            	<label for="password">Password</label>
            	<input type="password" name="password" required>
            </div> --}}
        </div>

        <div class="field">
            <div class="ui checkbox">
                <input type="checkbox" tabindex="0" name="admin">
                <label>Admin</label>
            </div>
        </div>
        <div class="seven wide field">
            <h4 class="ui header">Add Image</h4>
            <input type="file" tabindex="0" name="upload" id="upload">
        </div>
        <button class="ui button" type="submit">Submit</button><a href="{{ url()->previous() }}" class="ui button">Cancel</a>
    </form>

@endsection