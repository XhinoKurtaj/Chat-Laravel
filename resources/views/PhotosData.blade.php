@extends('adminlte::page')

@section('content-photo')
    <style>
        a {
            color:black;
            font-size: 17px;
        }
    </style>
    <a href="{{route('admin')}}" class="btn btn-outline-secondary " id="back-btn"><i class="fas fa-arrow-circle-left"></i> Back</a><hr>

    <table class="table table-bordered"  style="background: white" id="photos-table">
        <thead>
        <tr>
            <th>Photo Name</th>
        </tr>
        </thead>
    </table>
@stop
@push('scripts')
    <script>
        $(function() {
            $('#photos-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('photos.data') !!}',
                columns: [
                    { data: 'photo', name: 'photo', render: function(data){
                            var id = data.substr(0, data.indexOf('/'));
                            var name = data.substr(data.indexOf('/')+1,data.length-1);
                            return '<a href="photos/'+id+'">'+name+'</a>';
                        }
                    },
                ]
            });
        });
    </script>
@endpush