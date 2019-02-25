@extends('adminlte::page')
@section('content-message')
    <link href="/css/datatable-style.css" rel="stylesheet">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Message Data Table</h3>
        </div>
        <div class="box-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <table id="messages-table" style="width:100%"
                               class="table table-bordered table-hover table-striped dataTable" role="grid"
                               aria-describedby="example2_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                    colspan="1"
                                    aria-sort="ascending"
                                    aria-label="Messages: activate to sort column descending">Messages
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending">Sender
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending">Created Time
                                </th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">Messages</th>
                                <th rowspan="1" colspan="1">Sender</th>
                                <th rowspan="1" colspan="1">Created Time</th>
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
            $('#messages-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('messages.data') !!}',
                columns: [
                    { data: 'message', name: 'messages.message', render: function(data){
                        console.log(data);
                            var id = data.substr(0, data.indexOf('/'));
                            var name = data.substr(data.indexOf('/')+1,data.length-1);
                            return '<a href="messages/'+id+'">'+name+'</a>';
                        }},
                    { data: 'username', name: 'username', searchable:false},
                    { data: 'time', name: 'time'},
                ]
            });
        });
    </script>
@endpush
