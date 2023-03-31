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
                                    class="text-danger">{{ Modules\Manager\Entities\Offer::count() }} </strong>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('offer.create') }}" class="btn btn-info btn-sm"> <i
                                    class="fas fa-plus"></i> New Offer </a>
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
                            <th>Name</th>
                            <th>percentage</th>
                            <th>discount</th>
                            <th>start at</th>
                            <th>end at</th>
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
        $(document).on('click', '.changeBtn', function() {
            var url = $(this).attr('data-url');
            var id = $(this).attr('data-offer');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: url,
                data: {},
                success: function(data) {
                    if (data == 1) {
                        $('#get' + id).text('Inactive');
                        $('#get' + id).removeClass('btn-success');
                        $('#get' + id).addClass('btn-danger');

                    } else {
                        $('#get' + id).removeClass('btn-danger');
                        $('#get' + id).addClass('btn-success');
                        $('#get' + id).text('Active');
                    }
                },
                error: function(error) {}
            });
        });

        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('offer.index') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'percentage',
                        name: 'percentage'
                    },
                    {
                        data: 'discount',
                        name: 'discount'
                    },
                    {
                        data: 'start_at',
                        name: 'start at'
                    },
                    {
                        data: 'end_at',
                        name: 'end at'
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
