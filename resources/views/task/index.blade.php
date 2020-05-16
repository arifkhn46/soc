@extends('layouts.app')

@section('content')
<router-link :to="{ name: 'example' }">Example</router-link> |
<router-view></router-view>
@endsection
