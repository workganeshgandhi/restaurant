@extends('manager::layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Salary : <strong
                                    class="text-danger">{{ Modules\Manager\Entities\Branch::count() }} </strong>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('branch.create') }}" class="btn btn-info btn-sm"> <i
                                    class="fas fa-plus"></i> New Branch </a>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="content">
            <div class="container-fluid">
                <table class="table data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Number</th>
                            <th>Address</th>
                            <th>Tables</th>
                            <th>Open Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('branch.index') }}",
                columns: [{
                        data: 'number',
                        name: 'number'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'tables',
                        name: 'tables'
                    },
                    {
                        data: 'open_date',
                        name: 'open Date'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
    </script>
@endsection
