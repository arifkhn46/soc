@extends('teacher.layouts.app')

@section('header_content')
    <h1 class="title">
        Welcome, {{ Auth::user()->name }}
    </h1>
@endsection

@section('content')

@endsection
