@extends('layouts.app')

@section('content')
<section class="hero soc-app-form">
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="column is-4 is-offset-4">
                <h3 class="title has-text-grey">Login</h3>
                <div class="box">
                    <form method="POST" id="login-form" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="field">
                            <div class="control has-icons-left has-icons-right">
                                <input class="input {{ $errors->has('email') ? ' is-danger' : '' }}" type="email" placeholder="user@example.com" value="{{ old('email') }}" id="email" name="email">
                                <span class="icon is-small is-left">
                                <i class="fa fa-envelope"></i>
                                </span>
                                @if ($errors->has('email'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-warning"></i>
                                    </span>
                                @endif
                            </div>
                            @if ($errors->has('email'))
                                <p class="help is-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                        <div class="field">
                            <p class="control has-icons-left">
                                <input class="input {{ $errors->has('password') ? ' is-danger' : '' }}" type="password" placeholder="Password" name="password" id="password">
                                <span class="icon is-small is-left">
                                <i class="fa fa-lock"></i>
                                </span>
                            </p>
                            @if ($errors->has('password'))
                                <p class="help is-danger">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                        <div class="field">
                            <div class="control">
                                <label class="checkbox">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="button is-info is-fullwidth">Login</button>
                        <a class="button is-link is-small" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
