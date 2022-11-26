<section>
    @php( $total = 0 )
    @include( "layouts.inc.client.navbar_shop" )
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
            {{-- <div class="flex justify-between mt-10 mb-5">
                 <span class="font-semibold text-sm uppercase">Items {{ $carts->count() }}</span>
                <span class="font-semibold text-sm">{{ number_format( $total  ) }} VND</span>
            </div>
            <div>
                <label class="font-medium inline-block mb-3 text-sm uppercase">Shipping</label>
                <select class="block p-2 text-gray-600 w-full text-sm">
                <option>Standard shipping - $10.00</option>
                </select>
            </div>
            <div class="py-10">
                <label for="promo" class="font-semibold inline-block mb-3 text-sm uppercase">Promo Code</label>
                <input type="text" id="promo" placeholder="Enter your code" class="p-2 text-sm w-full">
            </div>
            <button class="bg-red-500 hover:bg-red-600 px-5 py-2 text-sm text-white uppercase">Apply</button> --}}
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
