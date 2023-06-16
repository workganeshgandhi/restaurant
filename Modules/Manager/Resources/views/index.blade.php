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
                                        <h3>{{ Modules\Manager\Entities\MainCategory::count() }}</h3>

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
                                        <h3>{{ Modules\Manager\Entities\Category::count() }}</h3>

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
                                        <h3>{{ Modules\Manager\Entities\Salary::count() }}</h3>

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
                                        <h3>{{ Modules\Manager\Entities\Offer::count() }}</h3>

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
                                        <h3>{{ Modules\Manager\Entities\Branch::count() }}</h3>

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
                                        <h3>{{ Modules\Manager\Entities\Supervisor::count() }}</h3>

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
                                        <h3>{{ Modules\Manager\Entities\Order::count() }}</h3>

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
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{ App\Models\Manager::count() }}</h3>

                                        <p>Managers</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-ios-person"></i>
                                    </div>
                                    <a href="{{ route('managers.index') }}" class="small-box-footer">More info <i
                                            class="fas fa-arrow-circle-right"></i></a>
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
        var monthNames = ["January", "February",
            "March", "April", "May", "June",
            "July", "August", "September",
            "October", "November", "December"
        ];
        var today = new Date();
        var lat6Monthes = [];
        for (let i = 7; i > 0; i--) {
            var d = new Date(today.getFullYear(), today.getMonth() - i, 1);
            lat6Monthes.push(monthNames[d.getMonth()]);
        }

        const Http = new XMLHttpRequest();
        const url = '/getOrdersByMonth';
        Http.open("GET", url);
        Http.send();
        Http.onreadystatechange = (e, orders) => {
           var res = JSON.parse(Http.responseText)
            var orders = [];
            for (let i = 0; i < 6; i++) {
                let ord = 0;
                let delord = 0;
                if (res[0][lat6Monthes[i]] != undefined) {
                    ord = res[0][lat6Monthes[i]];
                }
                if (res[1][lat6Monthes[i]] != undefined) {
                    delord = res[1][lat6Monthes[i]];
                }
                orders[lat6Monthes[i]] = ord + delord
            }

            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'polarArea',
                data: {
                    labels: [lat6Monthes[0], lat6Monthes[1], lat6Monthes[2], lat6Monthes[3],
                        lat6Monthes[4], lat6Monthes[5]
                    ],
                    datasets: [{
                        label: 'number of orders',
                        data: [orders[lat6Monthes[0]], orders[lat6Monthes[1]],
                            orders[lat6Monthes[2]], orders[lat6Monthes[3]],
                            orders[lat6Monthes[4]], orders[lat6Monthes[5]],
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
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
        }
        var today = new Date();
        $('#time').html(today.getHours() + ':' + today.getMinutes());
        $('#date').html(today.toDateString());
    </script>
@endsection
