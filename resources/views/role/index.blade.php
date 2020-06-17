@extends('layouts.app')

@section('content')

<roles-permissions-component 
  :user-roles="{{ $roles }}"
  :role-permissions="{{ $permissions }}"></roles-permissions-component>

@endsection
