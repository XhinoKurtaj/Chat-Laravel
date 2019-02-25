@extends('adminlte::page')
@section('content-conversation')
    <link href="/css/datatable-style.css" rel="stylesheet">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Conversation Data Table</h3>
        </div>
        <div class="box-body">
            <div class="container-container">
                <div class="row">
                    <div class="col-12">
                        <table id="conversations-table" style="width:100%"
                               class="table table-bordered compact table-hover table-striped dataTable  " role="grid"
                               aria-describedby="example2_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                    colspan="1"
                                    aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending">Conversation
                                    Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending">Conversation Photo
                                </th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">Conversation Name</th>
                                <th rowspan="1" colspan="1">Conversation Photo</th>
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
                $('#conversations-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('conversation.data') !!}',
                    columns: [
                        { data: 'name', name: 'custom_name', render: function(data){

                               var id = data.substr(0, data.indexOf('/'));
                               var name = data.substr(data.indexOf('/')+1,data.length-1);
                                return '<a href="/admin/conversations/'+id+'">'+name+'</a>';
                            }
                        },
                        { data: 'custom_photo', name: 'custom_photo', render: function(data){
                                if(data != null){
                                    return '<img src="/storage/'+data+'" style="height: 50px; width: 50px;">';
                                }else{
                                    return ' ';
                                }
                            }
                        },
                    ]
                });
            });
    </script>
@endpush

