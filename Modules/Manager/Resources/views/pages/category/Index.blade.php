@extends('manager::layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item mr-4">Salary : <strong
                                    class="text-danger">{{ Modules\Manager\Entities\Category::count() }} </strong>
                            </li>
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
                        </ol>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('category.create') }}" class="btn btn-info btn-sm"> <i
                                    class="fas fa-plus"></i> New Category </a>
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
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $index => $category)
                            <tr>
                                <td> {{ $category->name }} </td>
                                <td>
                                    <a href="{{ route('category.edit', $category->id) }}"
                                        class="edit btn btn-dark btn-sm">Update</a>
                                    <a href="{{ route('category.destroy', $category->id) }}"
                                        class="edit btn btn-danger btn-sm">Delete</a>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#category{{ $category->id }}">
                                        view
                                    </button>
                                    <div class="modal fade" id="category{{ $category->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="category{{ $category->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="category{{ $category->id }}Label">
                                                        {{ $category->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="w-100 mt-4 d-flex justify-content-center">
                                                        <div>
                                                            <?php $decoded = json_decode($category->images);
                                                            ?>
                                                            @foreach ($decoded as $image)
                                                                <img class="image-style mr-4"
                                                                    src="{{ asset('uploaded/Category/' . $image) }}"
                                                                    alt="">
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="w-100 d-flex justify-content-start">
                                                        <strong> Main Category : </strong>
                                                        {{ $category->main_category->name }}
                                                    </div>
                                                    <div class="w-100 d-flex justify-content-start">
                                                        <strong> price : </strong>
                                                        {{ $category->price }}
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
        let table = new DataTable('.table');
    </script>
@endsection
