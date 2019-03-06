@extends('layouts.app')
@section('wrapper-class','animated fadeInRight')
@section('after-style')
    <link href="{{asset('assets/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Basic Data Tables example with responsive plugin</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#" class="dropdown-item">Config option 1</a>
                            </li>
                            <li><a href="#" class="dropdown-item">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="roleDataTable">
                            <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Display name</th>
                                <th>Guard name</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('after-script')
    <!-- Page-Level Scripts START-->
    <script src="{{asset('assets/js/plugins/dataTables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Page-Level Scripts END-->

    <script>
        var params = $.extend({}, dataTableParams_default);
        params['tableSelector'] = '#roleDataTable';
        params['url'] = '{{ route("role.get.list") }}';
        params['requestType'] = 'POST';
        params['data'] = {active: 1, trashed: false};
        params['pageLength'] = {{$dataTable['pageLength']}};
        params['columns'] = [
            {data: 'DT_RowIndex', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'display_name', name: 'display_name'},
            {data: 'guard_name', name: 'guard_name'},
            {data: 'created_at', name: 'created_at'},
            {data: 'actions', name: 'actions', searchable: false, sortable: false}
        ];
        params['buttons'] = [];
        params['columnDefs'] = [{
            targets: 'no-sort',
            orderable: false,
        }, {
            targets: 0,
            visible: true,
        }, {
            targets: 5,
            className: 'text-center',
        }];

        $(document).ready(function () {
            var roleTable = dataTable(params);
            $('#btn-reload').on('click', function () {
                roleTable.ajax.reload();
            });

        });
    </script>
@endsection
