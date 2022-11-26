<section>
    @include( "layouts.inc.client.navbar_shop" )

    <div class="flex shadow-md">
        <div class="w-full bg-white px-10 py-10">
            <div class="flex justify-between border-b pb-8">
                <h1 class="font-semibold text-2xl">Wishlists</h1>
                <h2 class="font-semibold text-2xl">{{ count( $wishlists ) }} Items</h2>
            </div>
            <div class="flex mt-10 mb-5">
                <h3 class="font-semibold text-gray-600 text-xs uppercase w-3/5">Product Details</h3>
                <h3 class="font-semibold text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
                <h3 class="font-semibold text-gray-600 text-xs uppercase w-1/5 text-center">Remove</h3>
            </div>
            @forelse ( $wishlists as $wishlistItem )
                @if ( !empty( $wishlistItem->product ) )
                    {{-- product detail --}}
                    <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5 border-b">
                        <div class="flex w-3/5">
                            <!-- product -->
                            <div class="w-20">
                                <img class="rounded-lg" src="{{ $wishlistItem->product->image }}"
                                    alt="">
                            </div>
                            <div class="flex flex-col justify-between ml-4 flex-grow">
                                <a href="{{ route( 'viewProduct', [ $wishlistItem->product->category_products->slug, $wishlistItem->product->slug ]  ) }}" class="font-bold text-sm hover:text-blue-500">{{ $wishlistItem->product->name }}</a>
                                <span class="text-blue-500 text-xs">{{ $wishlistItem->product->category_products->name }}</span>
                            </div>
                        </div>
                        <div class="flex justify-center w-1/5">
                            <span>{{ number_format( $wishlistItem->product->selling_price ?? $wishlistItem->product->original_price )  }} VND</span>
                        </div>
                        <div class="flex justify-center w-1/5">
                            <button wire:click="removeWishlistItem({{ $wishlistItem->id }})"
                                class="p-2 bg-red-500 text-white rounded-lg px-3 hover:bg-red-600 hover:shadow-lg ">
                                <span wire:loading.remove wire:target="removeWishlistItem({{ $wishlistItem->id }})"><i class="fa-solid fa-trash"></i>Remove</span>
                                <span wire:loading wire:target="removeWishlistItem({{ $wishlistItem->id }})" >Removing...</span>
                            </button>
                        </div>
                    </div>
                @endif

            @empty
                Hiện chưa có sản phẩm yêu thích
            @endforelse

            <a href="{{ route( "shop" ) }}" class="flex font-semibold text-indigo-600 text-sm mt-10">

                <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                    <path
                        d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                </svg>
                Continue Shopping
            </a>
        </div>
    </div>
</section>
