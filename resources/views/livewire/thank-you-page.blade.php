<div>
    <div class=" container max-w-6xl mx-auto flex justify-center items-center h-screen px-4">
        <div class="text-center">
            <img style="height:480px;" src="{{ asset('images/Layer 176.png')}}" alt="">
            <h1 class="mt-[52px] text-2xl">
                You order has been successfully placed. You can view <a class="text-blue-400 underline hover:text-blue-500-" href="{{route('buyerorder_details', ['id' => $orderId])}}">Order Details</a><br>

            </h1>
        </div>
    </div>
</div>
