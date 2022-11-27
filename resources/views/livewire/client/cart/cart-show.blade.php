<section>
    @php( $total = 0 )
    @include( "layouts.inc.client.navbar_shop" )
    <!-- /navigation -->
    <div class="header has-text-centered">
        <div class="container">
            <div class="columns">
                <div class="column is-9-widescreen mx-auto">
                    <h1 class="mb-4 text-5xl font-bold uppercase">Cart</h1>
                    <ul class="list-inline">
                        <li class="list-inline-item"><a class="text-default" href="{{ url('san-pham') }}">Shop
                                &nbsp; &nbsp; /</a></li>
                        <li class="list-inline-item text-primary">Cart</li>
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
    <div class="flex shadow-md">
        <div class="w-3/4 bg-white px-10 py-10">
            <div class="flex justify-between border-b pb-8">
                <h1 class="font-semibold text-2xl">Shopping Cart</h1>
                <h2 class="font-semibold text-2xl">{{ $carts->count() }} Items</h2>
            </div>
            <div class="flex mt-10 mb-5">
                <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
                <h3 class="font-semibold text-gray-600 text-xs uppercase w-1/5 text-center">Quantity</h3>
                <h3 class="font-semibold text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
                <h3 class="font-semibold text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
            </div>
            @forelse ( $carts as $cartItem )
                {{-- product detail --}}
                @if ( $cartItem->count() > 0 )
                    <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                        <div class="flex w-2/5">
                            <!-- product -->
                            <div class="w-20">
                                <a href="{{ route( 'viewProduct', [ $cartItem->product->category_products->slug, $cartItem->product->slug ]  ) }}">
                                    <img class="rounded-xl" src="{{ $cartItem->product->image }}"
                                    alt="">
                                </a>
                            </div>
                            <div class="flex flex-col justify-between ml-4 ">
                                <a href="{{ route( 'viewProduct', [ $cartItem->product->category_products->slug, $cartItem->product->slug ]  ) }}">
                                    <span class="font-bold text-sm">{{ $cartItem->product->name }}</span>
                                </a>
                                <span class="text-blue-500 text-xs"> Color:
                                    @if ( $cartItem->productColorTable )
                                        {{ $cartItem->productColorTable->color->name  }}
                                    @else
                                        no color
                                    @endif
                                </span>
                                <span class="text-blue-500 text-xs">{{ $cartItem->product->category_products->name }}</span>
                                <button wire:click="removeCart({{ $cartItem->id }})"
                                    class="font-semibold hover:text-red-500 text-gray-500 text-xs">
                                    <span wire:loading.remove wire:click="removeCart({{ $cartItem->id }})">Remove</span>
                                    <span wire:loading >Removing</span>
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-center w-1/5">
                            <button wire:click="decrementQuantity({{ $cartItem->id }})">
                                <svg  class="fill-current text-gray-600 w-3" viewBox="0 0 448 512">
                                    <path
                                        d="M416 208H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
                                </svg>
                            </button>
                            <input class="mx-2 border text-center w-12" type="text" disabled value="{{ $cartItem->quantity }}">
                            <button  wire:click="incrementQuantity({{ $cartItem->id }})">
                                <svg class="fill-current text-gray-600 w-3" viewBox="0 0 448 512">
                                    <path
                                        d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z" />
                                </svg>
                            </button>
                        </div>
                        @php( $price = $cartItem->product->selling_price ?? $cartItem->product->original_price )
                        @php( $total += $cartItem->quantity * $price )
                        <span class="text-center w-1/5 font-semibold text-sm">{{ number_format( $price )  }} VND</span>
                        <span class="text-center w-1/5 font-semibold text-sm">{{ number_format( $cartItem->quantity * $price ) }} VND</span>
                    </div>
                @endif
            @empty
                <div>Hiện tại chưa có sản phẩm nào trong giỏ hàng</div>
            @endforelse
            <a href="{{ route( "shop" ) }}" class="flex font-semibold text-indigo-600 text-sm mt-10">
                <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                    <path
                        d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                </svg>
                Continue Shopping
            </a>
        </div>

        <div id="summary" class="w-1/4 px-8 py-10">
            <h1 class="font-semibold text-2xl">Order Summary</h1>
            <div class="border-t mt-8">
                <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                    <span>Total cost</span>
                    <span>{{ number_format( $total  ) }} VND</span>
                </div>
                <a href="{{ route( 'checkout' ) }}"
                    class="bg-indigo-500 hover:text-white font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase px-14">
                    Checkout
                </a>
            </div>
        </div>
    </div>
</section>
