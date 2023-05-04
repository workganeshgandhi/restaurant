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
                                    class="text-danger">{{ Modules\Manager\Entities\MainCategory::count() }} </strong>
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
                            <a href="{{ route('maincategory.create') }}" class="btn btn-info btn-sm"> <i
                                    class="fas fa-plus"></i> New Main Category </a>
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
                        @foreach ($mains as $index => $main)
                            <tr>
                                <td> {{ $main->name }} </td>
                                <td>
                                    <a href="{{ route('maincategory.edit', $main->id) }}"
                                        class="edit btn btn-dark btn-sm">Update</a>
                                    <a href="{{ route('maincategory.destroy', $main->id) }}"
                                        class="edit btn btn-danger btn-sm">Delete</a>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#main{{ $main->id }}">
                                        view
                                    </button>
                                    <div class="modal fade" id="main{{ $main->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="main{{ $main->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="main{{ $main->id }}Label">
                                                        {{ $main->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="w-100 mt-4 d-flex justify-content-center">
                                                        <div>
                                                            <?php $decoded = json_decode($main->images);
                                                            ?>
                                                            @foreach ($decoded as $image)
                                                                <img class="image-style mr-4"
                                                                    src="{{ asset('uploaded/mainCategory/' . $image) }}"
                                                                    alt="">
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="w-100  mt-4">
                                                        @foreach ($main->categories as $category)
                                                            <button class="btn btn-info btn-sm ml-4 m-t2" for="">
                                                                {{ $category->name }}</button>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
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
        let table = new DataTable('.table')
    </script>
@endsection
