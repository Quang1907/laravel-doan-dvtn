@extends('layouts.client_master')
@section('title', 'Giỏ hàng')

@section('content')
    <section>
        @include( "layouts.inc.client.navbar_shop" )
        <div class="pb-14 pt-4 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
            <div class="flex justify-between item-start space-y-2">
                <h1 class="text-3xl uppercase font-bold dark:text-white lg:text-4xl leading-7 lg:leading-9 text-gray-800">
                    Chi tiết đơn hàng
                </h1>
                <a href="{{ route( 'orders' ) }}" class="p-2 bg-blue-500 rounded-xl text-white hover:text-white hover:bg-blue-600 shadow">Back</a>
            </div>
            <p class="text-base dark:text-gray-300 font-medium leading-6 text-gray-600">
                {{ $order->created_at->format( "d-m-Y h:i A" ) }}
            </p>
            <div
                class="flex justify-center md:flex-row flex-col items-stretch w-full space-y-4 md:space-y-0 md:space-x-6 xl:space-x-8">
                <div class="flex flex-col px-4 py-6 md:p-6 xl:p-8 w-full bg-gray-50 dark:bg-gray-800 space-y-6">
                    <h3 class="text-xl dark:text-white font-semibold leading-5 text-gray-800">Order Detail</h3>
                    <div
                        class="flex justify-center items-center w-full space-y-4 flex-col">
                        <div class="flex justify-between w-full">
                            <p class="text-base dark:text-white leading-4 text-gray-800">Order ID</p>
                            <p class="text-base dark:text-gray-300 leading-4 text-gray-600">{{ $order->id }}</p>
                        </div>
                        <div class="flex justify-between items-center w-full">
                            <p class="text-base dark:text-white leading-4 text-gray-800">Tracking Id/No</p>
                            <p class="text-base dark:text-gray-300 leading-4 text-gray-600">{{ $order->tracking_no }}</p>
                        </div>
                        <div class="flex justify-between items-center w-full">
                            <p class="text-base dark:text-white leading-4 text-gray-800">Payment Mode</p>
                            <p class="text-base dark:text-gray-300 leading-4 text-gray-600">{{ $order->payment_mode }}</p>
                        </div>
                        <div class="flex justify-between items-center w-full">
                            <p class="text-base dark:text-white leading-4 text-gray-800">Order Status Message</p>
                            <p class="text-base dark:text-gray-300 leading-4 text-gray-600">{{ $order->status_message }}</p>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-col justify-center px-4 py-3 w-full bg-gray-50 dark:bg-gray-800 space-y-6">
                    <h3 class="text-xl dark:text-white font-semibold leading-5 text-gray-800">User Detail</h3>
                    <div
                        class="flex justify-center items-center w-full space-y-4 flex-col">
                        <div class="flex justify-between w-full">
                            <p class="text-base dark:text-white leading-4 text-gray-800">Full Name</p>
                            <p class="text-base dark:text-gray-300 leading-4 text-gray-600">{{ $order->fullname }}</p>
                        </div>
                        <div class="flex justify-between items-center w-full">
                            <p class="text-base dark:text-white leading-4 text-gray-800">Email</p>
                            <p class="text-base dark:text-gray-300 leading-4 text-gray-600">{{ $order->email }}</p>
                        </div>
                        <div class="flex justify-between items-center w-full">
                            <p class="text-base dark:text-white leading-4 text-gray-800">Phone Number</p>
                            <p class="text-base dark:text-gray-300 leading-4 text-gray-600">{{ $order->phonenumber }}</p>
                        </div>
                        <div class="flex justify-between items-center w-full">
                            <p class="text-base dark:text-white leading-4 text-gray-800">Address</p>
                            <p class="text-base dark:text-gray-300 leading-4 text-gray-600">{{ $order->address }}</p>
                        </div>
                        <div class="flex justify-between items-center w-full">
                            <p class="text-base dark:text-white leading-4 text-gray-800">Pin Code</p>
                            <p class="text-base dark:text-gray-300 leading-4 text-gray-600">{{ $order->pincode }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="mt-10 flex flex-col xl:flex-row jusitfy-center items-stretch w-full xl:space-x-8 space-y-4 md:space-y-6 xl:space-y-0">
                <div class="flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
                    <div
                        class="flex flex-col justify-start items-start dark:bg-gray-800 bg-gray-50 px-4 py-4 md:py-6 md:p-6 xl:p-8 w-full">
                        <p class="text-lg md:text-xl dark:text-white font-semibold leading-6 xl:leading-5 text-gray-800">
                            Giỏ hàng của khách hàng
                        </p>
                        @php( $total = 0 )
                        @foreach ( $order->orderItems as $orderItem )
                            @php( $total += $orderItem->price )
                            <div
                                class="mt-4 md:mt-6 flex flex-col md:flex-row justify-start items-start md:items-center md:space-x-6 xl:space-x-8 w-full">
                                <div class="pb-4 md:pb-8 w-full md:w-40">
                                    <img class="w-full hidden md:block rounded-xl" src="{{ asset( $orderItem->product->image )}}"
                                        alt="dress" />
                                </div>
                                <div
                                    class="border-b border-gray-200 md:flex-row flex-col flex justify-between items-start w-full pb-8 space-y-4 md:space-y-0">
                                    <div class="w-full flex flex-col justify-start items-start space-y-8">
                                        <h3 class="text-xl dark:text-white xl:text-2xl font-semibold leading-6 text-gray-800">
                                           {{ $orderItem->product->name }}
                                        </h3>
                                        <div class="flex justify-start items-start flex-col space-y-2">
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
                                    <div class="flex justify-between space-x-8 items-start w-full">
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
                    <h4 class="h3">Total: {{ number_format( $total ) }} VND</h4>
                </div>
            </div>
        </div>
    </section>
@endsection
