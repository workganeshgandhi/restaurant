@extends('manager::layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-muted">Update Category</h3>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('maincategory.index') }}" class="btn btn-info btn-sm">Main Categories</a>
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
                <form action="{{ route('maincategory.update', $maincategory->id) }}" enctype="multipart/form-data"
                    method="post">
                    <div class="row card-body">
                        <div class="col-md-12 d-flex justify-content-center">

                            <div id="preview">
                                <?php $images = json_decode($maincategory->images); ?>
                                @foreach ($images as $image)
                                    <img class="image-style" src="{{ asset('uploaded/MainCategory/' . $image) }}"
                                        alt="">
                                @endforeach
                            </div>
                        </div>

                        @csrf
                        @foreach (config('translatable.locales') as $locale)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Name">Name in {{ $locale }}</label>
                                    <input type="text" name="{{ $locale }}[name]"
                                        value="{{ $maincategory->translate($locale)->name }}" class="form-control"
                                        id="Name" placeholder="Name">
                                    @error($locale . '.name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="images">images</label>
                                <input type="file" name="images[]" multiple onchange="previewImages(event)"
                                    class="form-control" id="images" placeholder="images">
                                @error('images.*')
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


@section('scripts')
    <script>
        var previewImages = function(event) {
            var filesAmount = event.target.files.length;
            var output = document.getElementById('preview');
            output.innerHTML = '';
            for (i = 0; i < filesAmount; i++) {
                output.innerHTML += '<img   class="image-style" src="' + URL.createObjectURL(event.target.files[
                    i]) + '" alt="" >';
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            }
        };
    </script>
@endsection
