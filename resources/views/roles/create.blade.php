@extends('layouts.app')

@section('content')
    <div class="container admin-container">
        <div class="columns">
            <div class="column is-half is-offset-one-quarter">
                <h2 class="has-text-centered has-text-primary">Create new Role</h2>
                <form method="POST" action="{{ route('roles.store') }}">
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
                    <div class="control has-text-right">
                        <button class="button  is-medium is-primary is-outlined">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection