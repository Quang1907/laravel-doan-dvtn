@extends('layouts.client_master')
@section('title', 'Trang chu')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
@endsection

@section('content')
    <!-- /navigation -->
    <div class="header has-text-centered">
        <div class="container">
            <div class="columns">
                <div class="column is-9-widescreen mx-auto">
                    <h1 class="mb-4 text-5xl font-bold uppercase">Shop</h1>
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
                                    <a href="{{ route('viewProduct', [$trendingProduct->category_products->slug, $trendingProduct->slug]) }}"
                                        class="relative rounded">
                                        <img alt="{{ $trendingProduct->name }}"
                                            src="{{ $trendingProduct->productImages->first()->image }}"
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
                                <fieldset>
                                    <legend class="block w-full bg-gray-50 px-5 py-3 text-xs font-medium">
                                        Type
                                    </legend>

                                    <div class="space-y-2 px-5 py-6">
                                        <div class="flex items-center">
                                            <input id="toy" type="checkbox" name="type[toy]"
                                                class="h-5 w-5 rounded border-gray-300" />

                                            <label for="toy" class="ml-3 text-sm font-medium">
                                                Toy
                                            </label>
                                        </div>

                                        <div class="flex items-center">
                                            <input id="game" type="checkbox" name="type[game]"
                                                class="h-5 w-5 rounded border-gray-300" />

                                            <label for="game" class="ml-3 text-sm font-medium">
                                                Game
                                            </label>
                                        </div>

                                        <div class="flex items-center">
                                            <input id="outdoor" type="checkbox" name="type[outdoor]"
                                                class="h-5 w-5 rounded border-gray-300" />

                                            <label for="outdoor" class="ml-3 text-sm font-medium">
                                                Outdoor
                                            </label>
                                        </div>

                                        <div class="pt-2">
                                            <button type="button" class="text-xs text-gray-500 underline">
                                                Reset Type
                                            </button>
                                        </div>
                                    </div>
                                </fieldset>

                                <div>
                                    <fieldset>
                                        <legend class="block w-full bg-gray-50 px-5 py-3 text-xs font-medium">
                                            Age
                                        </legend>

                                        <div class="space-y-2 px-5 py-6">
                                            <div class="flex items-center">
                                                <input id="3+" type="checkbox" name="age[3+]"
                                                    class="h-5 w-5 rounded border-gray-300" />

                                                <label for="3+" class="ml-3 text-sm font-medium">
                                                    3+
                                                </label>
                                            </div>

                                            <div class="flex items-center">
                                                <input id="8+" type="checkbox" name="age[8+]"
                                                    class="h-5 w-5 rounded border-gray-300" />

                                                <label for="8+" class="ml-3 text-sm font-medium">
                                                    8+
                                                </label>
                                            </div>

                                            <div class="flex items-center">
                                                <input id="12+" type="checkbox" name="age[12+]"
                                                    class="h-5 w-5 rounded border-gray-300" />

                                                <label for="12+" class="ml-3 text-sm font-medium">
                                                    12+
                                                </label>
                                            </div>

                                            <div class="flex items-center">
                                                <input id="16+" type="checkbox" name="age[16+]"
                                                    class="h-5 w-5 rounded border-gray-300" />

                                                <label for="16+" class="ml-3 text-sm font-medium">
                                                    16+
                                                </label>
                                            </div>

                                            <div class="pt-2">
                                                <button type="button" class="text-xs text-gray-500 underline">
                                                    Reset Age
                                                </button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="flex justify-between border-t border-gray-200 px-5 py-3">
                                    <button name="reset" type="button"
                                        class="rounded text-xs font-medium text-gray-600 underline">
                                        Reset All
                                    </button>

                                    <button name="commit" type="button"
                                        class="rounded bg-blue-600 px-5 py-3 text-xs font-medium text-white">
                                        Apply Filters
                                    </button>
                                </div>
                            </form>
                        </details>
                    </div>

                    {{-- product detail --}}
                    <div class="lg:col-span-3">
                        <h3>Hiển thị: {{ !empty( $categoryProduct->name ) ? $categoryProduct->name : 'Tất cả sản phẩm' }}</h3>
                        <div
                            class="mt-4 grid grid-cols-1 gap-px border border-gray-200 bg-gray-200 sm:grid-cols-2 lg:grid-cols-3">
                            @if ( !empty( $products ) )
                                @forelse ( $products as $product )
                                    <a href="#" class="relative block bg-white h-full">
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
                                        <img alt="Toy" src="{{ $product->productImages()->first()->image }}"
                                            class="mt-0 w-full object-contain" />
                                        <div class="p-2">
                                            <span
                                                class="inline-block bg-blue-400 px-3 py-1 text-xs font-medium text-white rounded">
                                                New
                                            </span>

                                            <h3 class="mt-4 text-lg font-bold">{{ $product->name }}</h3>

                                            <p class="mt-2 text-sm font-medium text-gray-600">
                                                {{ number_format($product->original_price) }} VNĐ
                                                <del class="text-red-500">
                                                    {{ number_format($product->selling_price ) ?? "" }} VNĐ
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
                                    <h3 class="text-1xl font-bold"> Hien tai chua co san pham
                                        {{ !empty( $categoryProduct->name ) ? $categoryProduct->name : '' }}</h3>
                                @endforelse
                            @endif
                        </div>
                        <div class="row">
                            {{ $products->links('vendor.pagination.client') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- List Image category --}}
        <section>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-7 gap-6 w-full">
                @foreach ( $allCategoryProducts as $allCategoryProduct )
                    <div class="relative p-4 w-full bg-white rounded-lg overflow-hidden flex flex-col justify-center items-center "
                        style="min-height: 160px">
                        <a class="" href="{{ route('category.product.slug', $allCategoryProduct->slug) }}">
                            <img src="{{ url_image($allCategoryProduct->image) }}"
                                class="w-16 h-16 bg-blue-500 rounded  hover:shadow-2xl p-2" alt="">
                        </a>
                        <h2 class="mt-2 text-gray-800 text-sm font-semibold line-clamp-1">
                            {{ $allCategoryProduct->name }}
                        </h2>
                    </div>
                @endforeach
            </div>
        </section>

        {{--  Related Products --}}
        <section>
            <div class="bg-gray-100 ">
                <h2 class="text-2xl p-3">Các sản phẩm liên quan</h2>
                <div class="px-10 pb-20 grid gap-10 lg:grid-cols-3 xl:grid-cols-4 sm:grid-cols-2">
                    <div
                        class="max-w-xs rounded-md overflow-hidden shadow-lg hover:scale-105 transition duration-500 cursor-pointer">
                        <div>
                            <img src="https://www.apple.com/newsroom/images/product/mac/standard/Apple_MacBook-Pro_16-inch-Screen_10182021_big_carousel.jpg.large.jpg"
                                alt="" />
                        </div>
                        <div class="py-4 px-4 bg-white">
                            <h3 class="text-md font-semibold text-gray-600">Apple MacBook Pro M1 13.3&quot; Silver 16GB/512GB
                                (MYDC2FN/A-16GB)</h3>
                            <p class="mt-4 text-lg font-thin">$ 2400</p>
                            <span
                                class="flex items-center justify-center mt-4 w-full bg-blue-400 hover:bg-blue-500 py-1 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sm font-medium text-white"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <button class="font-semibold text-white">Add to Basket</button>
                            </span>
                        </div>
                    </div>
                    <div
                        class="max-w-xs rounded-md overflow-hidden shadow-lg hover:scale-105 transition duration-500 cursor-pointer">
                        <div>
                            <img src="https://media.cnn.com/api/v1/images/stellar/prod/201116214440-9-macbook-air-review-silicon-underscoredjpg.jpg?q=w_2615,h_1556,x_0,y_0,c_fill"
                                alt="" />
                        </div>
                        <div class="py-4 px-4 bg-white">
                            <h3 class="text-md font-semibold text-gray-600">Apple MacBook Pro M1 13.3&quot; Silver 16GB/512GB
                                (MYDC2FN/A-16GB)</h3>
                            <p class="mt-4 text-lg font-thin">$ 2400</p>
                            <span
                                class="flex items-center justify-center mt-4 w-full bg-blue-400 hover:bg-blue-500 py-1 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sm font-medium text-white"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <button class="font-semibold text-white">Add to Basket</button>
                            </span>
                        </div>
                    </div>
                    <div
                        class="max-w-xs rounded-md overflow-hidden shadow-lg hover:scale-105 transition duration-500 cursor-pointer">
                        <div>
                            <img src="https://www.macworld.com/wp-content/uploads/2022/01/macbook-pro-compare.jpg?quality=50&strip=all&w=1024"
                                alt="" />
                        </div>
                        <div class="py-4 px-4 bg-white">
                            <h3 class="text-md font-semibold text-gray-600">Apple MacBook Pro M1 13.3&quot; Silver 16GB/512GB
                                (MYDC2FN/A-16GB)</h3>
                            <p class="mt-4 text-lg font-thin">$ 2400</p>
                            <span
                                class="flex items-center justify-center mt-4 w-full bg-blue-400 hover:bg-blue-500 py-1 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sm font-medium text-white"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <button class="font-semibold text-white">Add to Basket</button>
                            </span>
                        </div>
                    </div>
                    <div
                        class="max-w-xs rounded-md overflow-hidden shadow-lg hover:scale-105 transition duration-500 cursor-pointer">
                        <div>
                            <img src="https://img.republicworld.com/republic-prod/stories/promolarge/xhdpi/g1jzwrwrlfim5wux_1623141909.jpeg"
                                alt="" />
                        </div>
                        <div class="py-4 px-4 bg-white">
                            <h3 class="text-md font-semibold text-gray-600">Apple MacBook Pro M1 13.3&quot; Silver 16GB/512GB
                                (MYDC2FN/A-16GB)</h3>
                            <p class="mt-4 text-lg font-thin">$ 2400</p>
                            <span
                                class="flex items-center justify-center mt-4 w-full bg-blue-400 hover:bg-blue-500 py-1 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sm font-medium text-white"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <button class="font-semibold text-white">Add to Basket</button>
                            </span>
                        </div>
                    </div>
                    <div
                        class="max-w-xs rounded-md overflow-hidden shadow-lg hover:scale-105 transition duration-500 cursor-pointer">
                        <div>
                            <img src="https://cdn.mos.cms.futurecdn.net/GfinEMFXnT42BFxAcDc2rA.jpg" alt="" />
                        </div>
                        <div class="py-4 px-4 bg-white">
                            <h3 class="text-md font-semibold text-gray-600">Apple MacBook Pro M1 13.3&quot; Silver 16GB/512GB
                                (MYDC2FN/A-16GB)</h3>
                            <p class="mt-4 text-lg font-thin">$ 2400</p>
                            <span
                                class="flex items-center justify-center mt-4 w-full bg-blue-400 hover:bg-blue-500 py-1 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sm font-medium text-white"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <button class="font-semibold text-white">Add to Basket</button>
                            </span>
                        </div>
                    </div>
                    <div
                        class="max-w-xs rounded-md overflow-hidden shadow-lg hover:scale-105 transition duration-500 cursor-pointer">
                        <div>
                            <img src="https://images.indianexpress.com/2021/12/macbook-pro-2021-review-featured-image.jpg"
                                alt="" />
                        </div>
                        <div class="py-4 px-4 bg-white">
                            <h3 class="text-md font-semibold text-gray-600">Apple MacBook Pro M1 13.3&quot; Silver 16GB/512GB
                                (MYDC2FN/A-16GB)</h3>
                            <p class="mt-4 text-lg font-thin">$ 2400</p>
                            <span
                                class="flex items-center justify-center mt-4 w-full bg-blue-400 hover:bg-blue-500 py-1 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sm font-medium text-white"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                <button class="font-semibold text-white">Add to Basket</button>
                            </span>
                        </div>
                    </div>
                </div>
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
    </script>
@endsection
