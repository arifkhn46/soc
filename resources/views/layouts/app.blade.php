@extends('layouts.skeleton')

@section('pageTitle', config('app.name', ''))

@section('body')
    <div id="app">

        @include('layouts.nav')
        @if(Session::has('flash'))
            <div class="notification {{ Session::get('flash-class', '') }}">
                {!! Session::get('flash') !!}
            </div>
        @endif

        @yield('content')

    </div>
@stop