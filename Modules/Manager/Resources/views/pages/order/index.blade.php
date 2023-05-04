@extends('manager::layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Order : <strong
                                    class="text-danger">{{ Modules\Manager\Entities\Order::count() }} </strong>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.order -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="content">
            <div class="container-fluid">
                <table class="table" id="orders">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>number</th>
                            <th>total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $order)
                            <tr>
                                <td>{{ ++$index }}</td>
                                <td>{{ $order->number }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                        data-target="#order{{ $order->id }}">
                                        view
                                    </button>

                                    <div class="modal fade" id="order{{ $order->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="order{{ $order->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="order{{ $order->id }}Label">
                                                        {{ $order->number }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row d-flex justify-content-between">
                                                        <div class="col-6"> <strong>number : </strong> {{ $order->number }}
                                                        </div>
                                                        <div class="col-6"> <strong>date :</strong>
                                                            {{ $order->created_at }}</div>
                                                    </div>
                                                    <div class="row d-flex justify-content-between">
                                                        <div class="col-6"> <strong>order
                                                                type : </strong>{{ $order->order_type }}</div>
                                                        <div class="col-6"> <strong>branch :
                                                            </strong>{{ $order->branch->address }}</div>
                                                    </div>
                                                    <div class="row d-flex justify-content-between">
                                                        <div class="col-6"> <strong>cashier : </strong>
                                                            {{ $order->cashier->name }}</div>
                                                        <div class="col-6"> <strong>Mobile : </strong>
                                                            {{ $order->cashier->mobile }}</div>
                                                    </div>
                                                    <div class="row d-flex justify-content-between">
                                                        <div class="col-6"> <strong>offer : </strong>
                                                            {{ $order->offer->name }}</div>
                                                        <div class="col-6"> <strong>price :
                                                            </strong>{{ $order->total_price }}</div>

                                                    </div>
                                                    <table class="table mt-4">
                                                        <thead>
                                                            <tr>
                                                                <th>mount</th>
                                                                <th>name</th>
                                                                <th>type</th>
                                                                <th>price</th>
                                                                <th>subtotal</th>
                                                            </tr>

                                                        </thead>
                                                        <tbody>
                                                            @foreach ($order->ordercategories as $category)
                                                                <tr>
                                                                    <td>{{ $category->mount }}</td>
                                                                    <td>{{ $category->category->name }}</td>
                                                                    <td>{{ $category->category_type }}</td>
                                                                    <td>{{ $category->category->price }}</td>
                                                                    <td>{{ $category->subtotal }}</td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>

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
        let table = new DataTable('#orders')
    </script>
@endsection
