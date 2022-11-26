@extends('layouts.admin_master')
@section('title', 'Orders')
@section('content')
<div class="pb-14 pt-4 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
    <div class="px-4 d-flex justify-content-between item-start space-y-2">
        <div class="mb-2">
            <h1 class="text-3xl uppercase font-bold dark:text-white lg:text-4xl leading-7 lg:leading-9 text-gray-800">
                Chi tiết đơn hàng
            </h1>
            <p>{{ $order->created_at->format( "d-m-Y h:i A" ) }} </p>
            <a href="{{ route( 'generateInvoice', $order ) }}" class="btn-sm btn-primary mb-0">Download Invoid</a>
            <a href="{{ route( 'viewInvoice', $order ) }}" target="_blank" class="btn-sm btn-primary mb-0">View Invoid</a>
        </div>
        <div>
            <a href="{{ route( 'orders.index' ) }}" class="btn btn-primary mb-0">Back</a>
        </div>
    </div>
    </p>
    <div
        class="d-flex items-stretch w-100 md:space-y-0 md:space-x-6">
        <div class="d-flex flex-column px-4 py-6 bg-white rounded space-y-6 mb-2 mx-4" style="width: 40%">
            <h3 class="text-xl dark:text-white font-semibold leading-5 text-gray-800">Order Detail</h3>
            <div
                class="d-flex justify-content-center items-center w-100 flex-column">
                <div class="d-flex justify-content-between w-100">
                    <p class="h6">Order ID</p>
                    <p>{{ $order->id }}</p>
                </div>
                <div class="d-flex justify-content-between items-center w-100">
                    <p class="h6">Tracking Id/No</p>
                    <p>{{ $order->tracking_no }}</p>
                </div>
                <div class="d-flex justify-content-between items-center w-100">
                    <p class="h6">Payment Mode</p>
                    <p>{{ $order->payment_mode }}</p>
                </div>
                <div class="d-flex justify-content-between items-center w-100">
                    <p class="h6">Order Status Message</p>
                    <p>{{ $order->status_message }}</p>
                </div>
            </div>
        </div>
        <div
            class="d-flex flex-column justify-content-center bg-white rounded px-4 py-3 w-50  space-y-6" style="width: 60%">
            <h3 class="text-xl dark:text-white font-semibold leading-5 text-gray-800">User Detail</h3>
            <div
                class="d-flex justify-content-center items-center w-100 flex-column">
                <div class="d-flex justify-content-between items-center w-100">
                    <p class="h6">Full Name</p>
                    <p>{{ $order->fullname }}</p>
                </div>
                <div class="d-flex justify-content-between items-center w-100">
                    <p class="h6">Email</p>
                    <p>{{ $order->email }}</p>
                </div>
                <div class="d-flex justify-content-between items-center w-100">
                    <p class="h6">Phone Number</p>
                    <p>{{ $order->phonenumber }}</p>
                </div>
                <div class="">
                    <p class="h6">Address</p>
                    <p>{{ $order->address }}</p>
                </div>
                <div class="d-flex justify-content-between items-center w-100">
                    <p class="h6">Pin Code</p>
                    <p>{{ $order->pincode }}</p>
                </div>
            </div>
        </div>
    </div>
    <div
        class="mt-10 d-flex flex-column xl:flex-row jusitfy-center items-stretch w-100 ">
        <div class="d-flex flex-column justify-content-start items-start w-100">
            <div
                class="d-flex flex-column justify-content-start items-start  px-4 py-4 w-100">
                <h3 class="text-lg md:text-xl dark:text-white font-semibold leading-6 xl:leading-5 text-gray-800">
                   Thông tin giỏ hàng
                </h3>
                @php( $total = 0 )
                @foreach ( $order->orderItems as $orderItem )
                    @php( $total += $orderItem->price )
                    <div
                        class="mt-4 md:mt-6 d-flex justify-content-start items-start w-100">
                        <div class="pb-4 md:pb-8 w-25">
                            <img class="w-100 hidden md:block rounded" src="{{ asset( $orderItem->product->image )}}"
                                alt="dress" />
                        </div>
                        <div
                            class="mx-3 flex-column d-flex justify-content-between items-start w-100 pb-8 md:space-y-0">
                            <div class="w-100 d-flex flex-column justify-content-start items-start space-y-8">
                                <h3 class="text-xl dark:text-white xl:text-2xl font-semibold leading-6 text-gray-800">
                                   {{ $orderItem->product->name }}
                                </h3>
                                <div class="d-flex justify-content-start items-start flex-column space-y-2">
                                    <p class="text-sm dark:text-white leading-none text-gray-800"><span
                                            class="dark:text-gray-700 text-gray-700">Color: </span>
                                        @if ( $orderItem->product_color_id )
                                            {{ $orderItem->productColor->color->name }}
                                        @else
                                            No color
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between space-x-8 items-start w-100">
                                <p class="text-base dark:text-white xl:text-lg leading-6">
                                    {{ number_format( $orderItem->product->selling_price ?? $orderItem->product->original_price ) }} VND
                                </p>
                                <p class="text-base dark:text-white xl:text-lg leading-6 text-gray-800">{{ $orderItem->quantity}}</p>
                                <p class="text-base dark:text-white xl:text-lg font-semibold leading-6 text-gray-800">
                                    {{ number_format( $orderItem->price ) }} VND</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <h4 class="h3 px-4">Total: {{ number_format( $total ) }} VND</h4>
        </div>
    </div>
</div>

<div class="card bg-white m-5">
    <div class="card-header"><h6 class="h3 ">Cập nhật đơn hàng</h6></div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-5 ">
                <form action="{{ route( "orders.update", $order ) }}" method="post">
                    @csrf
                    @method( "PUT" )
                    <div class="mb-3 ">
                        <label for="" class="form-label ">Status</label>
                        <select class="form-control" name="status" id="">
                            <option value="" selected>Select Status</option>
                            <option {{ $order->status_message  == "In progress" ? "selected" : "" }} value="In progress">In progress</option>
                            <option {{ $order->status_message  == "Complated" ? "selected" : "" }} value="Complated">Complated</option>
                            <option {{ $order->status_message  == "Pending" ? "selected" : "" }} value="Pending">Pending</option>
                            <option {{ $order->status_message  == "Cancelled" ? "selected" : "" }} value="Cancelled">Cancelled</option>
                            <option {{ $order->status_message  == "Out for Delivery" ? "selected" : "" }} value="Out for Delivery">Out for Delivery</option>
                        </select>
                    </div>
                    <button class="btn btn-success">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
