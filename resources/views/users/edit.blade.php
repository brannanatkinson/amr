@extends('layout')

@section('content')
    
    <h1>Edit User</h1>
    @if ($user->filepath)
        <img height="100" width="100" style="object-fit: cover;" src="{{ URL::to('/') }}/storage/{{$user->filepath}}">
    @endif
    <h3 class="ui header">
        {{$user->first_name}} {{$user->last_name}}
        <div class="sub header">{{$user->email}}</div>
    </h3>
    <div class="ui divider"></div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    {{ Form::model($user, ['route' => ['user.update', $user->id], 'class' => 'ui form']) }}
    {{ method_field('PATCH') }}
    
    <div class="two fields">

        <div class="field">
            {{ Form::label('Name') }}
            <div class="inline fields">
                <div class="field">

                    {{ Form::text('first_name') }}
                </div>
                <div class="field">
                    {{ Form::text('last_name') }}
                </div>
                
            </div>
        </div>
        <div class="field">
                {{ Form::label('Client') }}
                {{ Form::select('client_id', $client_array, $user->client_id, ['placeholder' => 'Choose client...', 'class' => 'ui dropdown'] ) }}
        </div>
    </div>
    <div class="two fields">
        <div class="field">
            {{ Form::label('Email') }}
            {{ Form::email('email') }}

        </div>
        <div class="field">
            {{ Form::hidden('password', 'test') }}
        </div>
    </div>

    <div class="field">
        Is Admin? {{ Form::checkbox('is_admin', $user->admin, ['class'=>'ui checkbox']) }}
    </div>
    <h4>Add Image</h4>
    <div class="field">
        {{ Form::file('filepath')}}
    </div>
    {{ Form::submit('Update User', ['class' => 'ui button']) }}
    

    {{ Form::close() }}

    <br />
    <span id="deleteUser">Delete user</span>
    {{-- modal to delete user --}}
    <div class="ui basic modal">
      <div class="ui icon header">
          Are you sure you want to delete {{$user->first_name}} {{$user->last_name}}?
      </div>
      <div class="actions">
        <div class="ui red basic cancel inverted button">
          <i class="remove icon"></i>
          No
        </div>
        <a href="/users/{{$user->id}}/delete" class="ui green ok inverted button">
          <i class="checkmark icon"></i>
          Yes
        </a>
      </div>
    </div>

@endsection