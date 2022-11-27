<section>
    @include( "layouts.inc.client.navbar_shop" )

    <!-- /navigation -->
    <div class="header has-text-centered">
        <div class="container">
            <div class="columns">
                <div class="column is-9-widescreen mx-auto">
                    <h1 class="mb-4 text-5xl font-bold uppercase">Product</h1>
                    <ul class="list-inline">
                        <li class="list-inline-item"><a class="text-default" href="{{ url('san-pham') }}">Shop
                                &nbsp; &nbsp; /</a></li>
                        <li class="list-inline-item text-primary">Product</li>
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

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <div class="flex flex-col md:flex-row -mx-4">
            <div class="md:flex-1 px-4">
                <div x-data="{ image: 1 }" x-cloak>
                    <div class="h-64 md:h-80 rounded-lg mb-4">
                        @foreach ( $product->productImages()->get() as $detail_key => $detail_image)
                            <div x-show="image === {{ $detail_key }}"
                                class="h-64 md:h-80 rounded-lg mb-4 flex items-center justify-center">
                                <img src="{{ asset( $detail_image->image ) }}" class="h-64 md:h-80 rounded-lg" alt="">
                            </div>
                        @endforeach
                    </div>

                    <div class="flex -mx-2 mb-4">
                        @foreach ( $product->productImages()->get() as $list_key => $list_image)
                            <div class="flex-1 px-2">
                                <button x-on:click="image = {{ $list_key }}"
                                    :class="{ 'ring-2 ring-indigo-300 ring-inset': image === {{ $list_key }} }"
                                    class="w-full rounded-lg flex items-center justify-center">
                                    <img src="{{ asset($list_image->image) }}" class="rounded-lg w-full"
                                        alt="">
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="md:flex-1 px-4">
                <p class="text-gray-500 text-sm"><a href="#" class="text-indigo-600 hover:underline">{{ $product->category_products->name }}</a>
                </p>
                <div class="flex">
                    <h2 class="mb-2 leading-tight tracking-tight font-bold text-gray-800 text-2xl md:text-3xl">
                        {{ $product->name }}
                    </h2>

                    <button wire:click="addToWishlist({{ $product->id }})"
                        class="rounded-full w-7 h-7 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4  focus:bg-red-200 focus:text-red-700  ">
                        <svg wire:loading.remove wire:target="addToWishlist" fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            class="w-5 h-5" viewBox="0 0 24 24">
                            <path
                                d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z">
                            </path>
                        </svg>
                        <span wire:loading wire:target="addToWishlist">...</span>
                    </button>
                </div>

                {{-- review and social --}}
                <div class="flex mb-4">
                    <span class="flex items-center">
                        <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                            </path>
                        </svg>
                        <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                            </path>
                        </svg>
                        <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                            </path>
                        </svg>
                        <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                            </path>
                        </svg>
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" class="w-4 h-4 text-indigo-500" viewBox="0 0 24 24">
                            <path
                                d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                            </path>
                        </svg>
                        <span class="text-gray-600 ml-3">4 Reviews</span>
                        <span class="px-2">|</span>
                        @if ( $product->quantity > 0 )
                            <span class='px-1 text-white bg-green-500 rounded-lg shadow-lg'>Còn hàng ( {{ $product->quantity }} ) </span>
                        @else
                            <span class='px-1 text-white bg-red-500 rounded-lg shadow-lg'>Hết hàng</span>
                        @endif
                    </span>
                    <span class="flex ml-3 pl-3 py-2 border-l-2 border-gray-200 space-x-2s">
                        <a class="text-gray-500">
                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                class="w-5 h-5" viewBox="0 0 24 24">
                                <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                            </svg>
                        </a>
                        <a class="text-gray-500">
                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                class="w-5 h-5" viewBox="0 0 24 24">
                                <path
                                    d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                                </path>
                            </svg>
                        </a>
                        <a class="text-gray-500">
                            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                class="w-5 h-5" viewBox="0 0 24 24">
                                <path
                                    d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z">
                                </path>
                            </svg>
                        </a>
                    </span>
                </div>
                <div class="flex items-center space-x-4 my-4">
                    <div>
                        <div class="rounded-lg bg-gray-100 flex py-2 px-3">
                            <span
                                class="font-bold text-indigo-600 text-3xl">{{ number_format( $product->selling_price ?? $product->original_price) }}</span>
                            <span class="text-indigo-400 mr-1 mt-1">VNĐ</span>
                        </div>
                    </div>
                    @if ( !empty( $product->selling_price ) )
                        <div class="flex-1">
                            <p class="text-green-500 text-xl font-semibold">Save 12%</p>
                            <del class="text-red-400 text-sm">{{ number_format( $product->original_price ) }} VND</del>
                        </div>
                    @endif
                </div>

                <p class="text-gray-500">{{ $product->small_description }}</p>

                <div class="flex items-center border-gray-100">
                    <div class="flex">
                        <span class="mr-3">Color: </span>
                        @forelse ( $product->productColors()->get() as $color )
                            <label
                                wire:click="colorSelected({{ $color->id }})"
                                class="mx-1 p-2 rounded-full border-4 hover:border-red-400 cursor-pointer"
                                style="background: {{ $color->code }};">
                            </label>
                        @empty
                            <span>: no color</span>
                        @endforelse
                        @if ( !empty( $productSelectedQuantity ) )
                            @if ( $productSelectedQuantity != "outofstock" )
                                <span class='px-1 text-white bg-green-500 rounded-lg shadow-lg'>Còn hàng( {{ $productSelectedQuantity }} )</span>
                            @else
                                <span class='px-1 text-white bg-red-500 rounded-lg shadow-lg'>Hết hàng</span>
                            @endif
                        @endif

                    </div>
                </div>
                <div class="flex py-4 space-x-4">
                        <!-- quanity -->
                        <div class="custom-number-input h-10 w-32">
                            <div class="flex flex-row h-10 w-full rounded-xl relative bg-transparent">
                                <button wire:click="decrementQuantity" data-action="decrement" class=" bg-gray-300 text-gray-600 hover:text-gray-700 rounded-l-xl hover:bg-gray-400 h-full w-20 cursor-pointer outline-none">
                                    <span class="m-auto text-2xl font-thin">−</span>
                                </button>
                                <input wire:model="quantityCount" type="number" class="focus:outline-none text-center w-full bg-gray-300 font-semibold text-md hover:text-black focus:text-black  md:text-basecursor-default flex items-center text-gray-700  outline-none" name="custom-input-number" value="1">
                                <button wire:click="incrementQuantity" value="{{ $this->quantityCount }}" data-action="increment" class="bg-gray-300 text-gray-600 hover:text-gray-700 hover:bg-gray-400 h-full w-20 rounded-r-xl cursor-pointer">
                                    <span class="m-auto text-2xl font-thin">+</span>
                                </button>
                            </div>
                        </div>

                    <button wire:click="addToCart({{ $product->id }})"  type="button"
                        class="px-6 font-semibold rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white">
                        Add to Cart
                    </button>
                    @if ( $cartCount > 0)
                        <button wire:click="removeCart({{ $product->id }})" type="button"
                            class="px-3 font-semibold rounded-xl bg-red-600 hover:bg-red-500 text-white">
                            Remove cart
                        </button>
                    @endif
                </div>
            </div>
        </div>

        {{--  tabls  --}}
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 rounded-t-lg border-b-2" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Thông tin sản phẩm</button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">Đánh giá</button>
                </li>
            </ul>
        </div>
        <div id="myTabContent">
            <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">{!! $product->description !!}</p>
            </div>
            <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
            </div>
        </div>
    </div>
</section>
