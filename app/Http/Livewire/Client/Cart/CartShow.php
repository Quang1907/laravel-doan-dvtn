<?php

namespace App\Http\Livewire\Client\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $carts;

    public function removeCart( $cartId ) {
        $cart = Cart::find( $cartId )->first();
        if ( $cart ) {
            $cart->delete();
            $this->dispatchBrowserEvent('message',[
                'text' => "Remove product from cart",
                'type' => "success",
                'status' => "202",
            ]);
            return $this->emit( "CartAddedUpdated" );
        }
    }

    public function decrementQuantity( $cartId ) {
        $cart = Cart::find( $cartId );
        if ( $cart['quantity'] > 1 ) {
            $cart->decrement( "quantity" );
            $this->dispatchBrowserEvent('message',[
                'text' => "Product updated successfully",
                'type' => "success",
                'status' => "202",
            ]);
        } else {
            $this->dispatchBrowserEvent('message',[
                'text' => "lowest quantity",
                'type' => "success",
                'status' => "202",
            ]);
        }
    }

    public function incrementQuantity( $cartId ) {
        $cart = Cart::find( $cartId );
        if ( !empty( $cart[ 'product_color_id' ] ) ) {
            if ( $cart->productColorTable->quantity > $cart[ 'quantity' ] ) {
                $cart->increment( "quantity") ;
                $this->dispatchBrowserEvent('message',[
                    'text' => "Product updated successfully",
                    'type' => "success",
                    'status' => "202",
                ]);
            } else {
                $this->dispatchBrowserEvent('message',[
                    'text' => "Maximum quantity",
                    'type' => "success",
                    'status' => "404",
                ]);
            }
        } else {
            if ( $cart->product->quantity > $cart[ 'quantity' ] ) {
                $cart->increment( "quantity") ;
                $this->dispatchBrowserEvent('message',[
                    'text' => "Product updated successfully",
                    'type' => "success",
                    'status' => "202",
                ]);
            } else {
                $this->dispatchBrowserEvent('message',[
                    'text' => "Maximum quantity",
                    'type' => "success",
                    'status' => "404",
                ]);
            }
        }
    }

    public function render()
    {
        $this->carts = Cart::where( "user_id", auth()->user()->id )->with( "product" )->get();
        return view('livewire.client.cart.cart-show', [
            "carts" => $this->carts,
        ]);
    }
}
