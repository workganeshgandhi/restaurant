@extends('manager::layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Supervisors : <strong
                                    class="text-danger">{{ Modules\Manager\Entities\Supervisor::count() }} </strong>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('supervisor.create') }}" class="btn btn-info btn-sm"> <i
                                    class="fas fa-plus"></i> New </a>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.supervisor -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="content">
            <div class="container-fluid">

                <table class="table data-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Branch</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($supervisors as $supervisor)
                            <tr>
                                <td>{{ $supervisor->name }}</td>
                                <td>{{ $supervisor->mobile }}</td>
                                <td>{{ $supervisor->address }}</td>
                                <td>{{ $supervisor->branch->address }}</td>
                                <td>
                                    <a href="{{ route('supervisor.edit', $supervisor->id) }}"
                                        class="edit btn btn-dark btn-sm">Update</a>
                                    <a href="{{ route('supervisor.destroy', $supervisor->id) }}"
                                        class="edit btn btn-danger btn-sm">Delete</a>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#supervisor{{ $supervisor->id }}">
                                        view
                                    </button>

                                    <div class="modal fade" id="supervisor{{ $supervisor->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="supervisor{{ $supervisor->id }}Label"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="supervisor{{ $supervisor->id }}Label">
                                                        {{ $supervisor->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div> <strong>Name</strong> : {{ $supervisor->name }}</div>
                                                            <div><strong>Address</strong> : {{ $supervisor->address }}
                                                            </div>
                                                            <div><strong>Mobile</strong> : {{ $supervisor->mobile }}</div>
                                                            <div> <strong>Salary</strong> :{{ $supervisor->salary->mount }}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div> <strong>National_id</strong> :
                                                                {{ $supervisor->national_id }}
                                                            </div>
                                                            <div> <strong>Join_date</strong> : {{ $supervisor->join_date }}
                                                            </div>
                                                            <div> <strong>Branch</strong>
                                                                :{{ $supervisor->branch->address }}
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
    <script type="text/javascript">
        let table = new DataTable('table');
    </script>
@endsection
