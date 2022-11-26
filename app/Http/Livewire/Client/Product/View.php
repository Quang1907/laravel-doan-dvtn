<?php

namespace App\Http\Livewire\Client\Product;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{
    public $product, $productSelectedQuantity, $wishlistCheck = false, $quantityCount = 1, $productColor, $cartCount ;

    public function mount( $product ) {
        $this->product = $product;
    }

    public function addToWishlist( $productWishlist ) {
        if ( Auth::check() ) {
            $wishlist = Wishlist::where( "user_id" , auth()->user()->id )->where( "product_id" , $productWishlist );
            if ( $wishlist->exists() ) {
                $this->dispatchBrowserEvent('message',[
                    'text' => "Bỏ yêu thích thành công.",
                    'type' => "warning",
                    'status' => "404",
                ]);
                $wishlist->delete();
            } else {
                $this->dispatchBrowserEvent('message',[
                    'text' => "Yêu thích thành công.",
                    'type' => "success",
                    'status' => "404",
                ]);

                Wishlist::create( [
                    "user_id" => auth()->user()->id,
                    "product_id" => $productWishlist
                ] );
                $this->wishlistCheck = true;
            }
            $this->emit( "wishlistUpdated" );
       } else {
        $this->dispatchBrowserEvent('message',[
            'text' => "Vui lòng đăng nhập trước khi like",
            'type' => "info",
            'status' => "404",
        ]);
        return false;
       }
    }

    public function decrementQuantity() {
        if (  $this->quantityCount > 1 ) {
            $this->quantityCount--;
        }
    }

    public function incrementQuantity() {
        $this->quantityCount++;
    }

    public function colorSelected( $productColorId ) {
        $productColor = $this->product->productColorTable()->where( "color_id", $productColorId )->first();
        $this->productSelectedQuantity = $productColor->quantity;

        if ( $this->productSelectedQuantity == 0 ) {
            $this->productSelectedQuantity = "outofstock";
        }

        $this->productColor = $productColor;
    }

    public function addToCart( $productId ) {
        if ( Auth::check() ) {
            if ( $this->product->find( $productId )->where( "status", 1 )->exists() ) {
                // check for product color quantity and insert to cart
                $cart = Cart::where( "user_id", auth()->user()->id )->where( "product_id", $productId );

                if ( $this->product->productColors->count() > 0 ) {
                    if ( $this->productSelectedQuantity != null ) {
                        $productColor = $this->productColor;
                        if ( $productColor->quantity > 0 && $productColor->quantity >= $this->quantityCount ) {
                            if ( $cart->exists() ) {
                                $cart->first()->update( [
                                    "user_id" => auth()->user()->id,
                                    "product_id" => $productId,
                                    "product_color_id" => $productColor->id,
                                    "quantity" => $this->quantityCount,
                                ] );
                            } else {
                                Cart::create( [
                                    "user_id" => auth()->user()->id,
                                    "product_id" => $productId,
                                    "product_color_id" => $productColor->id,
                                    "quantity" => $this->quantityCount,
                                ] );
                            }

                            $this->dispatchBrowserEvent('message',[
                                'text' => "Product added to cart",
                                'type' => "success",
                                'status' => "404",
                            ]);

                        } else {
                            $this->dispatchBrowserEvent('message',[
                                'text' => "Sản phẩm đã hết hàng hoặc không đủ số lượng",
                                'type' => "info",
                                'status' => "404",
                            ]);
                        }
                    } else {
                        $this->dispatchBrowserEvent('message',[
                            'text' => "Select Your Product Color",
                            'type' => "info",
                            'status' => "404",
                        ]);
                    }
                } else {
                    if ( $cart->exists() ) {
                        $cart->first()->update( [
                            "user_id" => auth()->user()->id,
                            "product_id" => $productId,
                            "quantity" => $this->quantityCount,
                        ] );
                    } else {
                        Cart::create( [
                            "user_id" => auth()->user()->id,
                            "product_id" => $productId,
                            "quantity" => $this->quantityCount,
                        ] );
                    }
                    $this->dispatchBrowserEvent('message',[
                        'text' => "Product added to cart",
                        'type' => "success",
                        'status' => "404",
                    ]);
                }
                $this->emit( "CartAddedUpdated" );
            }

        } else {
            $this->dispatchBrowserEvent('message',[
                'text' => "Vui lòng đăng nhập trước khi mua hàng",
                'type' => "info",
                'status' => "404",
            ]);
        }
    }

    public function removeCart( $productId ) {
        $this->dispatchBrowserEvent('message',[
            'text' => "Remove product from cart",
            'type' => "success",
            'status' => "404",
        ]);
        $this->emit( "CartAddedUpdated" );

        return Cart::where( "user_id", auth()->user()->id )->where( "product_id",  $productId  )->delete();
    }

    public function cartCount() {
        return Cart::where( "user_id", auth()->user()->id )->where( "product_id", $this->product->id  )->count();
    }

    public function render() {
        $this->cartCount = $this->cartCount();
        return view('livewire.client.product.view' , [
            "product" => $this->product,
            "productSelectedQuantity" => $this->productSelectedQuantity,
            "wishlistCheck" => $this->wishlistCheck,
            "cartCount" => $this->cartCount,
        ]);
    }
}
