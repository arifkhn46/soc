@extends('admin.layouts.app')

@section('content')
  <section class="hero soc-app-form">
    <div>
        <div class="container">
            <div class="column">
                <h4 class="title is-4 has-text-grey">Subject Category List</h4>
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
                            @foreach($subjectCategories as $key => $category)

                                <tr>
                                  <td>{{ $serialNumber + ($key+1) }}</td>
                                  <td>{{ $category->title }}</td>
                                  <td>{{ $category->created_at }}</td>
                                  <td>{{ $category->updated_at }}</td>
                                  <td>{{ ($category->deleted_at) ? 'In-Active' : 'Active'  }}</td>
                                  <!-- <td>
                                      <ul class="menu-list">
                                        @if(!$category->deleted_at)
                                            <li>
                                                <a class="button" href="">Edit</a>
                                            </li>
                                            <li>
                                                <a class="button" href="#"
                                                onclick="event.preventDefault();
                                                        document.getElementById('course-unpublish-form-{{ $category->id }}').submit();">Unpublish</a>
                                                <form id="course-unpublish-form-{{ $category->id }}" action="" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                </form>
                                            </li>
                                        @endif
                                        @if($category->deleted_at)
                                            <li>
                                                <a class="button" href="#"
                                                onclick="event.preventDefault();
                                                        document.getElementById('subject-publish-form-{{ $category->id }}').submit();">Publish</a>
                                                <form id="course-publish-form-{{ $category->id }}" action="{{ route('courses.restore', $category->id) }}" method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PATCH') }}
                                                </form>
                                            </li>
                                        @endif
                                    </ul>
                                  </td> -->
                                </tr>
                            @endforeach
                            @if($subjectCategories->links() instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                <tr>
                                    <td colspan="6">
                                        {{ $subjectCategories->links() }}
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
