@extends('adminlte::page')

@section('content-photo')
    <style>
        a {
            color:black;
            font-size: 17px;
        }
       td.sorting_1{
            border: 1px solid black;
        }
        td, th, table{
            border: 1px solid #5b3636;
        }
    </style>
    <h2>Search Photo</h2><hr>
    <table class="table table-striped "  style="background: ghostwhite" id="photos-table">
        <thead>
        <tr>
            <th>Photo Name</th>
            <th>Photo Preview</th>

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
                    { data: 'photo', name: 'photo', render: function(data){
                            var id = data.substr(0, data.indexOf('/'));
                            var name = data.substr(data.indexOf('/')+1,data.length-1);
                            return '<img src="/storage/'+name+'" style="height: 100px; width: 100px;">';
                        }
                    }
                ]
            });
        });

    </script>
@endpush
