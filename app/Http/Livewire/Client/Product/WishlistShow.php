<?php

namespace App\Http\Livewire\Client\Product;

use App\Models\Wishlist;
use Livewire\Component;

class WishlistShow extends Component
{
    public function removeWishlistItem( $wishlistId ) {
        $this->emit( "wishlistUpdated" );

        $wishlist = Wishlist::findOrFail( $wishlistId );

        $this->dispatchBrowserEvent('message',[
            'text' => "Bỏ yêu thích thành công.",
            'type' => "warning",
            'status' => "401",
        ]);
        $wishlist->delete();
    }

    public function render()
    {
        $wishlists = Wishlist::where( "user_id" , auth()->user()->id )->get();
        return view('livewire.client.product.wishlist-show', compact( "wishlists" ) );
    }
}
