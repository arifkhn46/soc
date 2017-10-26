@extends('admin.layouts.app')

@section('content')
    <div class="columns is-centered">
        <div class="column is-half">
            <div class="card is-hidden1">
                <div class="card-header">
                    <p class="card-header-title">Create new course:</p>
                </div>
                <div class="card-content">
                    <div class="content">
                        <form method="POST" action="{{ route('course.store') }}">
                            {{ csrf_field() }}
                            <div class="field">
                                <label class="label">Title</label>
                                <div class="control">
                                    <input class="input {{ $errors->has('title') ? ' is-danger' : '' }}" type="text" value="{{ old('title') }}" id="title" name="title" required autofocus>
                                </div>
                                @if ($errors->has('title'))
                                    <p class="help is-danger">{{ $errors->first('title') }}</p>                        
                                @endif
                            </div>
                            <div class="field">
                            <label class="label">Description</label>
                                <div class="control">
                                    <textarea class="textarea" value="{{ old('description') }}" id="description" name="description" placeholder="Textarea"></textarea>
                                </div>
                            </div>
                            <div class="control has-text-right">
                                <button class="button  is-primary is-outlined">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection