<x-app-layout>

    <section class="py-10 px-4">
        <div class="container 2xl:max-w-screen-xl mx-auto  p-6 md:px-10 md:py-12 rounded-md bg-white shadow-xl">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="lg:col-span-2 order-1 lg:order-0">
                    <div>
                        <h1 class="text-2xl font-semibold ">
                            Payment Details
                        </h1>
                    </div>
                    <div  class="mt-6 space-y-4">

                        <div class="mt-8 space-y-4 pb-3 border-b border-[#E7EFFF]">
                            @if ($order->status == App\Enums\OrderStatus::UnPaid->value)
                            <x-stripe.card-form :order="$order" :fee="$fee" />
                            @else
                            <p class="m-8 text-md">
                                Thanks for your purchase, You can view your order details
                                <a href="{{ route('buyerorder_details', ['id' => $order->id]) }}" target="_blank"
                                    class="text-blue-400"> Here.</a>
                            </p>
                        @endif
                        </div>


                    </div>
                </div>
                <div class="order-0 lg:order-1">
                    @if($order->type == 'normal')
                    <div class="max-h-[280px]">
                        <img class="max-h-[280px] rounded-t-lg w-full object-cover"
                            src="{{ asset('/gigs/images/' . $order->gig->mainImage?->image_path) }}" alt="">
                    </div>
                    @endif
                    <div class="bg-[#F4FCFF] p-8 rounded-b-lg">
                        <div class="space-y-5">
                            <div class="flex justify-between items-center gap-5">
                                <h1 class="text-gray-400">

                                    Product
                                </h1>
                                <span class="font-semibold">

                                    @if($order->type == 'normal')
                                         {{ $order->gig->gigDetail->title }}
                                    @else
                                        {{ $order->offer?->title }}
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between items-center gap-5">
                                <h1 class="text-gray-400">
                                    Seller
                                </h1>
                                <span class="font-semibold">
                                    {{ $order->seller->seller_name }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center gap-5">
                                <h1 class="text-gray-400">
                                    Total
                                </h1>
                                <span class="font-semibold">
                                    ${{ $order->orderDetails->amount }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center gap-5">
                                <h1 class="text-gray-400">
                                    Date
                                </h1>
                                <span class="font-semibold">
                                    {{ $order->created_at->format('M d, Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>

    @push('scripts')
        <script src="https://js.stripe.com/v3/"></script>

        <script>
            const stripe = Stripe(

                "{{ config('stripe.publishable') }}"
            );
            let elements;

            initialize();
            //  checkStatus();

            document
                .querySelector("#payment-form")
                .addEventListener("submit", handleSubmit);

            async function initialize() {
                const clientSecret = '{{ $clientKey }}';

                elements = stripe.elements({
                    clientSecret: "{{ $clientKey }}"
                });

                // const linkAuthenticationElement = elements.create("linkAuthentication");
                // linkAuthenticationElement.mount("#link-authentication-element");

                const paymentElementOptions = {
                    layout: "tabs",
                };
                  const paymentElement = elements.create('payment', paymentElementOptions);
                paymentElement.mount("#payment-element");
                paymentElement.on("change", function(event) {

                    // Disable the Pay button if there are no card details in the Element
                    document.querySelector("#submit").disabled = event.empty;
                });
            }

            async function handleSubmit(e) {
                e.preventDefault();
                setLoading(true);

                const {
                    error
                } = await stripe.confirmPayment({
                    elements,
                    redirect: 'if_required'
                }).then(function(result) {
                    if (result.error) {
                        // if (result.error.type === "card_error" || result.error.type === "validation_error" || result.error.type === "card_declined") {
                            showMessage(result.error.message);
                        // } else {
                            // showMessage("An unexpected error occurred.");
                        // }
                    } else {
                        // The payment succeeded!

                        orderComplete(result.paymentIntent.id);
                    }
                });

                // This point will only be reached if there is an immediate error when
                // confirming the payment. Otherwise, your customer will be redirected to
                // your `return_url`. For some payment methods like iDEAL, your customer will
                // be redirected to an intermediate site first to authorize the payment, then
                // redirected to the `return_url`.
                // if (error.type === "card_error" || error.type === "validation_error") {
                    showMessage(error.message);
                // } else {
                    // showMessage("An unexpected error occurred.");
                // }

                setLoading(false);
            }

            var orderComplete = function(paymentIntentId) {

                fetch("{{ route('order.success', ['order' => $order]) }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                    }).then((response) => response.json())
                    .then((data) => {
                        if(data.type == 'order'){
                            window.location = '/order/' + data.id + '/placed';
                        } else{
                            window.location = '/messages/' + data.id;
                        }

                    })
                    .catch((error) => {
                        showMessage(error.message);
                    });

            };

            function showMessage(messageText) {
                setLoading(false);
                const messageContainer = document.querySelector("#payment-message");

                messageContainer.classList.remove("hidden");
                messageContainer.textContent = messageText;

                setTimeout(function() {
                    messageContainer.classList.add("hidden");
                    messageText.textContent = "";
                }, 4000);
            }

            // Show a spinner on payment submission
            function setLoading(isLoading) {
                if (isLoading) {
                    // Disable the button and show a spinner
                    document.querySelector("#submit").disabled = true;
                    document.querySelector("#spinner").classList.remove("btn_hidden");
                    document.querySelector("#button-text").classList.add("btn_hidden");
                } else {
                    document.querySelector("#submit").disabled = false;
                    document.querySelector("#spinner").classList.add("btn_hidden");
                    document.querySelector("#button-text").classList.remove("btn_hidden");
                }
            }
        </script>
    @endpush

</x-app-layout>
