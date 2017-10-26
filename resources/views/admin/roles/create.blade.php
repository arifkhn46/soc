@extends('admin.layouts.app')

@section('content')
    <div class="columns is-centered">
        <div class="column is-half">
            <div class="card is-hidden1">
                <div class="card-header">
                    <p class="card-header-title">Create new Role</p>
                </div>
                <div class="card-content">
                    <div class="content">
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
                                <button class="button is-primary is-outlined">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection