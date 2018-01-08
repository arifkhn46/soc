@extends('layouts.app')

@section('content')
  <section class="hero soc-app-form">
    <div>
        <div class="container">
            <div class="column is-8">
                <h4 class="title is-4 has-text-grey">Create a new course</h4>
                <div class="box">
                  <form method="POST" action="{{ route('courses.store') }}" id="create-course-form">
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
                                <select name="exam_type_id" id="exam_type_id" required>
                                    <option value="">Select Exam Type:</option>
                                    @foreach($examTypes as $examType)
                                        <option value="{{ $examType->id }}" {{ old('exam_type_id') == $examType->id ? 'selected' : '' }}>{{ $examType->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if ($errors->has('description'))
                            <p class="help is-danger">{{ $errors->first('description') }}</p>                        
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
