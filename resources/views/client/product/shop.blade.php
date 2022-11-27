@extends('layouts.client_master')
@section('title', 'Cửa hàng')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endsection

@section('content')
    <livewire:client.product.shop/>
@endsection

@section('script')
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        window.addEventListener('resize', () => {
            const desktopScreen = window.innerWidth < 768

            document.querySelector('details').open = !desktopScreen
        })

        new Swiper('.swiper', {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 1,
            autoplay: true,
            pagination: {
                type: 'progressbar',
                el: '.swiper-pagination',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        })

        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 0,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                "@0.00": {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                "@0.75": {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                "@1.00": {
                    slidesPerView: 4,
                    spaceBetween: 40,
                },
                "@1.50": {
                    slidesPerView: 8,
                    spaceBetween: 50,
                },
            },
        });
    </script>
@endsection
