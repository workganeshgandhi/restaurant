@extends('manager::layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-muted">New Branch</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('branch.index') }}" class="btn btn-info btn-sm"> Branches </a>
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
                <form class="row ml-2 mr-2" action="{{ route('branch.update', $branch->id) }}" method="post">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Number">Number</label>
                            <input type="number" name="number" value="{{ $branch->number }}" class="form-control"
                                id="number" placeholder="number">
                            @error('number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Open_date">Open Date</label>
                            <input type="date" name="open_date" value="{{ $branch->open_date }}" class="form-control"
                                id="Open_date" placeholder="Open_date">
                            @error('open_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Address">Address</label>
                            <input type="text" name="address" value="{{ $branch->address }}" class="form-control"
                                id="Address" placeholder="Address">
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="Tables">Tables</label>
                            <input type="number" name="tables" value="{{ $branch->tables }}" class="form-control"
                                id="tables" placeholder="Tables">
                            @error('tables')
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
