@extends('teacher.layouts.app')


@section('header_content')
    {{ Breadcrumbs::render('content-repository-list') }}
@endsection

@section('content')
  <section class="hero soc-app-form">
    <div>
        <div class="container">
            <div class="column">
                <h4 class="title is-4 has-text-grey">My Repositories List</h4>
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
                            @foreach($repositories as $key => $repository)
                                <tr>
                                  <td>{{ $serialNumber + ($key+1) }}</td>
                                  <td>{{ $repository->title }}</td>
                                  <td>{{ $repository->created_at }}</td>
                                  <td>{{ $repository->updated_at }}</td>
                                  <td>{{ ($repository->deleted_at) ? 'In-Active' : 'Active'  }}</td>
                                  <td>
                                      <div class="dropdown soc-dropdown">
                                        <div class="dropdown-trigger">
                                            <button class="button" aria-haspopup="true" aria-controls="dropdown-menu">
                                                <span>Add Content</span>
                                            </button>
                                        </div>
                                        <div class="dropdown-menu" id="dropdown-menu" role="menu">
                                            <div class="dropdown-content">
                                                <a href="#" class="dropdown-item">
                                                    Subject
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    Topic
                                                </a>
                                                <a href="#" class="dropdown-item">
                                                    Sub-Topic
                                                </a>
                                            </div>
                                        </div>
                                        </div>
                                  </td>
                                </tr>
                            @endforeach
                            @if($repositories->links() instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                <tr>
                                    <td colspan="6">
                                        {{ $repositories->links() }}
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

@section('scripts')
    <script>
        (function($){
            $(document).ready(function(){
                $('.soc-dropdown').click(function(event){
                    event.stopPropagation();
                    $(this).toggleClass('is-active');
                });
                $('body').click(function(e){
                    $('.soc-dropdown').removeClass('is-active');
                });
            });
        })(jQuery);
    </script>
@endsection