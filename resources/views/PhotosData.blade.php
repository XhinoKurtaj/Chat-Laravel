@extends('adminlte::page')

@section('content-photo')
    <link href="/css/datatable-style.css" rel="stylesheet">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Photo Data Table</h3>
        </div>
        <div class="box-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <table id="photos-table" style="width:100%"
                               class="table table-bordered table-hover table-striped dataTable" role="grid"
                               aria-describedby="example2_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1"
                                    colspan="1"
                                    aria-sort="ascending"
                                    aria-label="Rendering engine: activate to sort column descending">Photo
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                    aria-label="Browser: activate to sort column ascending">Preview
                                </th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">Photo</th>
                                <th rowspan="1" colspan="1">Preview</th>
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
        $(function () {
            $('#photos-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('photos.data') !!}',
                columns: [
                    {
                        data: 'photo', name: 'photo', render: function (data) {
                            var id = data.substr(0, data.indexOf('/'));
                            var name = data.substr(data.indexOf('/') + 1, data.length - 1);
                            return '<a href="photos/' + id + '">' + name + '</a>';
                        }
                    },
                    {
                        data: 'photo', name: 'photo', render: function (data) {
                            var id = data.substr(0, data.indexOf('/'));
                            var name = data.substr(data.indexOf('/') + 1, data.length - 1);
                            return '<img src="/storage/' + name + '" style="height: 50px; width: 50px;">';
                        }
                    }
                ]
            });
        });
    </script>
@endpush
