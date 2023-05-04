@extends('manager::layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Salary : <strong
                                    class="text-danger">{{ Modules\Manager\Entities\Offer::count() }} </strong>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('offer.create') }}" class="btn btn-info btn-sm"> <i class="fas fa-plus"></i>
                                New Offer </a>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.offer -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="content">
            <div class="container-fluid">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>percentage</th>
                            <th>discount</th>
                            <th>start at</th>
                            <th>end at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($offers as $offer)
                            <tr>
                                <td>{{ $offer->name }}</td>
                                <td>{{ $offer->code }}</td>
                                <td>{{ $offer->percentage }}</td>
                                <td>{{ $offer->discount }}</td>
                                <td>{{ $offer->start_at }}</td>
                                <td>{{ $offer->end_at }}</td>
                                <td>
                                    <?php $activeClass = '';
                                    $changeTo = '';
                                    if ($offer->active == 1) {
                                        $activeClass = 'btn-danger';
                                        $changeTo = 'Inactive';
                                    } else {
                                        $activeClass = 'btn-success';
                                        $changeTo = 'Active';
                                    }
                                    ?>
                                    <button type="submit" id="get{{ $offer->id }}"
                                        data-url="{{ route('offer.activation', $offer->id) }}"
                                        data-offer="{{ $offer->id }}"
                                        class="changeBtn edit btn {{ $activeClass }}  btn-sm">{{ $changeTo }}</button>

                                    <a href="{{ route('offer.edit', $offer->id) }}"
                                        class="edit btn btn-dark btn-sm">Update</a>
                                    <a href="{{ route('offer.destroy', $offer->id) }}"
                                        class="edit btn btn-danger btn-sm">Delete</a>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#offer{{ $offer->id }}">
                                        view
                                    </button>

                                    <div class="modal fade" id="offer{{ $offer->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="offer{{ $offer->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="offer{{ $offer->id }}Label">
                                                        {{ $offer->name }} </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="offer">
                                                        <div class="col-md-6">
                                                            <div> <strong>Name</strong> : {{ $offer->name }}</div>
                                                            <div> <strong>Code</strong> : {{ $offer->code }}</div>
                                                            <div> <strong>Discount</strong> : {{ $offer->discount }}</div>
                                                            <div> <strong>Percentage</strong> : {{ $offer->percentage }}
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div> <strong>Start at</strong> : {{ $offer->start_at }}</div>
                                                            <div> <strong>End at</strong> : {{ $offer->end_at }}</div>

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
    <script type="text/javascript">
        $(document).on('click', '.changeBtn', function() {
            var url = $(this).attr('data-url');
            var id = $(this).attr('data-offer');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: url,
                data: {},
                success: function(data) {
                    if (data == 1) {
                        $('#get' + id).text('Inactive');
                        $('#get' + id).removeClass('btn-success');
                        $('#get' + id).addClass('btn-danger');

                    } else {
                        $('#get' + id).removeClass('btn-danger');
                        $('#get' + id).addClass('btn-success');
                        $('#get' + id).text('Active');
                    }
                },
                error: function(error) {}
            });
        });
        let table = new DataTable('.table');
    </script>
@endsection
