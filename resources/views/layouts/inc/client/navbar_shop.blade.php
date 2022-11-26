<section>
    <nav class="relative w-full flex flex-wrap items-center justify-between py-3 bg-gray-100 text-gray-500 hover:text-gray-700 focus:text-gray-700">
        <div class="container-fluid w-full flex flex-wrap items-center justify-end px-6">
            <a href="{{ route( 'product.wishlist' ) }}" class="bg p-2 bg-blue-500 text-white hover:bg-blue-700 hover:text-gray-200 rounded-lg mx-1">
                <i class="fa-solid fa-heart"></i>
                <livewire:client.product.wishlist-count />
            </a>
            <a href="{{ route( 'product.cart' ) }}" class="bg p-2 bg-green-500 text-white hover:bg-green-700 hover:text-gray-200 rounded-lg mx-1">
                <i class="fa-solid fa-cart-shopping"></i>
                <livewire:client.product.cart-count />
            </a>
        </div>
    </nav>
</section>
