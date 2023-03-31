@extends('manager::layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('deliveryboy.index') }}" class="btn btn-info btn-sm">Delivery Boys</a>
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
                <form action="{{ route('deliveryboy.update', $deliveryboy->id) }}" method="post">
                    <div class="row card-body">

                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Name">Name</label>
                                <input type="text" name="name" value="{{ $deliveryboy->name }}" class="form-control"
                                    id="Name" placeholder="Name">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Mobile">Mobile</label>
                                <input type="number" name="mobile" value="{{ $deliveryboy->mobile }}"
                                    class="form-control" id="Mobile" placeholder="Mobile">
                                @error('mobile')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="Address">Address</label>
                                <input type="text" name="address" value="{{ $deliveryboy->address }}"
                                    class="form-control" id="Address" placeholder="Address">
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="NationalID">National ID</label>
                                <input type="number" name="national_id" value="{{ $deliveryboy->national_id }}"
                                    class="form-control" id="NationalID" placeholder="National ID">
                                @error('national_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Salary</label>
                                <select name="salary_id" id="" class="form-control">
                                    <option selected disabled>select salary </option>
                                    @foreach ($salaries as $salary)
                                        <option {{ $deliveryboy->salary->id == $salary->id ? 'selected' : '' }}
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
                                    <option selected disabled>select branch</option>
                                    @foreach ($branches as $branch)
                                        <option {{ $deliveryboy->branch->id == $branch->id ? 'selected' : '' }}
                                            value="{{ $branch->id }}">{{ $branch->address }}</option>
                                    @endforeach
                                </select>
                                @error('branch_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="JoinDate">Join Date</label>
                                <input name="join_date" value="{{ $deliveryboy->join_date }}" type="date"
                                    class="form-control" id="JoinDate" placeholder="Join Date">
                                @error('join_date')
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
