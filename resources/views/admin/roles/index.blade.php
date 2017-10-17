@extends('admin.layouts.app')

@section('content')
    <div class="container admin-container">
        <div class="columns">
            <div class="column is-half is-offset-one-quarter">
                <h2 class="has-text-centered has-text-primary">Roles</h2>
                    <ul>
                        @foreach ($roles as $role)
                            <li>{{ $role->name }}</li>
                        @endforeach
                    </ul>
            </div>
        </div>
    </div>
@endsection