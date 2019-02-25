@extends('adminlte::page')
@section('content-users')
    <link href="/css/datatable-style.css" rel="stylesheet">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">User Data Table</h3>
        </div>
        <div class="box-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <table id="users-table" style="width:100%"
                               class="table table-bordered table-striped table-hover dataTable" role="grid"
                               aria-describedby="example2_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending">Photo
                                </th>
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                    colspan="1"
                                    aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending">Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending">Email
                                </th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">Photo</th>
                                <th rowspan="1" colspan="1">Name</th>
                                <th rowspan="1" colspan="1">Email</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@push('scripts')
    <script>
        $(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('data') !!}',
                columns: [
                    {data: 'photo', name: 'photo', render: function (data) {
                            if (data != null) {
                                return '<img src="/storage/'+data+'" style="height: 50px; width: 50px;">';

                            }else{
                                return '<img src="/storage/images/avatar.png" style="height: 50px; width: 50px;">';
                            }
                        }
                    },
                    { data: 'name', name: 'name', searchable:false, render: function ( data ) {
                        var id = data.substr(0, data.indexOf('/'));
                        var name = data.substr(data.indexOf('/')+1,data.length-1);
                        return '<a href="users/'+id+'">'+name+'</a>';
                        }},
                    { data: 'email', name: 'email' },

                ]
            });
        });
    </script>

@endpush
