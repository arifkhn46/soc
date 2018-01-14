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
                                  <td><abbr title="Position">{{ $serialNumber + ($key+1) }}</abbr></td>
                                  <td>{{ $course->title }}</td>
                                  <td>{{ $course->created_at }}</td>
                                  <td>{{ $course->updated_at }}</td>
                                  <td>{{ ($course->deleted_at) ? 'In-Active' : 'Active'  }}</td>
                                  <td>
                                      <ul class="menu-list">
                                        <li><a class="button" href="{{ route('courses.edit', $course->id) }}">Edit</a></li>
                                        <li><a class="button">Unpublish</a></li>
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
