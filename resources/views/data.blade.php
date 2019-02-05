@extends('layouts.master')

@section('content')
    <a href="{{ route('conversation.list') }}" class="btn btn-outline-secondary " id="back-btn">Back</a><hr>

    <table class="table table-bordered" id="users-table">
        <thead>
        <tr>
            <th>Name</th>
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
                    { data: 'name', name: 'name', searchable:false, render: function ( data ) {
                        console.log(data[0]);
                            return '<a href="users/'+data[0]+'">'+data+'</a>';
                                    }},
                    { data: 'email', name: 'email' }
                ]

            });
        });
    </script>

@endpush
