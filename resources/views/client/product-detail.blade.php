@extends('layouts.client_master')
@section('title', 'Chi tiết sản phẩm')
@section('description', $product->meta_description )
@section('keywords', $product->meta_keyword )

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css"
        integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <livewire:client.product.view :product="$product"/>
@endsection

@section('script')
    <script src='https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js'></script>
@endsection
