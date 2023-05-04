@extends('manager::layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Cashiers : <strong
                                    class="text-danger">{{ Modules\Manager\Entities\Supervisor::count() }} </strong>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('cashier.create') }}" class="btn btn-info btn-sm"> <i class="fas fa-plus"></i>
                                New </a>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->
        <div class="content">
            <div class="container-fluid">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Branch</th>
                            <th>Salary state</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cashiers as $index => $cashier)
                            <tr>

                                <td>{{ $index }}</td>
                                <td>{{ $cashier->name }}</td>
                                <td>{{ $cashier->email }}</td>
                                <td>{{ $cashier->mobile }}</td>
                                <td>{{ $cashier->branch->name }}</td>
                                <td>{{ $cashier->salary_state }}</td>
                                <td>
                                    <a href="{{ route('cashier.edit', $cashier->id) }}"
                                        class="edit btn btn-dark btn-sm">Update</a>
                                    <a href="{{ route('cashier.destroy', $cashier->id) }}"
                                        class="edit btn btn-danger btn-sm">Delete</a>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#cashier'{{ $cashier->id }}">
                                        view
                                    </button>
                                    <div class="modal fade" id="cashier{{ $cashier->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="cashier{{ $cashier->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="cashier' . $cashier->id . 'Label">
                                                        {{ $cashier->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <strong> Name : </strong>
                                                            {{ $cashier->name }}
                                                        </div>
                                                        <div>
                                                            <strong> Address : </strong>
                                                            {{ $cashier->address }}
                                                        </div>
                                                        <div>
                                                            <strong> Address : </strong>
                                                            {{ $cashier->mobile }}
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <strong> Branch : </strong>
                                                            {{ $cashier->branch->address }}
                                                        </div>
                                                        <div>
                                                            <strong> Salary : </strong>
                                                            {{ $cashier->salary->mount }}
                                                        </div>
                                                        <div>
                                                            <strong> National ID : </strong>
                                                            {{ $cashier->national_id }}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        let table = new DataTable('.table');
    </script>
@endsection
