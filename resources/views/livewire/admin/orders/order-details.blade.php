<div class="w-full max-w-full px-3 mt-6">
    <div class="my-2">
        @if (session('success'))
            <x-alerts.success :success="session('success')" />
        @endif

        {{-- Show stripe messages --}}
        <x-stripe.notification />
    </div>

    <div class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 px-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
            <div class="flex justify-between">
                <div>
                    <h6 class="mb-0">Order Details</h6>
                    <p>(ID# {{ $order->id }})</p>

                    @if ($order->status != App\Enums\OrderStatus::Cancelled->value && $order->status != App\Enums\OrderStatus::Completed->value)
                        @if ($isCancellationRequest)
                                <p class="text-gray-600">{{ $cancellationRequest->subject == 'Buyer' ? 'Buyer' : 'Seller'}} wants to cancel the order?</p>
                                <button type="button" wire:click="toggleCancelModal"
                                    class="focus:outline-none text-white bg-green-400 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Accept</button>
                                <button type="button" wire:click="toggleRejectModal"
                                    class="focus:outline-none text-white bg-red-400 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-red-600 drk:hover:bg-red-700 drk:focus:ring-red-800">Decline</button>
                        @else
                            <button type="button" wire:click="toggleCancelModal"
                                class="w-full focus:outline-none text-white bg-yellow-400 hover:bg-orange-600 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-orange-600 drk:hover:bg-orange-700 drk:focus:ring-orange-800">
                                Cancel Order
                            </button>
                        @endif
                    @endif
                </div>
                <div class="">
                    @if ($order->status == App\Enums\OrderStatus::Pending->value ||
                        $order->status == App\Enums\OrderStatus::InProgress->value)
                        <button type="button" wire:click="toggleModal"
                            class="w-full focus:outline-none text-white bg-green-400 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Deliver
                            Order</button>
                    @endif

                    <div class="flex-none w-1/2 max-w-full px-3 text-right">
                        <a class="inline-block px-6 py-3 font-bold text-center uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md
                        {{ $order->status == App\Enums\OrderStatus::InProgress->value
                            ? 'bg-purple-200 text-purple-600'
                            : ($order->status == App\Enums\OrderStatus::Pending->value
                                ? 'bg-red-200 text-red-600'
                                : ($order->status == App\Enums\OrderStatus::Disputed->value
                                    ? 'bg-red-200 text-red-600'
                                    : ($order->status == App\Enums\OrderStatus::Delivered->value
                                        ? 'bg-yellow-200 text-yellow-600'
                                        : ($order->status == App\Enums\OrderStatus::Completed->value
                                            ? 'bg-green-200 text-green-600'
                                            : ($order->status == App\Enums\OrderStatus::Cancelled->value
                                                ? 'bg-orange-200 text-orange-600'
                                                    : ''))))) }}
                        hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25"
                            href="javascript:;"> {{ $orderDetail->status }}
                        </a>

                    </div>
                    <div class="mt-4">
                        @if($order->status == App\Enums\OrderStatus::Delivered->value)
                            <button type="button" wire:click="toggleModal3" class="focus:outline-none text-white bg-green-400 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Accept Order</button>
                            <button type="button" wire:click="toggleModal4" class="focus:outline-none text-white bg-red-400 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-red-600 drk:hover:bg-red-700 drk:focus:ring-red-800">Request Modifications</button>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class="flex-auto p-4 pt-6">
            <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                <div
                    class="relative flex flex-col w-full min-w-0 mb-4 p-4 pt-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th
                                            class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Service</th>
                                        <th
                                            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Seller</th>
                                        <th
                                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Buyer</th>
                                        <th
                                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Amount</th>
                                        <th
                                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Order Date</th>
                                        <th
                                            class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Delivery Date</th>
                                        <th
                                            class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            @if($orderDetail->type == 'normal')
                                            <div class="flex flex-col justify-center">
                                                <img src="{{ asset('/gigs/images/' . $orderDetail->gig->mainImage->image_path) }}"
                                                    class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-40 w-40 rounded-xl"
                                                    alt="user1" />
                                                <h6 class="mt-1 mb-0 leading-normal text-sm">
                                                    {{ $orderDetail->gig->gigDetail->title }}
                                                </h6>
                                            </div>
                                            @else
                                            <h6 class="mt-1 mb-0 leading-normal text-sm">
                                                {{ $orderDetail->offer->title }}
                                            </h6>
                                            @endif
                                        </td>
                                        <td
                                            class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 font-semibold leading-tight text-sm">
                                                {{ $orderDetail->seller->seller_name }}</p>
                                        </td>
                                        <td
                                            class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 font-semibold leading-tight text-sm">
                                                {{ $orderDetail->user->name }}</p>
                                        </td>
                                        <td
                                            class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 font-semibold leading-tight text-sm">
                                                ${{ number_format($orderDetail->orderDetails?->amount, 2) }}</p>
                                        </td>
                                        <td
                                            class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 font-semibold leading-tight text-sm">
                                                {{ $orderDetail->created_at->format('M, d Y') }}</p>
                                        </td>
                                        <td
                                            class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 font-semibold leading-tight text-sm">
                                                {{ $orderDetail->orderDetails?->delivery_time->format('M, d Y') }}</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <li
                    class="relative flex p-6 mb-2 bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex flex-col">
                        <h6 class="mb-4 leading-normal text-sm">Buyer Requirements</h6>
                        @if(isset($order->ordeDetails->buyer_requirements))
                        @foreach ($order->orderDetails?->buyer_requirements as $req)
                        <p class="text-[#6A6A6A] text-sm">{{$req}}</p>
                        @endforeach
                        @endif
                    </div>
                </li>

                @if (count($orderDetail->orderAttachments->where('is_delivery', false)) > 0)
                    <div
                        class="relative flex flex-col w-full min-w-0 mt-4 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border max-h-[300px] overflow-auto">
                        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                            <h6>Attachments</h6>
                        </div>
                        <div class="flex-auto px-0 pt-0 pb-2">
                            <div class="p-0 overflow-x-auto">
                                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                    <thead class="align-bottom">
                                        <tr>
                                            <th
                                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                File Name</th>
                                            <th
                                                class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Added By</th>
                                            <th
                                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Added At</th>
                                            <th
                                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderDetail->orderAttachments->where('is_delivery', false) as $attachment)
                                            <tr>
                                                <td
                                                    class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <div class="flex px-2 py-1">
                                                        <h6 class="mb-0 leading-normal text-sm">
                                                            {{ substr($attachment->attachment_path, strpos($attachment->attachment_path, '/') + 1) }}
                                                        </h6>
                                                    </div>
                                                </td>
                                                <td
                                                    class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-xs">
                                                        {{ $attachment->added_by }}</p>
                                                </td>
                                                <td
                                                    class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent">
                                                    {{ $attachment->created_at->diffForHumans() }}
                                                </td>
                                                <td
                                                    class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <button wire:click="download('{{ $attachment->attachment_path }}')"
                                                        class="bg-grey-light hover:bg-grey text-grey-drkest font-bold py-2 px-4 rounded inline-flex items-center">
                                                        <svg class="fill-current w-4 h-4 mr-2"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" />
                                                        </svg>
                                                        <span>Download</span>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- order timeline table --}}
                @if(count($orderDetail->timeline) > 0)
                    <div
                        class="relative flex flex-col w-full min-w-0 mt-4 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border max-h-[300px] overflow-auto">
                        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                            <h6>Order Timeline</h6>
                        </div>
                        <div class="flex-auto px-0 pt-0 pb-2">
                            <div class="p-0 overflow-x-auto">
                                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                    <thead class="align-bottom">
                                        <tr>
                                            <th
                                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Modified at</th>
                                            <th
                                                class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Status</th>
                                            <th
                                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                By</th>
                                            <th
                                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderDetail->timeline as $timeline)
                                            <tr>
                                                <td
                                                    class="px-4 p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <div class="flex px-2 py-1">
                                                        <h6 class="mb-0 leading-normal text-sm">
                                                            {{ $timeline->created_at->format('M d, H:i:a') }}
                                                        </h6>
                                                    </div>
                                                </td>
                                                <td
                                                    class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-xs">
                                                        {{ $timeline->status }}</p>
                                                </td>
                                                <td
                                                    class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent">
                                                    {{ $timeline->request_by }}
                                                </td>
                                                <td
                                                    class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    @if($timeline->file_path)
                                                        <button wire:click="download('{{ $timeline->file_path }}')"
                                                            class="bg-grey-light hover:bg-grey text-grey-drkest font-bold py-2 px-4 rounded inline-flex items-center">
                                                            <svg class="fill-current w-4 h-4 mr-2"
                                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                                <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" />
                                                            </svg>
                                                            <span>Download</span>
                                                        </button>
                                                    @endif

                                                    @if($timeline->modifications)
                                                        <button wire:click="showModifDetails('{{ $timeline->modifications }}')"
                                                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                                            <span>Details</span>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- delivered files table --}}
                @if(count($orderDetail->orderAttachments->where('is_delivery', true)) > 0)
                    <div
                        class="relative flex flex-col w-full min-w-0 mt-4 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border max-h-[300px] overflow-auto">
                        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                            <h6>Delivered Files</h6>
                        </div>
                        <div class="flex-auto px-0 pt-0 pb-2">
                            <div class="p-0 overflow-x-auto">
                                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                    <thead class="align-bottom">
                                        <tr>
                                            <th
                                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                File Name</th>
                                            <th
                                                class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Added By</th>
                                            <th
                                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Added At</th>
                                            <th
                                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderDetail->orderAttachments->where('is_delivery', true) as $delivered)
                                            <tr>
                                                <td
                                                    class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <div class="flex px-2 py-1">
                                                        <h6 class="mb-0 leading-normal text-sm">
                                                            {{ substr($delivered->attachment_path, strpos($delivered->attachment_path, '/') + 1) }}
                                                        </h6>
                                                    </div>
                                                </td>
                                                <td
                                                    class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-xs">
                                                        {{ $delivered->added_by }}</p>
                                                </td>
                                                <td
                                                    class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent">
                                                    {{ $delivered->created_at->diffForHumans() }}
                                                </td>
                                                <td
                                                    class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <button wire:click="download('{{ $delivered->attachment_path }}')"
                                                        class="bg-grey-light hover:bg-grey text-grey-drkest font-bold py-2 px-4 rounded inline-flex items-center">
                                                        <svg class="fill-current w-4 h-4 mr-2"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                            <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" />
                                                        </svg>
                                                        <span>Download</span>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- order timeline table --}}
                @if(count($orderDetail->orderReviews) > 0)
                    <div
                        class="relative flex flex-col w-full min-w-0 mt-4 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border max-h-[300px] overflow-auto">
                        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                            <h6>Order Reviews</h6>
                        </div>
                        <div class="flex-auto px-0 pt-0 pb-2">
                            <div class="p-0 overflow-x-auto">
                                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                    <thead class="align-bottom">
                                        <tr>
                                            <th
                                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Review</th>
                                            <th
                                                class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Rating</th>
                                            <th
                                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Review By</th>
                                            <th
                                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderDetail->orderReviews as $review)
                                            <tr>
                                                <td
                                                    class="px-4 p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <div class="flex px-2 py-1">
                                                        <h6 class="mb-0 leading-normal text-sm">
                                                            {{ $review->review }}
                                                        </h6>
                                                    </div>
                                                </td>
                                                <td
                                                    class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    <p class="mb-0 font-semibold leading-tight text-xs">
                                                        <div class="flex items-center">
                                                            <svg aria-hidden="true" class="w-5 h-5 {{$review->rating > 0 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500'}} " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>First star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                            <svg aria-hidden="true" class="w-5 h-5 {{$review->rating > 1 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500'}}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Second star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                            <svg aria-hidden="true" class="w-5 h-5 {{$review->rating > 2 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500'}}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Third star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                            <svg aria-hidden="true" class="w-5 h-5 {{$review->rating > 3 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500'}}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fourth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                            <svg aria-hidden="true" class="w-5 h-5 {{$review->rating > 4 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500'}}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fifth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                        </div>
                                                    </p>
                                                </td>
                                                <td
                                                    class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap shadow-transparent">
                                                    {{ $review->review_type }}
                                                </td>
                                                <td
                                                    class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                    {{ $review->created_at->format('M d, Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </ul>

        </div>
    </div>

    {{-- deliver project modal --}}
    <x-jet-dialog-modal wire:model="openModal">
        <x-slot name="title">
            Deliver Order
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-inputs.label for="details">Delivery Details</x-inputs.label>


                <x-inputs.text-area wire:model.lazy="details" rows="4" placeholder="Add details here...">
                </x-inputs.text-area>
                @error('details')
                    <x-form-error>{{ $message }}</x-form-error>
                @enderror

            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-900 drk:text-gray-300" for="file_input">Upload
                    files</label>
                <div class="flex justify-center items-center w-full">

                    <input wire:model="files"
                        class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer drk:text-gray-400 focus:outline-none drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400"
                        id="file_input" multiple type="file" accept="image/*,application/pdf,text/plain,.zip">


                </div>
                @error('files')
                    <x-form-error>{{ $message }}</x-form-error>
                @enderror
                @if (count($fileNames) > 0)
                    <ul class="ml-2 list-disc">
                        @foreach ($fileNames as $name)
                            <li>
                                <div class="flex">
                                    {{ $name }}
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif

                {{-- <p class="mt-1 text-sm text-gray-500 drk:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF
                    (MAX. 800x400px).</p> --}}
            </div>

        </x-slot>


        <x-slot name="footer">
            <div wire:loading.remove wire:target='files'>
                <button type="button" wire:click="deliverOrder"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Deliver</button>
            </div>
            <div wire:loading wire:target="files">
                <button type="button"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Loading...</button>
            </div>
            <button type="button" wire:click="toggleModal"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-gray-800 drk:text-white drk:border-gray-600 drk:hover:bg-gray-700 drk:hover:border-gray-600 drk:focus:ring-gray-700">Cancel</button>
        </x-slot>

    </x-jet-dialog-modal>

    {{-- cancel order modal --}}
    <x-jet-dialog-modal wire:model="cancelModal">
        <x-slot name="title">
            Cancel Order
        </x-slot>

        <x-slot name="content">
            <button wire:click="toggleCancelModal" type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center drk:hover:bg-gray-800 drk:hover:text-white"
                >
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 drk:text-gray-200"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 drk:text-gray-400">Are you sure you want to cancel
                    this order?</h3>
                <button wire:click="cancelOrder" type="button"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Yes, I'm sure
                </button>
                <button wire:click="toggleCancelModal" type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 drk:bg-gray-700 drk:text-gray-300 drk:border-gray-500 drk:hover:text-white drk:hover:bg-gray-600 drk:focus:ring-gray-600">No,
                    cancel</button>
            </div>
        </x-slot>


        <x-slot name="footer">
            {{-- <button type="button" wire:click="acceptOrder" class="focus:outline-none text-white bg-red-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Decline</button> --}}

        </x-slot>

    </x-jet-dialog-modal>

    {{-- Reject cancellation order request modal --}}
    <x-jet-dialog-modal wire:model="rejectModal">
        <x-slot name="title">
            Reject request
        </x-slot>

        <x-slot name="content">
            <button wire:click="toggleModal2" type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center drk:hover:bg-gray-800 drk:hover:text-white"
                >
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 drk:text-gray-200"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 drk:text-gray-400">Are you sure you want to reject the order cancellation request?</h3>
                <button wire:click="abortCancellationRequest" type="button"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Yes, I'm sure
                </button>
                <button wire:click="toggleRejectModal" type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 drk:bg-gray-700 drk:text-gray-300 drk:border-gray-500 drk:hover:text-white drk:hover:bg-gray-600 drk:focus:ring-gray-600">No,
                    cancel</button>
            </div>
        </x-slot>


        <x-slot name="footer">
            {{-- <button type="button" wire:click="acceptOrder" class="focus:outline-none text-white bg-red-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Decline</button> --}}

        </x-slot>

    </x-jet-dialog-modal>

    {{-- Accept Order --}}
    <x-jet-dialog-modal wire:model="openModal3">
        <x-slot name="title">
            Accept Order
        </x-slot>

        <x-slot name="content">
                    <button wire:click="toggleModal3" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center drk:hover:bg-gray-800 drk:hover:text-white" >
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 drk:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 drk:text-gray-400">Are you sure you want to accept this order?</h3>
                        <button wire:click="acceptOrder" type="button" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Yes, I'm sure
                        </button>
                        <button wire:click="toggleModal3" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 drk:bg-gray-700 drk:text-gray-300 drk:border-gray-500 drk:hover:text-white drk:hover:bg-gray-600 drk:focus:ring-gray-600">No, cancel</button>
                    </div>
        </x-slot>


        <x-slot name="footer">
            {{-- <button type="button" wire:click="acceptOrder" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Decline</button> --}}

        </x-slot>

    </x-jet-dialog-modal>

    {{-- request modifications model --}}
    <x-jet-dialog-modal wire:model="openModal4">
        <x-slot name="title">
            Request Modifications
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-inputs.label for="details">Modifications Details</x-inputs.label>


                <x-inputs.text-area wire:model="modificationDetails" rows="4" placeholder="Add details here...">
                </x-inputs.text-area>
                @error('modificationDetails')<x-form-error>{{$message}}</x-form-error>@enderror

            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-900 drk:text-gray-300" for="file_input">Upload
                    files</label>
                <div class="flex justify-center items-center w-full">

                    <input wire:model="modificationFile" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer drk:text-gray-400 focus:outline-none drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400" id="file_input"  accept="image/*,application/pdf,text/plain,.zip"  type="file">


                </div>
                @error('modificationFile')<x-form-error>{{$message}}</x-form-error>@enderror


                {{-- <p class="mt-1 text-sm text-gray-500 drk:text-gray-300" id="file_input_help">SVG, PNG, JPG or GIF
                    (MAX. 800x400px).</p> --}}
            </div>

        </x-slot>


        <x-slot name="footer">
            <div wire:loading.remove wire:target="modificationFile">
                <button type="button" wire:click="sendModifications"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Send</button>
            </div>
            <div wire:loading wire:target="modificationFile">
                <button type="button"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Loading..</button>
            </div>
            <button type="button" wire:click="toggleModal4"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-gray-800 drk:text-white drk:border-gray-600 drk:hover:bg-gray-700 drk:hover:border-gray-600 drk:focus:ring-gray-700">Cancel</button>
        </x-slot>

    </x-jet-dialog-modal>

    {{-- Show modification details modal --}}
    <x-jet-dialog-modal wire:model="modifModal">
        <x-slot name="title">
           Details
        </x-slot>

        <x-slot name="content">
            <p class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white">{{$viewModificationDetails}}</p>
        </x-slot>

        <x-slot name="footer">

        </x-slot>

    </x-jet-dialog-modal>


    @push('scripts')
        @once
            <script>
                document.addEventListener('order_completed',event => {

                    fetch("/stripe/order/transfer/"+event.detail.id, {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },

                        }).then((response) => {
                            if (!response.ok) {
                                $('#error').removeClass('hidden');
                                $('#error_message').text("Error occured while completing order! Please try again");
                                setTimeout(function() {
                                    $("#error").addClass('hidden');
                                    $('#error_message').text("");

                                }, 4000);
                            }

                            return response.text();

                        })
                        .then((data) => {

                                if(JSON.parse(data).transfered == true){
                                    $('#success').removeClass('hidden');
                                    $('#success_message').text("Completed Successfully");
                                    setTimeout(function() {
                                    $("#success").addClass('hidden');
                                    $('#success_messsage').text("");
                                    Livewire.emit('refreshOrder');
                                }, 3000);
                                } else{
                                    $('#error').removeClass('hidden');
                                    $('#error_message').text("Error occured while completing order! Please try again");
                                    setTimeout(function() {
                                    $("#error").addClass('hidden');
                                    $('#error_message').text("");

                                }, 4000);
                                }


                        })

                        .catch((error) =>{
                            $('#error').removeClass('hidden');
                        $('#error_message').text(error);
                                setTimeout(function() {
                                    $("#error").addClass('hidden');
                                    $('#error_message').text("");

                                }, 4000);
                        });
                });

                document.addEventListener('order_cancelled',event => {

                fetch("/stripe/order/cancel/"+event.detail.id, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                    })
                    .then((response) => {
                        if (!response.ok) {
                            $('#error').removeClass('hidden');
                            $('#error_message').text("Error occured while cancelling! Please try again");
                            setTimeout(function() {
                                $("#error").addClass('hidden');
                                $('#error_message').text("");

                            }, 4000);
                        }
                        return response.text();
                    })
                    .then((data) => {

                        if(JSON.parse(data).refunded== true){
                            $('#success').removeClass('hidden');
                            $('#success_message').text("Cancelled Successfully");
                            setTimeout(function() {
                                $("#success").addClass('hidden');
                                $('#success_messsage').text("");
                                Livewire.emit('refreshOrder');
                            }, 3000);

                        } else {
                            $('#error').removeClass('hidden');
                            $('#error_message').text("Error occured while cancelling! Please try again");
                            setTimeout(function() {
                                $("#error").addClass('hidden');
                                $('#error_message').text("");

                            }, 4000);
                        }
                })
                .catch((error) =>{
                        $('#error').removeClass('hidden');
                            $('#error_message').text(error);
                            setTimeout(function() {
                                $("#error").addClass('hidden');
                                $('#error_message').text("");
                            }, 4000);
                    });
            });
            </script>
        @endonce
    @endpush
</div>
