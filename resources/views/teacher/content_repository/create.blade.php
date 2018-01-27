@extends('layouts.app')

@section('content')
  <section class="hero soc-app-form">
    <div>
        <div class="container">
            <div class="column is-8">
                <h4 class="title is-4 has-text-grey">Create a content repository</h4>
                <div class="box">
                  <form method="POST" action="{{ route('content_repository.store') }}" id="create-content-repository-form">
                    {{ csrf_field() }}
                    <div class="field">
                        <div class="control">
                            <input class="input {{ $errors->has('title') ? ' is-danger' : '' }}" type="text" value="{{ old('title') }}" id="title" name="title" placeholder="Title" required autofocus>
                        </div>
                        @if ($errors->has('title'))
                            <p class="help is-danger">{{ $errors->first('title') }}</p>                        
                        @endif
                    </div>
                    <button type="submit" class="button is-info is-fullwidth">Create</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
  </section>
@endsection
