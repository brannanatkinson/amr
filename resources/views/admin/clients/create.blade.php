@extends('layout')

@section('content')
    
    <h1>Create New CLient</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/admin/clients" method="POST" class="ui form">
    	{{ csrf_field() }}
        <div class="field">
            <label for="client_name">Client Name</label>
            <input type="text" name="client_name" required>
        </div>
        <div class="field">
            <label for="client_logo">Client Logo</label>
            <input type="file" name="last_name">
        </div>
        <div class="field">
        	<label for="client_desc">Client Notes</label>
        	<textarea name="client_desc"></textarea>
        </div>
        <button class="ui button" type="submit">Submit</button><a href="{{ url()->previous() }}" class="ui button">Cancel</a>
    </form>

@endsection