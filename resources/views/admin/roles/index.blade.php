@extends('admin.layouts.app')

@section('content')
    <div class="columns">
        <div class="column">
            <h2 class="title">Roles</h2>
            <table class="table is-bordered is-striped  is-fullwidth">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tfoot>
                    @foreach ($roles as $role)
                        <tr>
                            <td>1</td>
                            <td>{{ $role->name }}</td>
                        </tr>
                    @endforeach
                </tfoot>
            </table>    
        </div>
    </div>
@endsection