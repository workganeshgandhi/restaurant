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
        <div class="container-fluid">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Information</h3>
                </div>
                <div class="row card-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="FirstName">First Name</label>
                            <input type="text" class="form-control" id="FirstName" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <label for="SecondName">Second Name</label>
                            <input type="text" class="form-control" id="SecondName" placeholder="Second Name">
                        </div>
                        <div class="form-group">
                            <label for="LastName">Last Name</label>
                            <input type="text" class="form-control" id="LastName" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <label for="Mobile">Mobile</label>
                            <input type="number" class="form-control" id="Mobile" placeholder="Mobile">
                        </div>
                        <div class="form-group">
                            <label for="Address">Address</label>
                            <input type="text" class="form-control" id="Address" placeholder="Address">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="NationalID">National ID</label>
                            <input type="number" class="form-control" id="NationalID" placeholder="National ID">
                        </div>
                        <div class="form-group">
                            <label for="">Salary</label>
                            <select name="salay" id="" class="form-control">
                                <option value="1">Manager</option>
                                <option value="2">Superviosr</option>
                                <option value="3">Cooker</option>
                                <option value="4">Assistant cook</option>
                                <option value="5">Cashier</option>
                                <option value="6">Waiter</option>
                                <option value="7">Delivery Boy</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Branch</label>
                            <select name="branch" id="" class="form-control">
                                <option value="">Maadi</option>
                                <option value="">Moqatam</option>
                                <option value="">menufia</option>
                                <option value="">alex</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="JoinDate">Join Date</label>
                            <input type="date" class="form-control" id="JoinDate" placeholder="Join Date">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                    </div>

                    <div class="w-100">
                        <button class="btn btn-sm btn-info w-100"> Submit</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
