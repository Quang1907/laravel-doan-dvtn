<?php

namespace App\Http\Livewire\Client\Product;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistCount extends Component
{
    public $wishlistCount;

    protected $listeners = [ "wishlistUpdated" => "checkWishlistCount" ];

    public function checkWishlistCount() {
        if ( Auth::check() ) {
            return $this->wishlistCount = Wishlist::where( "user_id" , auth()->user()->id )->count();
        } else {
            return $this->wishlistCount = 0;
        }
    }

    public function render()
    {
        $wishlistCount = $this->checkWishlistCount();
        return view('livewire.client.product.wishlist-count', [
            "wishlistCount" => $wishlistCount,
        ]);
    }
}
