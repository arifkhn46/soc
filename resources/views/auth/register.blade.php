@extends('layouts.app')

@section('content')
<section class="hero soc-app-form">
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="column is-4 is-offset-4">
                <h3 class="title has-text-grey">Register</h3>
                <div class="box">
                    <form method="POST" id="registeration-form" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="field">
                            <div class="control">
                                <input class="input {{ $errors->has('name') ? ' is-danger' : '' }}" type="text" value="{{ old('name') }}" id="name" name="name" placeholder="Full Name" required autofocus>
                            </div>
                            @if ($errors->has('name'))
                                <p class="help is-danger">{{ $errors->first('email') }}</p>                        
                            @endif
                        </div>
                        <div class="field">
                            <div class="control">
                                <input class="input {{ $errors->has('email') ? ' is-danger' : '' }}" type="text" placeholder="user@example.com" value="{{ old('email') }}" id="email" name="email" required>
                            </div>
                            @if ($errors->has('email'))
                                <p class="help is-danger">{{ $errors->first('email') }}</p>                        
                            @endif
                        </div>
                        <div class="field">
                            <div class="control">
                                <input class="input {{ $errors->has('password') ? ' is-danger' : '' }}" type="password" value="{{ old('password') }}" id="password" name="password" placeholder="password" required>
                            </div>
                            @if ($errors->has('password'))
                                <p class="help is-danger">{{ $errors->first('password') }}</p>                        
                            @endif
                        </div>
                        <div class="field">
                            <div class="control">
                                <input class="input" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required>
                            </div>
                        </div>
                        <button type="submit" class="button is-info is-fullwidth">Register</button>
                    </from>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
