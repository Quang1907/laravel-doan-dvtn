<?php

namespace App\Http\Livewire\Client\Product;

use App\Models\Cart;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Shop extends Component
{
    public $trendingProducts, $allCategoryProducts, $product ;

    public function mount( ) {
        $this->trendingProducts  = Product::where( "trending", true )->take( 10 )->get();
        $this->allCategoryProducts = CategoryProduct::all();
        $this->product = new Product;
    }


    public function addToCart( $productId ) {
        if ( Auth::check() ) {
            if ( $this->product->find( $productId )->where( "status", 1 )->exists() ) {
                // check for product color quantity and insert to cart
                $cart = Cart::where( "user_id", auth()->user()->id )->where( "product_id", $productId );

                if ( $this->product->productColors->count() > 0 ) {
                    if ( $this->productSelectedQuantity != null ) {
                        $productColor = $this->productColor;
                        if ( $productColor->quantity > 0 ) {
                            if ( $cart->exists() ) {
                                $cart->first()->update( [
                                    "user_id" => auth()->user()->id,
                                    "product_id" => $productId,
                                    "product_color_id" => $productColor->id,
                                    "quantity" => 1,
                                ] );
                            } else {
                                Cart::create( [
                                    "user_id" => auth()->user()->id,
                                    "product_id" => $productId,
                                    "product_color_id" => $productColor->id,
                                    "quantity" => 1,
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
                            "quantity" => 1,
                        ] );
                    } else {
                        Cart::create( [
                            "user_id" => auth()->user()->id,
                            "product_id" => $productId,
                            "quantity" => 1,
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

    public function render()
    {
        return view('livewire.client.product.shop');
    }
}
