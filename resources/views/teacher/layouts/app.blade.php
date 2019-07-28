@extends('layouts.skeleton')

@section('pageTitle', config('app.name', ''))

@section('body')
    <div id="app">

        @include('teacher.layouts.nav')
        <section class="hero is-blue is-bold">
            <div class="hero-body">
                <div class="container">
                    @yield('header_content')
                </div>
            </div>
        </section>
        @include('teacher.partials.nav')
        @if(Session::has('flash'))
            <div class="notification {{ Session::get('flash-class', '') }}">
                {!! Session::get('flash') !!}
            </div>
        @endif

        @yield('content')

    </div>
@stop

