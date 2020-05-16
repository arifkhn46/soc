@extends('layouts.app')

@section('content')
  <div class="flex min-h-screen pt-16">
    <div class="w-56 bg-white flex-none">
      <ul class="list-reset flex flex-col">
        <li class="w-full h-full pl-4 py-3 px-2 border-b border-light-border">
          <router-link :to="{ name: 'example' }">New Task</router-link>
        </li>
      </ul>
    </div>
    <div class="flex-1">
      <router-view></router-view>
    </div>
  </div>
@endsection
