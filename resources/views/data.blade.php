@extends('layouts.master')

@section('content')
    <table class="table table-bordered" id="users-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
        </tr>
        </thead>
    </table>
@stop

@push('scripts')
    <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('data') !!}',
                columns: [
                    { data: 'id', name: 'id', render: function ( data ) {
                            return '<a href="users/'+data+'">'+data+'</a>';
                        }},
                    { data: 'first_name', name: 'first_name' },
                    { data: 'last_name', name: 'last_name' },
                    { data: 'email', name: 'email' }
                ]
            });
        });
    </script>

@endpush