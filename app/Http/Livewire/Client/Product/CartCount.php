<?php

namespace App\Http\Livewire\Client\Product;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartCount extends Component
{
    public $cartCount = 0;
    protected $listeners = [ "CartAddedUpdated" => "checkCartCount" ];

    public function checkCartCount() {
        if ( Auth::check() ) {
            return $this->cartCount = Cart::where( "user_id", auth()->user()->id )->count();
        }
    }

    public function render()
    {
        $this->checkCartCount();
        return view('livewire.client.product.cart-count', [
            "cartCount" => $this->cartCount,
        ]);
    }
}
