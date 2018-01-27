@extends('layouts.app')

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
