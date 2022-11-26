<section>
    @include( "layouts.inc.client.navbar_shop" )

    <div class="grid grid-cols-3">
        <div class="lg:col-span-2 col-span-3 bg-indigo-50 space-y-8 px-12 pb-4">
            <div class="mt-8 p-4 relative flex flex-col sm:flex-row sm:items-center bg-white shadow rounded-md">
                <div class="flex flex-row items-center border-b sm:border-b-0 w-full sm:w-auto">
                    <div class="text-yellow-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 sm:w-5 h-6 sm:h-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-sm font-medium ml-3">Checkout</div>
                </div>
                <div class="text-sm tracking-wide text-gray-500 sm:mt-0 sm:ml-4">Hoàn thành chi tiết vận chuyển và thanh toán của bạn dưới đây.</div>
                <div
                    class="absolute sm:relative sm:top-auto sm:right-auto ml-auto right-4 top-4 text-gray-400 hover:text-gray-800 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </div>
            </div>
            <div class="rounded-md">
                <form id="payment-form" method="POST" action="">
                    <section>
                        <h2 class="uppercase tracking-wide text-lg font-semibold text-gray-700 my-2">THÔNG TIN GIAO HÀNG & THANH TOÁN</h2>
                        <fieldset class="mb-3 bg-white shadow-lg rounded-xl text-gray-600">
                            <label class="flex h-12 py-3 items-center">
                                <span class="text-right px-2 w-28">Name</span>
                                <input wire:model.defer="fullname" type="text" id="fullname" class="border-0 focus:outline-none px-3 w-3/5" placeholder="Try Odinsson"
                                    required="">
                                    @error( "fullname" )<small class="text-red-500 items-center">{{ $message }}</small> @enderror
                            </label>
                            <label class="flex h-12 py-3 items-center">
                                <span class="text-right px-2 w-28">Email</span>
                                <input wire:model.defer="email" type="email" id="email" class="border-0 focus:outline-none px-3 w-3/5" placeholder="try@example.com"
                                required="" >
                                @error( "email" )<small class="text-red-500">{{ $message }}</small> @enderror
                            </label>
                            <label class="flex h-12 py-3 items-center">
                                <span class="text-right px-2 w-28">Phone Number</span>
                                <input wire:model.defer="phonenumber" type="number" id="phonenumber" class="border-0 focus:outline-none px-3 w-3/5" placeholder="0708050907"
                                required="" >
                                @error( "phonenumber" )<small class="text-red-500">{{ $message }}</small> @enderror
                            </label>
                            <label class="flex h-12 py-3 items-center">
                                <span class="text-right px-2 w-28">Address</span>
                                <input wire:model.defer="address" type="text" id="address" class="border-0 focus:outline-transparent px-3 w-3/5" placeholder="10 Street XYZ 654">
                                @error( "address" )<small class="text-red-500">{{ $message }}</small> @enderror
                            </label>
                            <label class="flex border-b border-gray-200 h-12 py-3 items-center">
                                <span class="text-right px-2 w-28">Pin-code</span>
                                <input wire:model.defer="pincode" type="number" id="pincode" class="border-0 focus:outline-transparent px-3 w-3/5" placeholder="98603">
                                @error( "pincode" )<small class="text-red-500">{{ $message }}</small> @enderror
                            </label>
                        </fieldset>
                    </section>
                </form>
            </div>

            <div wire:ignore>
                <div id="paypal-button-container" class="mt-2 text-center p-4 bg-white rounded-xl">
                </div>
                <button
                    wire:click="codOrder" wire:loading.attr="disable"
                    class="submit-button px-4 py-3 rounded-full text-white bg-blue-500 hover:bg-blue-600 focus:ring focus:outline-none w-full text-xl font-semibold transition-colors">
                    <span wire:loading.remove wire:target="codOrder" class="text-white">Mua hàng</span>
                    <span wire:loading wire:target="codOrder">Vui lòng đợi...</span>
                </button>
            </div>
        </div>
        <div class="col-span-1 bg-white lg:block hidden">
            <h1 class="py-3 border-b-2 text-xl text-gray-600 px-8">Thông tin hoá đơn</h1>
            @if (  $carts->count() > 0 )
                <ul class="py-6 border-b space-y-6 px-8">
                    @foreach ( $carts as $cartItem )
                        <li class="grid grid-cols-6 gap-2 border-b-1">
                            <div class="col-span-1 self-center">
                                <img src="{{ asset( $cartItem->product->image ) }}" alt="Product" class="rounded w-14">
                            </div>
                            <div class="flex flex-col col-span-3 pt-2">
                                <a class="uppercase" href="{{ route( 'viewProduct', [ $cartItem->product->category_products->slug, $cartItem->product->slug ]  ) }}">
                                    <span class="text-gray-600 text-md font-semi-bold">{{ $cartItem->product->name }}</span>
                                </a>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="px-8 border-b">
                    <div class="flex justify-between py-4 text-gray-600">
                        <span>Subtotal</span>
                        <span class="font-semibold text-blue-500">{{ number_format( $totalProductAmount ) }} VND</span>
                    </div>
                    <div class="flex justify-between py-4 text-gray-600">
                        <span>Shipping</span>
                        <span class="font-semibold text-blue-500">Free</span>
                    </div>
                </div>
                <div class="font-semibold text-xl px-8 flex justify-between py-8 text-gray-600">
                    <span>Tổng cộng</span>
                    <span>{{ number_format( $totalProductAmount ) }} VND</span>
                </div>
            @else
                <div class="">
                    <h3 class="p-3 text-center">Hiện tại bạn chưa có sản phẩm</h3>
                    <a href="{{ route( "shop" ) }}" class="mx-2 bg-yellow-500  rounded p-2 hover:text-white hover:bg-yellow-600 flex font-semibold text-white text-sm text-center">
                        <svg class="fill-current mr-2 text-white w-4" viewBox="0 0 448 512">
                            <path
                                d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
                        </svg>
                        Continue Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>
</section>

@section('script')
    <script src="https://www.paypal.com/sdk/js?client-id=AUMpZw7OPLZpQBZbmzrSXoThdSRbvAgRkexWDjV0P0yn-G-zllJ5sBJyudcYOfhPMnw3wf_C0yIz9N8j" data-sdk-integration-source="button-factory" data-namespace="paypal_sdk"> </script>
    <script>
        var money = "{{ $totalProductAmount }}" / 24800;

        paypal_sdk.Buttons({
            // onClick is called when the button is clicked
            onClick: function()  {
                // Show a validation error if the checkbox is not checked
                if ( !$('#fullname').val()
                    || !$('#email').val()
                    || !$('#phonenumber').val()
                    || !$('#address').val()
                    || !$('#pincode').val()
                ) {
                    Livewire.emit( "validationForAll" );
                    return false;
                }
            },

          // Sets up the transaction when a payment button is clicked
          createOrder: (data, actions) => {
            return actions.order.create({
              purchase_units: [{
                amount: {
                  value: money.toFixed(2) // Can also reference a variable or function
                }
              }]
            });
          },
          onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData) {
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                const transaction = orderData.purchase_units[0].payments.captures[0];
                if ( transaction.status == "COMPLETED" ) {
                    Livewire.emit( "transactionEmit", transaction.id  );
                }

            //   alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
            });
          }
        }).render('#paypal-button-container');
      </script>
@endsection
