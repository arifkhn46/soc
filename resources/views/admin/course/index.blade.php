@extends('layouts.app')

@section('content')
  <section class="hero soc-app-form">
    <div>
        <div class="container">
            <div class="column">
                <h4 class="title is-4 has-text-grey">Courses List</h4>
                <div class="box">
                    <table class="table is-bordered is-striped is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                              <th><abbr title="Position">S.N.</abbr></th>
                              <th>Title</th>
                              <th>Created At</th>
                              <th>Updated At</th>
                              <th>Status</th>
                              <th>Operations</th>
                            </tr>
                        </thead>
                        <tfoot>
                            @foreach($courses as $key => $course)
                                <tr>
                                  <td>{{ $serialNumber + ($key+1) }}</td>
                                  <td>{{ $course->title }}</td>
                                  <td>{{ $course->created_at }}</td>
                                  <td>{{ $course->updated_at }}</td>
                                  <td>{{ ($course->deleted_at) ? 'In-Active' : 'Active'  }}</td>
                                  <td>
                                      <ul class="menu-list">
                                        @if(!$course->deleted_at)  
                                            <li>
                                                <a class="button" href="{{ route('admin.courses.edit', $course->id) }}">Edit</a>
                                            </li>
                                            <li>
                                                <a class="button" href="#" 
                                                onclick="event.preventDefault();
                                                        document.getElementById('course-unpublish-form-{{ $course->id }}').submit();">Unpublish</a>
                                                <form id="course-unpublish-form-{{ $course->id }}" action="{{ route('admin.courses.delete', $course->id) }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            </li>
                                        @endif
                                        @if($course->deleted_at)
                                            <li>
                                                <a class="button" href="#" 
                                                onclick="event.preventDefault();
                                                        document.getElementById('course-publish-form-{{ $course->id }}').submit();">Publish</a>
                                                <form id="course-publish-form-{{ $course->id }}" action="{{ route('admin.courses.restore', $course->id) }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PATCH') }}
                                                </form>
                                            </li>
                                        @endif
                                    </ul>
                                  </td>
                                </tr>
                            @endforeach
                            @if($courses->links() instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                <tr>
                                    <td colspan="6">
                                        {{ $courses->links() }}
                                    </td>
                                </tr>
                            @endif
                        </tfoot>
                    </table>  
                </div>
            </div>
        </div>
    </div>
  </section>
@endsection
