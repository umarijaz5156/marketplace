
 <x-app-layout>
 <x-slot name="header">
    <livewire:header type="simple">
    </x-slot>

<div class="m-40 overflow-x-auto relative shadow-md sm:rounded-lg">

    <table class="w-full text-sm text-left text-gray-500 drk:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 drk:bg-gray-700 drk:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    <span class="sr-only">Image</span>
                </th>
                <th scope="col" class="py-3 px-6">
                    Product
                </th>

                <th scope="col" class="py-3 px-6">
                    Seller
                </th>

                <th scope="col" class="py-3 px-6">
                    Total
                </th>
                <th scope="col" class="py-3 px-6">
                    Date
                </th>
                {{-- <th scope="col" class="py-3 px-6">
                    Delete
                </th> --}}
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b drk:bg-gray-800 drk:border-gray-700 hover:bg-gray-50 drk:hover:bg-gray-600">
                <td class="p-4 w-32">

                    <img src="{{asset('/gigs/images/'.$order->gig->mainImage->image_path)}}" alt="services">
                </td>
                <td class="py-4 px-6 font-semibold text-gray-900 drk:text-white">
                    {{$order->gig->gigDetail->title}}
                </td>
                <td class="py-4 px-6 font-semibold text-gray-900 drk:text-white">
                    {{$order->seller->seller_name}}
                </td>
                <td class="py-4 px-6 font-semibold text-gray-900 drk:text-white">
                    ${{$order->orderDetails->amount}}
                </td>
                <td class="py-4 px-6 font-semibold text-gray-900 drk:text-white">
                    {{$order->created_at->format('M d, Y')}}
                </td>
                {{-- <td class="py-4 px-6">
                    <a href="{{route('order.cancel', ['order' => $order])}}">
                        <button type="button" class="w-full cursor-pointer text-white bg-red-600 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 drk:bg-red-600 drk:hover:bg-red-700 drk:focus:ring-red-800">
                        Cancel Order
                    </button>
                    </a>

                    <a href="#" class="font-medium text-red-600 drk:text-red-500 hover:underline">Delete order</a>
                </td> --}}
            </tr>

        </tbody>
    </table>
   <div class="flex justify-end mr-2 mt-2">
       <div class=" mb-4 p-4 w-full max-w-md bg-white rounded-lg border shadow-md sm:p-8 drk:bg-gray-800 drk:border-gray-700">
           <div class="flex justify-between items-center mb-4">
               <h5 class="text-xl font-bold leading-none text-gray-900 drk:text-white">Order Summary</h5>

          </div>
          <div class="flow-root">
               <ul role="list" class="divide-y divide-gray-200 drk:divide-gray-700">
                   <li class="py-3 sm:py-4">
                       <div class="flex items-center space-x-4">

                           <div class="flex-1 min-w-0">
                               <p class="text-sm font-medium text-gray-900 truncate drk:text-white">
                                   Order Total
                               </p>

                           </div>
                           <div class="inline-flex items-center text-base font-semibold text-gray-900 drk:text-white">
                               ${{$order->orderDetails->amount}}
                           </div>
                       </div>
                   </li>
                   <li class="py-3 sm:py-4">
                       <div class="flex items-center space-x-4">

                           <div class="flex-1 min-w-0">
                               <p class="text-sm font-medium text-gray-900 truncate drk:text-white">
                                   Application Fee
                               </p>

                           </div>
                           <div class="inline-flex items-center text-base font-semibold text-gray-900 drk:text-white">
                               ${{$fee}}
                           </div>
                       </div>
                   </li>
                   <li class="py-3 sm:py-4">
                       <div class="flex items-center space-x-4">

                           <div class="flex-1 min-w-0">
                               <p class="text-sm font-medium text-gray-900 truncate drk:text-white">
                                  Total
                               </p>

                           </div>
                           <div class="inline-flex items-center text-base font-semibold text-gray-900 drk:text-white">
                               ${{ $order->orderDetails->amount + $fee}}
                           </div>
                       </div>
                   </li>

               </ul>
          </div>
       </div>
   </div>
    @if($order->status == App\Enums\OrderStatus::UnPaid->value)
        <x-stripe.card-form :order="$order"/>
    @else
        <p class="m-8 text-md">
            Thanks for your purchase, You can view your order details
            <a href="{{route('buyerorder_details' , ['id' => $order->id])}}" target="_blank" class="text-blue-400"> Here.</a>
        </p>
    @endif
</div>

@push('scripts')


    <script src="https://js.stripe.com/v3/"></script>

        <script>

    var stripe = Stripe(

        "{{ config('stripe.publishable')}}"
        );


    // Disable the button until we have Stripe set up on the page
    document.querySelector("#submit").disabled = true;
    var elements = stripe.elements();
            var style = {
                base: {
                    color: "#32325d",
                    fontFamily: 'Arial, sans-serif',
                    fontSmoothing: "antialiased",
                    fontSize: "22px",

                    "::placeholder": {
                        color: "#32325d"
                    }
                },
                invalid: {
                    fontFamily: 'Arial, sans-serif',
                    color: "#fa755a",
                    iconColor: "#fa755a"
                }
            };
            var card = elements.create('card', {

                style: style,

            });
            card.mount("#card-element");
            card.on("change", function(event) {

            // Disable the Pay button if there are no card details in the Element
            document.querySelector("#submit").disabled = event.empty;
            document.querySelector("#card-error").textContent = event.error ? event.error.message : "";
            });
            var form = document.getElementById("payment-form");
            form.addEventListener("submit", function(event) {
            event.preventDefault();

            // Complete payment when the submit button is clicked
            payWithCard(stripe, card, @json($clientKey));
            });

                  // Calls stripe.confirmCardPayment
        // If the card requires authentication Stripe shows a pop-up modal to
        // prompt the user to enter authentication details without leaving your page.
        var payWithCard = function(stripe, card, clientSecret) {
            loading(true);
            stripe
            .confirmCardPayment(clientSecret, {
                payment_method: {
                    card: card
                }
            })
            .then(function(result) {
                if (result.error) {
                        // Show error to your customer

                        showError(result.error.message);
                    } else {
                        // The payment succeeded!

                        orderComplete(result.paymentIntent.id);
                    }
                });
        };

           /* ------- UI helpers ------- */
        // Shows a success message when the payment is complete
        var orderComplete = function(paymentIntentId) {

            fetch("{{ route('order.success', ['order' => $order]) }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

            }).then((response) => response.json())
                .then((data) => {
                    console.log(data);
                   window.location = '/order/'+data.id+'/placed';
                })
                .catch((error) => {
                    showError(error.message);
                });
            // document
            // .querySelector(".result-message a")
            // .setAttribute(
            //     "href",
            //     "{{ route('orders') }}"
            //     );

            // document.querySelector(".result-message").classList.remove("hidden");
            // document.querySelector("#submit").disabled = true;


            // document.getElementById('submit').style.display = 'none';
            // document.getElementById('card-element').style.display = 'none';
        };

           var showError = function(errorMsgText) {
            loading(false);
            $("#error-div").removeClass('hidden');
            var errorMsg = document.querySelector("#card-error");
            errorMsg.textContent = errorMsgText;
            setTimeout(function() {
                $("#error-div").addClass('hidden');
                errorMsg.textContent = "";
            }, 4000);
        };
        // Show a spinner on payment submission
        var loading = function(isLoading) {
            if (isLoading) {
            // Disable the button and show a spinner
            document.querySelector("#submit").disabled = true;
            document.querySelector("#spinner").classList.remove("hidden");
            document.querySelector("#button-text").classList.add("hidden");
        } else {
            document.querySelector("#submit").disabled = false;
            document.querySelector("#spinner").classList.add("hidden");
            document.querySelector("#button-text").classList.remove("hidden");
        }
    };



</script>
@endpush

</x-app-layout>
