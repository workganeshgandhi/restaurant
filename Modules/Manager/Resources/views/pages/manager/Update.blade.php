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
                            <li class="breadcrumb-item active">Managers</li>
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
                <form action="{{ route('managers.update', $manager->id) }}" method="post">
                    @csrf
                    <div class="row card-body">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" value="{{ $manager->name }}" name="name" class="form-control"
                                    id="name" placeholder="Name">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" value="{{ $manager->email }}" name="email" class="form-control"
                                    id="email" placeholder="Email">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Mobile">Mobile</label>
                                <input type="number" value="{{ $manager->mobile }}" name="mobile" class="form-control"
                                    id="Mobile" placeholder="Mobile">
                                @error('mobile')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Address">Address</label>
                                <input type="text" value="{{ $manager->address }}" name="address" class="form-control"
                                    id="Address" placeholder="Address">
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="NationalID">National ID</label>
                                <input type="number" value="{{ $manager->national_id }}" name="national_id"
                                    class="form-control" id="NationalID" placeholder="National ID">
                                @error('national_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Salary</label>
                                <select name="salary_id" id="" class="form-control">
                                    @foreach ($salaries as $salary)
                                        <option {{ $manager->salary_id == $salary->id ? 'selected' : '' }}
                                            value="{{ $salary->id }}">{{ $salary->name }}</option>
                                    @endforeach
                                </select>
                                @error('salary_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Branch</label>
                                <select name="branch_id" id="" class="form-control">
                                    @foreach ($branches as $branch)
                                        <option {{ $manager->branch_id == $branch->id ? 'selected' : '' }}
                                            value="{{ $branch->id }}">{{ $branch->address }}</option>
                                    @endforeach
                                </select>
                                @error('branch_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="JoinDate">Join Date</label>
                                <input type="date" value="{{ $manager->join_date }}" name="join_date"
                                    class="form-control" id="JoinDate" placeholder="Join Date">
                                @error('join_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" value="{{ $manager->password }}" name="password"
                                    class="form-control" id="password" placeholder="Password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="w-100">
                            <button type="submit" class="btn btn-sm btn-info w-100"> Submit</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
