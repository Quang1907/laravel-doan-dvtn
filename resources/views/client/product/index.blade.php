@extends('layouts.client_master')
@section('title', 'Cửa hàng')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endsection

@section('content')
    @include( "layouts.inc.client.navbar_shop" )

    <!-- /navigation -->
    <div class="header has-text-centered">
        <div class="container">
            <div class="columns">
                <div class="column is-9-widescreen mx-auto">
                    <h1 class="mb-4 text-5xl font-bold uppercase">{{ $categoryProduct->name }}</h1>
                    <ul class="list-inline">
                        <li class="list-inline-item"><a class="text-default" href="{{ url('/') }}">Trang chủ
                                &nbsp; &nbsp; /</a></li>
                        <li class="list-inline-item text-primary">Cửa hàng</li>
                    </ul>
                </div>
            </div>
        </div>

        <svg class="header-shape-1" width="39" height="40" viewBox="0 0 39 40" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z" stroke="#040306"
                stroke-miterlimit="10" />
            <path class="path" d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
            <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306"
                stroke-miterlimit="10" />
        </svg>


        <svg class="header-shape-2" width="39" height="39" viewBox="0 0 39 39" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <g filter="url(#filter0_d)">
                <path class="path"
                    d="M24.1587 21.5623C30.02 21.3764 34.6209 16.4742 34.435 10.6128C34.2491 4.75147 29.3468 0.1506 23.4855 0.336498C17.6241 0.522396 13.0233 5.42466 13.2092 11.286C13.3951 17.1474 18.2973 21.7482 24.1587 21.5623Z" />
                <path
                    d="M5.64626 20.0297C11.1568 19.9267 15.7407 24.2062 16.0362 29.6855L24.631 29.4616L24.1476 10.8081L5.41797 11.296L5.64626 20.0297Z"
                    stroke="#040306" stroke-miterlimit="10" />
            </g>
            <defs>
                <filter id="filter0_d" x="0.905273" y="0" width="37.8663" height="38.1979"
                    filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                    <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
                    <feOffset dy="4" />
                    <feGaussianBlur stdDeviation="2" />
                    <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                    <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow" />
                    <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape" />
                </filter>
            </defs>
        </svg>


        <svg class="header-shape-3" width="39" height="40" viewBox="0 0 39 40" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z" stroke="#040306"
                stroke-miterlimit="10" />
            <path class="path" d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
            <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306"
                stroke-miterlimit="10" />
        </svg>


        <svg class="header-border" height="240" viewBox="0 0 2202 240" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M1 123.043C67.2858 167.865 259.022 257.325 549.762 188.784C764.181 125.427 967.75 112.601 1200.42 169.707C1347.76 205.869 1901.91 374.562 2201 1"
                stroke-width="2" />
        </svg>
    </div>

    <div class="container">
        {{-- Featured products --}}
        <section>
            <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold">Sản phẩm nổi bật</h2>
                <div class="mt-4">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            @forelse ( $trendingProducts as $trendingProduct )
                                <div class="swiper-slide">
                                    <a href="{{ route('viewProduct', [ $trendingProduct->category_products->slug, $trendingProduct->slug]) }}"
                                        class="relative rounded">
                                        <img alt="{{ $trendingProduct->name }}"
                                            src="{{ $trendingProduct->image }}"
                                            class="h-56 w-full object-contain lg:h-72" />

                                        <div class="px-6 py-4">
                                            <span
                                                class="inline-block bg-blue-400 text-white rounded px-3 py-1 text-xs font-medium">
                                                New
                                            </span>

                                            <h3 class="mt-4 text-lg font-bold">{{ $trendingProduct->name }}</h3>

                                            <p class="mt-2 text-sm font-medium text-gray-600">
                                                <del class="text-red-500">{{ number_format($trendingProduct->original_price) }}
                                                    VNĐ</del>
                                                {{ number_format($trendingProduct->selling_price) }} VNĐ
                                            </p>

                                        </div>
                                    </a>

                                    <div class="flex items-center justify-evenly mb-3">
                                        <button type="button"
                                            class="p-2 rounded bg-blue-500 hover:bg-blue-700 text-sm  text-white">
                                            <span>Add to Cart</span>
                                            <i class="fa-solid fa-cart-shopping"></i>
                                        </button>
                                        <button type="button"
                                            class="p-2 rounded bg-red-500 hover:bg-red-700 text-sm  text-white">
                                            <span>WishList</span>
                                            <i class="fa-solid fa-heart"></i>
                                        </button>
                                        <a href="{{ route('viewProduct', [$trendingProduct->category_products->slug, $trendingProduct->slug]) }}"
                                            class="p-2 rounded bg-yellow-500 hover:bg-yellow-700 text-sm  hover:text-white text-white">
                                            <span>View</span>
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                        <div class="swiper-pagination !relative !bottom-0 mx-auto mt-8 max-w-3xl"></div>
                    </div>
                </div>
            </div>
        </section>

        {{-- List Products --}}
        <section>
            <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-4 lg:items-start">
                    {{-- filter  --}}
                    <div class="lg:sticky lg:top-4">
                        <details open class="overflow-hidden rounded border border-gray-200">
                            <summary class="flex items-center justify-between bg-gray-100 px-5 py-3 lg:hidden">
                                <span class="text-sm font-medium"> Toggle Filters </span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </summary>

                            <form class="border-t border-gray-200 lg:border-t-0">
                                {{-- Filter sort brand --}}
                                <fieldset>
                                    <legend class="block w-full bg-gray-50 px-5 py-3 text-xs font-medium">
                                        Search
                                    </legend>
                                    <div class="space-y-2 px-5 pb-4">
                                        <input type="text" name="search" value="{{ request()->search }}" class="rounded-xl" placeholder="Search">
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend class="block w-full bg-gray-50 px-5 py-3 text-xs font-medium">
                                        Branch
                                    </legend>

                                    <div class="space-y-2 px-5 pb-4">
                                        @forelse ( $categoryProduct->brands()->get() as $filterBrand )
                                            <div class="flex items-center">
                                                <input id="{{ $filterBrand->slug }}" type="checkbox" {{ check_brand( $filterBrand->id, format_array( request()->brand ) ) }} name="brand[{{ $filterBrand->id }}]"
                                                    class="h-5 w-5 rounded border-gray-300" />
                                                <label for="{{ $filterBrand->slug }}" class="ml-3 text-sm font-medium">
                                                    {{ $filterBrand->name }}
                                                </label>
                                            </div>
                                        @empty
                                        <span>No brand</span>
                                        @endforelse
                                    </div>
                                </fieldset>
                                {{-- Filter sort price --}}
                                <fieldset>
                                    <legend class="block w-full bg-gray-50 px-5 py-3 text-xs font-medium">
                                        Sort Price
                                    </legend>

                                    <div class="space-y-2 px-5 pb-4">
                                        <div class="flex items-center">
                                            <input id="hight_to_low" type="radio" value="hight_to_low" {{ request()->sort_price == "hight_to_low" ? "checked" : "" }} name="sort_price"
                                                class="h-5 w-5 rounded border-gray-300" />
                                            <label for="hight_to_low" class="ml-3 text-sm font-medium">
                                                High to low
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="low_to_hight" type="radio" value="low_to_hight" {{ request()->sort_price == "low_to_hight" ? "checked" : "" }}   name="sort_price"
                                                class="h-5 w-5 rounded border-gray-300" />
                                            <label for="low_to_hight" class="ml-3 text-sm font-medium">
                                                Low to hight
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="flex justify-between border-t border-gray-200 px-5 py-3">
                                    <a href="{{ route( 'category.product.slug' , $categoryProduct->slug ) }}"
                                        class="rounded text-xs font-medium text-gray-600 underline">
                                        Reset All
                                    </a>

                                    <button type="submit"
                                        class="rounded bg-blue-600 px-5 py-3 text-xs font-medium text-white">
                                        Apply Filters
                                    </button>
                                </div>
                            </form>
                        </details>
                    </div>

                    {{-- product detail --}}
                    <div class="lg:col-span-3">
                        @if ( request()->search )
                            <h3>Hiển thị: {{ request()->search }}</h3>
                        @else
                            <h3>Hiển thị: {{ !empty( $categoryProduct->name  )? $categoryProduct->name : 'Tất cả sản phẩm' }}</h3>
                        @endif

                        @php( $pagiProducts = $categoryProduct->products()->filter()->paginate( 9 ) )
                        <div
                            class="mt-4 grid grid-cols-1 gap-px border border-gray-200 bg-gray-200 sm:grid-cols-2 lg:grid-cols-3">
                            @if ( !empty( $categoryProduct->products ) )
                                @forelse ( $pagiProducts as $product )
                                    <a href="{{ route( 'viewProduct', [ $product->category_products->slug, $product->slug ]) }}" class="relative block bg-white h-full">
                                        <button type="button"
                                            class="absolute right-4 top-4 rounded-full bg-black p-2 text-white">
                                            <span class="sr-only">Wishlist</span>
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                                </path>
                                            </svg>
                                        </button>
                                        <img alt="Toy" src="{{ asset( $product->image ) }}"
                                            class="mt-0 w-full object-contain h-56 " />
                                        <div class="p-2">
                                            <span
                                                class="inline-block bg-blue-400 px-3 py-1 text-xs font-medium text-white rounded">
                                                New
                                            </span>

                                            <h3 class="mt-4 text-lg font-bold">{{ $product->name }}</h3>

                                            <p class="mt-2 text-sm font-medium text-gray-600">
                                                {{ number_format( $product->original_price ) }} VNĐ
                                                <del class="text-red-500">
                                                    {{ number_format( $product->selling_price ) ?? "" }} VNĐ
                                                </del>
                                            </p>


                                            <button type="button"
                                                class="mt-4 flex w-full items-center justify-center rounded-sm bg-blue-500 hover:bg-blue-600  px-8 py-2">
                                                <span class="text-sm font-medium text-white"> Add to Cart </span>

                                                <svg class="ml-1.5 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </a>
                                @empty
                                    <h3 class="text-1xl font-bold"> Hien tai chua co san pham <a class="text-blue-500 hover:text-blue-700" href="{{ route( 'shop' ) }}"><i class="fa-regular fa-circle-left"></i> Back</a></h3>
                                @endforelse
                            @endif
                        </div>
                        <div class="row">
                            {{ $pagiProducts->links('vendor.pagination.client') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- List Image category --}}
        <section>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ( $allCategoryProducts as $allCategoryProduct )
                    <div class="swiper-slide">
                        <div class="relative p-4 w-full bg-white rounded-lg overflow-hidden flex flex-col justify-center items-center "
                            style="min-height: 160px">
                            <a class="" href="{{ route('category.product.slug', $allCategoryProduct->slug) }}">
                                <img src="{{ url_image($allCategoryProduct->image) }}"
                                    class="w-16 border rounded-lg h-16 hover:shadow-2xl p-2" alt="">
                            </a>
                            <h2 class="mt-2 text-gray-800 text-sm font-semibold line-clamp-1">
                                {{ $allCategoryProduct->name }}
                            </h2>
                        </div>
                    </div>
                @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>

    </div>
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
            loop: true,
            spaceBetween: 0,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                "@0.00": {
                    slidesPerView: 2,
                },
                "@0.75": {
                    slidesPerView: 3,
                },
                "@1.00": {
                    slidesPerView: 4,
                },
                "@1.50": {
                    slidesPerView: 8,
                },
            },
        });
    </script>
@endsection
