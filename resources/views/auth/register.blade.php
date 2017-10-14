@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns">
        <div class="column is-half is-offset-one-quarter">
            <div class="box">
                <h5 class="title has-text-centered has-text-primary">Register</h5>
                <form method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <div class="field">
                        <label class="label">Name</label>
                        <div class="control">
                            <input class="input {{ $errors->has('name') ? ' is-danger' : '' }}" type="text" value="{{ old('name') }}" id="name" name="name" required autofocus>
                        </div>
                        @if ($errors->has('name'))
                            <p class="help is-danger">{{ $errors->first('name') }}</p>                        
                        @endif
                    </div>
                    <div class="field">
                        <label class="label">E-mail Address: </label>
                        <div class="control">
                            <input class="input {{ $errors->has('email') ? ' is-danger' : '' }}" type="text" placeholder="user@example.com" value="{{ old('email') }}" id="email" name="email" required>
                        </div>
                        @if ($errors->has('email'))
                            <p class="help is-danger">{{ $errors->first('email') }}</p>                        
                        @endif
                    </div>
                    <div class="field">
                        <label class="label">Password: </label>
                        <div class="control">
                            <input class="input {{ $errors->has('password') ? ' is-danger' : '' }}" type="password" value="{{ old('password') }}" id="password" name="password" required>
                        </div>
                        @if ($errors->has('password'))
                            <p class="help is-danger">{{ $errors->first('password') }}</p>                        
                        @endif
                    </div>
                    <div class="field">
                        <label class="label">Confirm Password: </label>
                        <div class="control">
                            <input class="input" type="password" id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="control has-text-right">
                        <button class="button  is-medium is-primary is-outlined"> Register </button>
                    </div>
                </from>
            </div>
        </div>
    </div>
</div>
@endsection
