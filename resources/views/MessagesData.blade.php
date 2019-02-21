@extends('layouts.master')

@section('content')
    <a href="{{route('admin')}}" class="btn btn-outline-secondary " id="back-btn"><i class="fas fa-arrow-circle-left"></i> Back</a><hr>

    <table class="table table-bordered" id="messages-table">
        <thead>
        <tr>
            <th>Messages</th>
        </tr>
        </thead>
    </table>
@stop
@push('scripts')
    <script>
        $(function() {
            $('#messages-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('messages.data') !!}',
                columns: [
                    { data: 'message', name: 'message', render: function(data){
                            var id = data.substr(0, data.indexOf('/'));
                            var name = data.substr(data.indexOf('/')+1,data.length-1);
                            return '<a href="/messages/'+id+'">'+name+'</a>';
                        }
                    },
                ]
            });
        });
    </script>
@endpush