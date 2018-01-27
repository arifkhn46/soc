@extends('layouts.app')

@section('content')
  <section class="hero soc-app-form">
    <div>
        <div class="container">
            <div class="column">
                <h4 class="title is-4 has-text-grey">Subject List</h4>
                <div class="box">
                    <table class="table is-bordered is-striped is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                              <th><abbr title="Position">S.N.</abbr></th>
                              <th>Title</th>
                              <th>Created At</th>
                              <th>Updated At</th>
                              <th>Status</th>
                              <!-- <th>Operations</th> -->
                            </tr>
                        </thead>
                        <tfoot>
                            @foreach($subjects as $key => $subject)
                            
                                <tr>
                                  <td>{{ $serialNumber + ($key+1) }}</td>
                                  <td>{{ $subject->title }}</td>
                                  <td>{{ $subject->created_at }}</td>
                                  <td>{{ $subject->updated_at }}</td>
                                  <td>{{ ($subject->deleted_at) ? 'In-Active' : 'Active'  }}</td>
                                  <!-- <td>
                                      <ul class="menu-list">
                                        @if(!$subject->deleted_at)  
                                            <li>
                                                <a class="button" href="">Edit</a>
                                            </li>
                                            <li>
                                                <a class="button" href="#" 
                                                onclick="event.preventDefault();
                                                        document.getElementById('course-unpublish-form-{{ $subject->id }}').submit();">Unpublish</a>
                                                <form id="course-unpublish-form-{{ $subject->id }}" action="" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            </li>
                                        @endif
                                        @if($subject->deleted_at)
                                            <li>
                                                <a class="button" href="#" 
                                                onclick="event.preventDefault();
                                                        document.getElementById('subject-publish-form-{{ $subject->id }}').submit();">Publish</a>
                                                <form id="course-publish-form-{{ $subject->id }}" action="{{ route('courses.restore', $subject->id) }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PATCH') }}
                                                </form>
                                            </li>
                                        @endif
                                    </ul>
                                  </td> -->
                                </tr>
                            @endforeach
                            @if($subjects->links() instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                <tr>
                                    <td colspan="6">
                                        {{ $subjects->links() }}
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
