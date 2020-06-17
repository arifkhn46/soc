@extends('layouts.app')

@section('content')

<users-list-component 
  :users-list="{{ $users }}"
  :user-roles="{{ $roles }}"></users-list-component>

@endsection
