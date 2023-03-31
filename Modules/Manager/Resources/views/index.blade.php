@extends('manager::layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <section class="content">
                    <div class="container-fluid">
                        <div class="row pt-4 pb-4">
                            <div class="w-100">
                                <canvas id="myChart" style="width: 100%;"></canvas>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{Modules\Manager\Entities\MainCategory::count()}}</h3>

                                        <p>Main Categories</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-android-apps"></i>
                                    </div>
                                    <a href="{{ route('maincategory.index') }}" class="small-box-footer">More info<i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-dark">
                                    <div class="inner">
                                        <h3>{{Modules\Manager\Entities\Category::count()}}</h3>

                                        <p>Categories</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-android-funnel"></i>
                                    </div>
                                    <a href="{{ route('category.index') }}" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{Modules\Manager\Entities\Salary::count()}}</h3>

                                        <p>Salary</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios-photos"></i>
                                    </div>
                                    <a href="{{ route('salary.index') }}" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-dark">
                                    <div class="inner">
                                        <h3>{{Modules\Manager\Entities\Offer::count()}}</h3>

                                        <p>Offer</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios-person"></i>
                                    </div>
                                    <a href="{{ route('offer.index') }}" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{Modules\Manager\Entities\Branch::count()}}</h3>

                                        <p>Branch</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios-person"></i>
                                    </div>
                                    <a href="{{ route('branch.index') }}" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3>{{Modules\Manager\Entities\Supervisor::count()}}</h3>

                                        <p>Supervisor</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios-person"></i>
                                    </div>
                                    <a href="{{ route('supervisor.index') }}" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3>{{Modules\Manager\Entities\Order::count()}}</h3>

                                        <p>Order</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios-person"></i>
                                    </div>
                                    <a href="{{ route('order.index') }}" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <p>Profile</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios-person"></i>
                                    </div>
                                    <a  class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </section>
    </div>
@endsection

@section('scripts')
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    label: 'number of orders',
                    data: [70, 60, 100, 120, 152, 168, 35],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        var today = new Date();

        $('#time').html(today.getHours() + ':' + today.getMinutes());

        $('#date').html(today.toDateString());
    </script>

@endsection
