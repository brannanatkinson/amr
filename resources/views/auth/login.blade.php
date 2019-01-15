@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="columns medium-8 large-offset-2">

                    <div class="row">
                        <columns class="large-12">
                            <h2>Login Form</h2>
                        </columns>
                    </div>

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="row">
                            <div class="columns large-3">
                                <label for="email" class="control-label">E-Mail Address</label>
                            </div>
                            <div class="columns large-9">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="columns large-3">
                                <label for="password" class="control-label">Password</label>
                            </div>
                            <div class="columns large-9">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="columns medium-6 medium-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="columns medium-6 medium-offset-4">
                                <button type="submit" class="button">
                                    Login
                                </button>

                                {{-- <a class="button" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a> --}}
                            </div>
                        </div>
                    </form>
        </div>
    </div>
</div>
@endsection
