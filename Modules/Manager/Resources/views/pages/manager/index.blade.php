@extends('manager::layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="content">
            <div class="container-fluid">
                <table class="table" id="workers">
                    <thead>
                        <tr>
                            <th scope="col"> # </th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Branch</th>
                            <th scope="col">Salary state</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> 1</td>
                            <td>Amery</td>
                            <td>Grant</td>
                            <td>01279783447</td>
                            <td>menufia</td>
                            <td> <a href="" style="color: unset;"> <i class="far fa-window-close"
                                        style="font-size: 25px; color: red ;"></i></a></td>
                            <td>
                                <a href="" style="color: unset;"> <i class="fas fa-edit"
                                        style="font-size: 25px; color: orange ;"></i></a>

                                <a href="" style="color: unset;"> <i class="far fa-window-close"
                                        style="font-size: 25px; color: red;"></i></a>
                            </td>

                        </tr>
                        <tr>
                            <td> 1</td>
                            <td>Amery</td>
                            <td>Grant</td>
                            <td>01279783447</td>
                            <td>menufia</td>
                            <td> <a href="" style="color: unset;"> <i class="far fa-window-close"
                                        style="font-size: 25px; color: red ;"></i></a></td>
                            <td>
                                <a href="" style="color: unset;"> <i class="fas fa-edit"
                                        style="font-size: 25px; color: orange ;"></i></a>

                                <a href="" style="color: unset;"> <i class="far fa-window-close"
                                        style="font-size: 25px; color: red;"></i></a>
                            </td>

                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#workers').DataTable();
        });
    </script>
@endsection
