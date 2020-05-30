@extends('layouts.skeleton')

@section('pageTitle', config('app.name', ''))

@section('bodyClasses', 'bg-gray-100 leading-normal')

@section('body')
    <v-app id="app">

        <header-component :user="{{ Auth::user() ?: '{}' }}"></header-component>

        @include('partials/_flash')

        <v-content class="grey lighten-4 fill-height" v-cloak>
            @yield('content')
        </v-content>

    </v-app>
@stop