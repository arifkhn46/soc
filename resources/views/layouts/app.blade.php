@extends('layouts.skeleton')

@section('pageTitle', config('app.name', ''))

@section('bodyClasses', 'bg-gray-100 leading-normal')

@section('body')
    <div id="app">
        <div>
            @include('layouts.nav')
        </div>

        <div class="w-full mx-auto pt-4 max-w-screen-xl">
            @include('partials/_flash')
        </div>

        @yield('content')
    </div>
@stop