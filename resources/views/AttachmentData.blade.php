@extends('layouts.master')

@section('content')
    <a href="{{route('admin')}}" class="btn btn-outline-secondary " id="back-btn"><i class="fas fa-arrow-circle-left"></i> Back</a><hr>

    <table class="table table-bordered" id="attachments-table">
        <thead>
        <tr>
            <th>Attachments</th>
        </tr>
        </thead>
    </table>
@stop
@push('scripts')
    <script>
        $(function() {
            $('#attachments-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('attachments.data') !!}',
                columns: [
                    { data: 'attachment', name: 'attachment', render: function(data){
                            var id = data.substr(0, data.indexOf('/'));
                            var name = data.substr(data.indexOf('/')+1,data.length-1);
                            return '<a href="/attachment/'+id+'">'+name+'</a>';
                        }
                    },
                ]
            });
        });
    </script>
@endpush