@extends('manager::layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-muted">New Offer</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('offer.index') }}" class="btn btn-info btn-sm">Offers</a>
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
                <form action="{{ route('offer.store') }}" method="post">
                    <div class="row card-body">

                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Name">Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="Name"
                                    placeholder="Name">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="start_at">Start_at</label>
                                <input type="date" name="start_at" value="{{ old('start_at') }}" class="form-control"
                                    id="start_at" placeholder="start_at">
                                @error('start_at')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="end_at">End_at</label>
                                <input type="date" name="end_at" value="{{ old('end_at') }}" class="form-control"
                                    id="end_at" placeholder="end_at">
                                @error('end_at')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="percentage">Percentage</label>
                                <input type="number" name="percentage" value="{{ old('percentage') }}"
                                    class="form-control" id="percentage" placeholder="Percentage">
                                @error('percentage')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="Discount">Discount</label>
                                <input type="text" name="discount" value="{{ old('discount') }}" class="form-control"
                                    id="Discount" placeholder="Discount">
                                @error('discount')
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
