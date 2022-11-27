@extends('layouts.admin_master')
@section("title", "Page Admin")

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12 grid-margin">
            <div class="me-md-3 me-xl-5 text-center">
                <h2 class="h2">Dasboard</h2>
                <p class="mb-md-0">Template</p>
            </div>
            <hr>
            <div>
                <h2 class="h2">Orders</h2>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card card-body bg-primary mb-3 shadow text-center">
                            <label for="" class="text-white">
                                <span class="border p-2 bg-primary progress-bar progress-bar-striped">Total Orders</span>
                            </label>
                            <h3 class="h1 text-white font-weight-bold">{{ $totalOrders }}</h3>
                            <a href="{{ route( "orders.index" ) }}" class="text-white">View</a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card card-body bg-success mb-3 shadow text-center">
                            <label for="" class="text-white">
                                <span class="border p-2 bg-success progress-bar progress-bar-striped">Total Orders Today</span>
                            </label>
                            <h3 class="h1 text-white font-weight-bold">{{ $todayOrders }}</h3>
                            <a href="{{ route( "orders.index" ) }}" class="text-white">View</a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card card-body bg-warning mb-3 shadow text-center">
                            <label for="" class="text-white">
                                <span class="border p-2 bg-warning progress-bar progress-bar-striped">Total Orders Month</span>
                            </label>
                            <h3 class="h1 text-white font-weight-bold">{{ $monthOrders }}</h3>
                            <a href="{{ route( "orders.index" ) }}" class="text-white">View</a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card card-body bg-danger mb-3 shadow text-center">
                            <label for="" class="text-white">
                                <span class="border p-2 bg-danger progress-bar progress-bar-striped">Total Orders Year</span>
                            </label>
                            <h3 class="h1 text-white font-weight-bold">{{ $yearOrders }}</h3>
                            <a href="{{ route( "orders.index" ) }}" class="text-white">View</a>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <canvas id="orders"></canvas>
                    </div>
                </div>
            </div>
            <hr>
            <div>
                <h2 class="h2">Users</h2>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card card-body bg-primary mb-3 shadow text-center">
                            <label for="" class="text-white">
                                <span class="border p-2 bg-primary progress-bar progress-bar-striped">Total All User</span>
                            </label>
                            <h3 class="h1 text-white font-weight-bold">{{ $allUsers }}</h3>
                            <a href="{{ route( "user.index" ) }}" class="text-white">View</a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card card-body bg-success mb-3 shadow text-center">
                            <label for="" class="text-white">
                                <span class="border p-2 bg-success progress-bar progress-bar-striped">Total Admin</span>
                            </label>
                            <h3 class="h1 text-white font-weight-bold">{{ $totalAdmin }}</h3>
                            <a href="{{ route( "user.index" ) }}" class="text-white">View</a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card card-body bg-warning mb-3 shadow text-center">
                            <label for="" class="text-white">
                                <span class="border p-2 bg-warning progress-bar progress-bar-striped">Total User</span>
                            </label>
                            <h3 class="h1 text-white font-weight-bold">{{ $totalUser }}</h3>
                            <a href="{{ route( "user.index" ) }}" class="text-white">View</a>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div>
                <h2 class="h2">Products</h2>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="card card-body bg-primary mb-3 shadow text-center">
                            <label for="" class="text-white">
                                <span class="border p-2 bg-primary progress-bar progress-bar-striped">Total Products</span>
                            </label>
                            <h3 class="h1 text-white font-weight-bold">{{ $totalProducts }}</h3>
                            <a href="{{ route( "product.index" ) }}" class="text-white">View</a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <canvas id="products"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

    // order chart
    var _ydata = JSON.parse( '{!! json_encode( $monthsOrder ) !!}' );
    var _xdata = JSON.parse( '{!! json_encode( $monthOrderCount ) !!}' );

    const ctx = document.getElementById('orders');
    new Chart( ctx , {
        type: 'bar',
        data: {
            labels: _ydata,
            datasets: [{
                label: 'Orders',
                data: _xdata,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
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


    // product chart
    var _ydata = JSON.parse( '{!! json_encode( $monthsProduct ) !!}' );
    var _xdata = JSON.parse( '{!! json_encode( $monthProductCount ) !!}' );

    const products = document.getElementById('products');
    new Chart( products , {
        type: 'line',
        data: {
            labels: _ydata,
            datasets: [{
                label: 'Products',
                data: _xdata,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
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
</script>
@endsection
