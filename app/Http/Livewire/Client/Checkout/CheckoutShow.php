<?php

namespace App\Http\Livewire\Client\Checkout;

use App\Mail\PlaceOrderMailable;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Str;

class CheckoutShow extends Component
{
    public $carts, $totalProductAmount;

    public $fullname, $email, $phone, $pincode, $address, $phonenumber, $payment_mode = null, $payment_id = null;
    public $listeners = [
        "validationForAll",
        "transactionEmit" => "paidOnlineOrder"
    ];

    public function paidOnlineOrder( $value ) {
        $this->payment_mode = "Paid by Paypal";
        $this->payment_id = $value;
        $codOrder = $this->placeOrder();
        if ( $codOrder ) {
            Cart::where( "user_id", auth()->user()->id )->delete();
            return redirect()->to( "thank-you" );
        } else {
            $this->dispatchBrowserEvent('message',[
                'text' => "Đã xảy ra lỗi",
                'type' => "warning",
                'status' => "404",
            ]);
        }
    }

    public function validationForAll() {
        $this->validate();
    }

    public function rules() {
        return [
            "fullname" => "required|string|max:121",
            "email" => "required|string|max:121",
            "phonenumber" => "required|string|max:11|min:10",
            "address" => "required|string|max:500",
            "pincode" => "required|string|max:6|min:6",
        ];
    }

    public function placeOrder() {
        $this->validate();
        $order = Order::create([
            "user_id" => auth()->user()->id,
            "tracking_no" => "funda-" . Str::random(10),
            "fullname" => $this->fullname,
            "phonenumber" => $this->phonenumber,
            "email" => $this->email,
            "pincode" => $this->pincode,
            "address" => $this->address,
            "status_message" => "In progress",
            "payment_mode" =>  $this->payment_mode,
            "payment_id" => $this->payment_id,
        ]);

        foreach ( $this->carts as $cartItem ) {
            $price = $cartItem->product->selling_price ?? $cartItem->product->original_price;
            OrderItem::create([
                "order_id" => $order->id,
                "product_id" => $cartItem->product_id,
                "product_color_id" => $cartItem->product_color_id,
                "quantity" => $cartItem->quantity,
                "price" => $cartItem->quantity * $price,
            ]);
            if ( $cartItem->product_color_id != null ) {
                $cartItem->productColorTable()->where( "id", $cartItem->product_color_id )->decrement( "quantity", $cartItem->quantity );
            } else {
                $cartItem->product()->where( "id", $cartItem->product_id )->decrement( "quantity", $cartItem->quantity );
            }
        }

        try {
            $order = Order::findOrfail( $order->id );
            Mail::to( "$order->email" )->send( new PlaceOrderMailable( $order ) );
        } catch (\Throwable $th) {
            //throw $th;
        }
        return $order;
    }

    public function codOrder() {
        $this->payment_mode = "Cash on delivery";
        $codOrder = $this->placeOrder();
        if ( $codOrder ) {
            Cart::where( "user_id", auth()->user()->id )->delete();
            return redirect()->to( "thank-you" );
        } else {
            $this->dispatchBrowserEvent('message',[
                'text' => "Đã xảy ra lỗi",
                'type' => "warning",
                'status' => "404",
            ]);
        }
    }

    public function totalProductAmount() {
        $this->totalProductAmount = 0;
        foreach ( $this->carts as $cartItem ) {
            $price = $cartItem->product->selling_price ?? $cartItem->product->original_price;
            $this->totalProductAmount += $price * $cartItem->quantity;
        }
    }

    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->phonenumber = auth()->user()->phonenumber;
        $this->address = auth()->user()->address;

        $this->carts = Cart::where( "user_id", auth()->user()->id )->with( "product" )->get();
        $this->totalProductAmount();
        return view('livewire.client.checkout.checkout-show',[
            "carts" => $this->carts,
            "totalProductAmount" => $this->totalProductAmount,
        ]);
    }
}
