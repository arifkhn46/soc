@extends('layouts.skeleton')

@section('pageTitle', config('app.name', ''))

@section('bodyClasses', 'bg-gray-100 leading-normal')

@section('body')
    <v-app id="app">
    
        <header-component :user="{{ Auth::user() ?: '{}' }}"></header-component>
        <div>
            @include('layouts.nav')
        </div>

        @include('partials/_flash')

        @yield('content')
        
    </v-app>
@stop