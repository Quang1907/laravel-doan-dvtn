@extends('layouts.admin_master')
@section('title', 'Orders')
@section('content')
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Orders</h2>
                </div>
            </div>
            <form action="" method="get">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Filter by Date</label>
                        <input type="date" name="date" value="{{ request()->date ?? date( 'Y-m-d' )  }}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="">Filter by Status</label>
                        <select class="form-control" name="status" id="">
                            <option value="" selected>Select Status</option>
                            <option {{ request()->status == "In progress" ? "selected" : "" }} value="In progress">In progress</option>
                            <option {{ request()->status == "Complated" ? "selected" : "" }} value="Complated">Complated</option>
                            <option {{ request()->status == "Pending" ? "selected" : "" }} value="Pending">Pending</option>
                            <option {{ request()->status == "Cancelled" ? "selected" : "" }} value="Cancelled">Cancelled</option>
                            <option {{ request()->status == "Out for Delivery" ? "selected" : "" }} value="Out for Delivery">Out for Delivery</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-6">
                        <button class="btn btn-primary" >Filter</button>
                    </div>
                </div>
            </form>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="table-wrap">
                        <table class="table table-responsive-xl">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Tracking no</th>
                                    <th>Username</th>
                                    <th>Payment Mode</th>
                                    <th>Ordered Date</th>
                                    <th>Status message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ( $orders as $orderItem )
                                <tr class="alert" role="alert">
                                    <td>{{ $orderItem->id }}</td>
                                    <td>{{ $orderItem->tracking_no}}</td>
                                    <td>{{ $orderItem->fullname }}</td>
                                    <td>{{ $orderItem->payment_mode }}</td>
                                    <td>{{ $orderItem->created_at->format( "d-m-Y" ) }}</td>
                                    <td>{{ $orderItem->status_message }}</td>
                                    <td><a href="{{ route( "orders.show", $orderItem ) }}">view</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $orders->appends( request()->all() )->links("vendor.pagination.client") }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
