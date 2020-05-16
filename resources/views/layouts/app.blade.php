@extends('layouts.skeleton')

@section('pageTitle', config('app.name', ''))

@section('bodyClasses', 'bg-gray-100 leading-normal')

@section('body')
    <div id="app">
        <div>
            @include('layouts.nav')
        </div>

        @include('partials/_flash')

        @yield('content')
    </div>
@stop