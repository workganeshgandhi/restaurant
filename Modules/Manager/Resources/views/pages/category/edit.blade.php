@extends('manager::layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3 class="m-0 text-muted">Update Category</h3>
                        <li>
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{-- {{ $properties['native'] }} --}}
                                    <img style="width: 20px ; height: 20px;"
                                        src="{{ asset($properties['native'] == 'English' ? 'web_files/assets/img/english.png' : 'web_files/assets/img/arabic.png') }}"
                                        alt="">
                                </a>
                            @endforeach
                        </li>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('category.index') }}" class="btn btn-info btn-sm">Categories</a>
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
                <form action="{{ route('category.update',$category->id) }}" enctype="multipart/form-data" method="post">
                    <div class="row card-body">
                        <div class="row card-body">
                            <div class="col-md-12 d-flex justify-content-center">

                                <div id="preview">
                                    <?php $images = json_decode($category->images); ?>
                                    @foreach ($images as $image)
                                        <img class="image-style" src="{{ asset('uploaded/Category/' . $image) }}"
                                            alt="">
                                    @endforeach
                                </div>
                            </div>
                        @csrf
                        @foreach (config('translatable.locales') as $index => $locale)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Name"> @lang('trans.'.$locale.'.name')</label>
                                    <input type="text" name="{{ $locale }}[name]" value="{{ $category->translate($locale)->name }}"
                                        class="form-control" id="Name" placeholder="@lang('trans.'.$locale.'.name')">
                                    @error($locale . '.name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        @endforeach
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" value="{{$category->price}}" name="price" value="{{ old('price') }}" class="form-control"
                                    id="price" placeholder="Price">
                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Main Category</label>
                                <select name="main_category_id" id="" class="form-control">
                                    <option selected disabled>select Main Category </option>
                                    @foreach ($mains as $main)
                                        <option {{$category->main_category_id == $main->id ? 'selected' : ''}} value="{{ $main->id }}">{{ $main->name }}</option>
                                    @endforeach
                                </select>
                                @error('main_category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="images">images</label>
                                <input type="file" name="images[]" onchange="previewImages(event)" multiple
                                    class="form-control" id="images" placeholder="images">
                                @error('images.*')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="w-100">
                            <button type="submit" class="btn btn-sm btn-info w-100">Submit</button>
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

            for (i = 0; i < filesAmount; i++) {
                var output = document.getElementById('preview');
                output.innerHTML += '<img   class="image-style" src="' + URL.createObjectURL(event.target.files[
                    i]) + '" alt="" >';
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            }
        };
    </script>
@endsection
