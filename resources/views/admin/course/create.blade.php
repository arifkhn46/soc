@extends('admin.layouts.app')

@section('content')
  <section class="hero soc-app-form">
    <div>
        <div class="container">
            <div class="column is-8">
                <h4 class="title is-4 has-text-grey">Create a new course</h4>
                <div class="box">
                  <form method="POST" action="{{ route('admin.courses.store') }}" id="create-course-form">
                    {{ csrf_field() }}
                    <div class="field">
                        <div class="control">
                            <input class="input {{ $errors->has('title') ? ' is-danger' : '' }}" type="text" value="{{ old('title') }}" id="title" name="title" placeholder="Title" required autofocus>
                        </div>
                        @if ($errors->has('title'))
                            <p class="help is-danger">{{ $errors->first('title') }}</p>
                        @endif
                    </div>
                    <div class="field">
                        <div class="control">
                            <textarea class="textarea {{ $errors->has('title') ? ' is-danger' : '' }}" placeholder="Description" value="{{ old('title') }}" id="description" name="description"></textarea>
                        </div>
                        @if ($errors->has('description'))
                            <p class="help is-danger">{{ $errors->first('description') }}</p>
                        @endif
                    </div>
                    <div class="field">
                        <div class="control">
                            <div class="select">
                                <select name="course_type_id" id="course_type_id" required>
                                    <option value="">Select Course Type:</option>
                                    @foreach($courseTypes as $courseType)
                                        <option value="{{ $courseType->id }}" {{ old('course_type_id') == $courseType->id ? 'selected' : '' }}>{{ $courseType->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if ($errors->has('course_type_id'))
                            <p class="help is-danger">{{ $errors->first('course_type_id') }}</p>
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
