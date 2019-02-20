@extends('layouts.master')

@section('content')
    <a href="{{route('admin')}}" class="btn btn-outline-secondary " id="back-btn"><i class="fas fa-arrow-circle-left"></i> Back</a><hr>

    <table class="table table-bordered" id="conversations-table">
        <thead>
        <tr>
            <th>Conversation Name</th>
        </tr>
        </thead>
    </table>
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
                                return '<a href="/home/conversation/'+id+'/edit">'+name+'</a>';
                            }
                        },
                    ]
                });
            });
    </script>
@endpush
