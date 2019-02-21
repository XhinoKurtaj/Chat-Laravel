@extends('layouts.master')

@section('content')
    <a href="{{ route("admin")}}" class="btn btn-outline-secondary " id="back-btn"><i class="fas fa-arrow-circle-left"></i> Back</a><hr>

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
                        var id = data.substr(0, data.indexOf('/'));
                        var name = data.substr(data.indexOf('/')+1,data.length-1);
                        return '<a href="users/'+id+'">'+name+'</a>';
                        }},
                    { data: 'email', name: 'email' }
                ]
            });
        });
    </script>

@endpush
