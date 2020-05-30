@extends('layouts.app')

@section('content')
<user-roles-component :user-roles="{{$roles}}"></user-roles-component>
@endsection
