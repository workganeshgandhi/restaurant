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
                            <a href="{{ route('branch.create') }}" class="btn btn-info btn-sm"> <i class="fas fa-plus"></i>
                                New Branch </a>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="content">
            <div class="container-fluid">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">number</th>
                            <th scope="col">address</th>
                            <th scope="col">tables</th>
                            <th scope="col">open date</th>
                            <th scope="col">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($branches as $index => $branch)
                            <tr>

                                <td>{{ $index }}</td>
                                <td>{{ $branch->number }}</td>
                                <td>{{ $branch->address }}</td>
                                <td>{{ $branch->tables }}</td>
                                <td>{{ $branch->open_date }}</td>
                                <td>
                                    <a href="{{ route('branch.edit', $branch->id) }}"
                                        class="edit btn btn-dark btn-sm">Update</a>
                                    <a href="{{ route('branch.destroy', $branch->id) }}"
                                        class="edit btn btn-danger btn-sm">Delete</a>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#branch{{ $branch->id }}">
                                        view
                                    </button>

                                    <div class="modal fade" id="branch{{ $branch->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="branch' . $row->id . 'Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="branch' . $row->id . 'Label">
                                                        {{$branch->address}} </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div> <strong>Number</strong> : {{ $branch->number }}</div>
                                                            <div> <strong>Tables</strong> : {{ $branch->tables }}</div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div> <strong>Address</strong> :{{ $branch->address }}</div>
                                                            <div> <strong>Open Date</strong> : {{ $branch->open_date }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
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
    <script>
        let table = new DataTable('.table');
    </script>
@endsection
