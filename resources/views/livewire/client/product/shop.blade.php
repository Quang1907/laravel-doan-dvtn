<section>
    @include('layouts.inc.client.navbar_shop')
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
            <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z"
                stroke="#040306" stroke-miterlimit="10" />
            <path class="path"
                d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
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
            <path d="M0.965848 20.6397L0.943848 38.3906L18.6947 38.4126L18.7167 20.6617L0.965848 20.6397Z"
                stroke="#040306" stroke-miterlimit="10" />
            <path class="path"
                d="M10.4966 11.1283L10.4746 28.8792L28.2255 28.9012L28.2475 11.1503L10.4966 11.1283Z" />
            <path d="M20.0078 1.62949L19.9858 19.3804L37.7367 19.4024L37.7587 1.65149L20.0078 1.62949Z" stroke="#040306"
                stroke-miterlimit="10" />
        </svg>


        <svg class="header-border" height="240" viewBox="0 0 2202 240" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M1 123.043C67.2858 167.865 259.022 257.325 549.762 188.784C764.181 125.427 967.75 112.601 1200.42 169.707C1347.76 205.869 1901.91 374.562 2201 1"
                stroke-width="2" />
        </svg>
    </div>

    <div class="container">
        {{-- Featured products --}}
        <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold">Sản phẩm nổi bật</h2>
            <div class="mt-4" wire:ignore>
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @forelse ( $trendingProducts as $trendingProduct )
                            <div class="swiper-slide">
                                <a href="{{ route('viewProduct', [$trendingProduct->category_products->slug, $trendingProduct->slug]) }}"
                                    class="relative rounded">
                                    <img alt="{{ $trendingProduct->name }}" src="{{ $trendingProduct->image }}"
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
                                            {{ number_format( $trendingProduct->selling_price ) }} VNĐ
                                        </p>

                                    </div>
                                </a>

                                <div class="flex items-center justify-evenly mb-3">
                                    <button wire:click="addToCart({{ $trendingProduct->id }})" type="button"
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

        {{-- Products by categories --}}
        @foreach ( $allCategoryProducts as $cateProducts )
            @if ( $cateProducts->products()->count() > 0 )
                <div class="bg-gray-100">
                    <h2 class="text-2xl p-3 mb-2 uppercase rounded-lg bg-blue-500 text-white"><a
                            href="{{ route('category.product.slug', $cateProducts->slug) }}">{{ $cateProducts->name }}</a>
                    </h2>
                    <div class="px-10 pb-3 grid gap-10 lg:grid-cols-3 xl:grid-cols-4 sm:grid-cols-2">
                        @foreach ( $cateProducts->products()->limit(8)->get() as $cateProduct)
                            <div
                                class="max-w-xs rounded-md overflow-hidden shadow-lg hover:scale-105 transition duration-500 cursor-pointer">
                                <div>
                                    <a
                                        href="{{ route('viewProduct', [$cateProducts->slug, $cateProduct->slug]) }}">
                                        <img src="{{ $cateProduct->image }}" alt="" class="h-56 m-auto" />
                                    </a>
                                </div>
                                <div class="py-4 px-4 bg-white">
                                    <h3 class="text-md font-semibold text-gray-600 h-10">{{ $cateProduct->name }}</h3>
                                    <p class="mt-4 text-lg font-thin">
                                        {{ number_format($cateProduct->selling_price == 0 ? $cateProduct->original_price : $cateProduct->selling_price) }}
                                        VNĐ</p>
                                    <span
                                        class="flex items-center justify-center mt-4 w-full bg-blue-400 hover:bg-blue-500 py-1 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-6 w-6 text-sm font-medium text-white" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <button class="font-semibold text-white" wire:click="addToCart({{ $cateProduct->id }})">Add to Basket</button>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach

        {{-- List Image category --}}
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ( $allCategoryProducts as $allCategoryProduct )
                    <div class="swiper-slide">
                        <div class="relative p-4 w-full bg-white rounded-lg overflow-hidden flex flex-col justify-center items-center "
                            style="min-height: 160px">
                            <a class=""
                                href="{{ route('category.product.slug', $allCategoryProduct->slug) }}">
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
    </div>
</section>
