@extends('manager::layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">

                            <li class="breadcrumb-item mr-4">Managers : <strong
                                    class="text-danger">{{ App\Models\Manager::count() }} </strong>
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
                            <a href="{{ route('managers.create') }}" class="btn btn-info btn-sm"> <i
                                    class="fas fa-plus"></i> New Manager </a>
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
                            <th scope="col"> # </th>
                            <th scope="col">Name</th>
                            <th scope="col">email</th>
                            <th scope="col">branch</th>
                            <th scope="col">join date</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($managers as $index => $manager)
                            <tr>
                                <td> {{ $index }}</td>
                                <td>{{ $manager->name }}</td>
                                <td>{{ $manager->email }}</td>
                                <td>{{ $manager->branch->address }}</td>
                                <td>{{ $manager->join_date }}</td>
                                <td>
                                    <a href="{{ route('managers.edit', $manager->id) }}"
                                        class="edit btn btn-dark btn-sm">Update</a>
                                    <a href="{{ route('managers.destroy', $manager->id) }}"
                                        class="edit btn btn-danger btn-sm">Delete</a>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#manager{{ $manager->id }}">
                                        view
                                    </button>

                                    <div class="modal fade" id="manager{{ $manager->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="manager{{ $manager->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="manager{{ $manager->id }}Label">
                                                        {{ $manager->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div> <strong>Name</strong> : {{ $manager->name }}</div>
                                                            <div><strong>Address</strong> : {{ $manager->address }}</div>
                                                            <div><strong>Mobile</strong> : {{ $manager->mobile }}</div>
                                                            <div> <strong>Salary</strong> :{{ $manager->salary->mount }}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div> <strong>National_id</strong> :
                                                                {{ $manager->national_id }}
                                                            </div>
                                                            <div> <strong>Join_date</strong> : {{ $manager->join_date }}
                                                            </div>
                                                            <div> <strong>Branch</strong> :{{ $manager->branch->address }}
                                                            </div>
                                                        </div>
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
    <script>
        let table = new DataTable('.table')
    </script>
@endsection
