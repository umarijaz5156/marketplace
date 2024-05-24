<div>
    @if(session()->has('message'))

        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 60000)" id="alert-border-3"
            class=" flex p-4 mb-4 bg-green-100 border-t-4 border-green-500 drk:bg-green-200" role="alert">
            <svg class="flex-shrink-0 w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"></path>
            </svg>
            <div class="ml-3 text-sm font-medium text-green-700">
                {{ session('message') }}
            </div>

        </div>

    @endif
    @if(session()->has('error'))

    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 60000)" id="alert-border-3"
        class=" flex p-4 mb-4 bg-red-100 border-t-4 border-red-500 drk:bg-green-200" role="alert">
        <svg class="flex-shrink-0 w-5 h-5 text-red-700" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                clip-rule="evenodd"></path>
        </svg>
        <div class="ml-3 text-sm font-medium text-red-700">
            {{ session('error') }}
        </div>

    </div>

@endif
    {{-- <x-stripe.notification /> --}}
    <!-- Hero Section -->
    <section>

        <div>
            <div class="container 2xl:max-w-screen-xl mx-auto px-4 h-full pt-14 relative">
                <div class="flex justify-between items-center gap-6 flex-wrap">
                    <div>
                        <h1 class="text-[#263238] text-5xl font-bold">Order Details</h1>
                        <div class="flex justify-start items-center gap-4 mt-6">
                            <h5 class="text-[#263238] text-lg font-medium">Order <span>#{{$order->id}}</span></h5>
                            <span class="
                        {{$order->status == App\Enums\OrderStatus::InProgress->value ? 'bg-purple-200 text-purple-600' :
                            ($order->status == App\Enums\OrderStatus::Pending->value ? 'bg-red-200 text-red-600' :
                            ($order->status == App\Enums\OrderStatus::Cancelled->value ? 'bg-red-200 text-red-600' :
                            ($order->status == App\Enums\OrderStatus::Disputed->value ? 'bg-red-200 text-red-600' :
                            ($order->status == App\Enums\OrderStatus::Delivered->value ? 'bg-yellow-200 text-yellow-600' :
                            ($order->status == App\Enums\OrderStatus::Completed->value ? 'bg-green-200 text-green-600' :

                           ''
                            ) )
                            ))
                            )
                        }}
                         px-6 py-1 rounded font-semibold text-sm">{{$order->status}}</span></small></h3>
                        </div>
                    </div>
                    <div>
                        <div class="flex gap-3">

                            @if($order->status == App\Enums\OrderStatus::InProgress->value || $order->status ==
                            App\Enums\OrderStatus::Delivered->value || $order->status ==
                            App\Enums\OrderStatus::Pending->value)

                            <livewire:dispute.create :order="$order" />
                            @endif
                            @if($order->status == App\Enums\OrderStatus::Disputed->value)
                            <button wire:click="redirectDispute" type="button"
                                class="bg-red-200 text-red-500 rounded px-6 py-3  font-medium text-sm"> <i
                                    class="fa fa-exclamation-triangle mr-2"></i>Open Dispute</button>
                            @endif
                            <button wire:click='redirectChat'
                                class="bg-[#E9F9FF] rounded px-6 py-3 text-[#0096D8] font-medium text-sm"> <i
                                    class="fa-solid fa-envelope mr-2"></i> Message</button>

                        </div>


                        @if(isset($rating))
                        <div class="float-right flex items-center mt-9">
                            <svg aria-hidden="true" class="w-5 h-5 {{$rating > 0 ? 'text-[#FFC700]' : 'text-gray-500'}}"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>First star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg aria-hidden="true" class="w-5 h-5 {{$rating > 1 ? 'text-[#FFC700]' : 'text-gray-500'}}"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>Second star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg aria-hidden="true" class="w-5 h-5 {{$rating > 2 ? 'text-[#FFC700]' : 'text-gray-500'}}"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>Third star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg aria-hidden="true" class="w-5 h-5 {{$rating > 3 ? 'text-[#FFC700]' : 'text-gray-500'}}"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>Fourth star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <svg aria-hidden="true"
                                class="w-5 h-5 {{$rating > 4 ? 'text-[#FFC700]' : 'text-gray-500'}} drk:text-gray-500"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>Fifth star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                            <p class="ml-2 text-sm font-medium text-[#FFC700] drk:text-gray-400"> {{$rating}}</p>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="mt-12">
                    <div class="overflow-x-auto relative">
                        <table class="lg:w-full text-sm text-left text-gray-500 drk:text-gray-400">
                            <thead
                                class="text-sm border-b border-[#E2EAED] text-[#6A6A6A] uppercase drk:bg-gray-700 drk:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        ITEM
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        SELLER
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        ORDER DATE
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        DUE ON
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        TOTAL
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class=" border-b border-[#E2EAED]  drk:bg-gray-800 drk:border-gray-700">
                                    <th class="py-4 px-6 font-medium text-gray-900  drk:text-white">
                                        @if($order->type == 'normal')
                                        <a href="{{route('gig_details', ['slug' => $order->gig->gigDetail->slug])}}">
                                            <div class="flex justify-start items-center gap-3 w-max">
                                                @if($order->gig->mainImage?->mime_type == 'mp4')
                                                <video src="{{asset('/gigs/images/'.$order->gig->mainImage?->image_path) }}" width="60px" height="64px" class="rounded-[4px]"></video>
                                                @else
                                                <img src="{{asset('/gigs/images/'.$order->gig->mainImage?->image_path) }}"  alt="gig" class="w-28 h-[72px] rounded-lg ">
                                                @endif
                                                {{-- <img class="w-28 h-[72px] rounded-lg "
                                                    src="{{asset('/gigs/images/'.$order->gig->mainImage->image_path) }}"
                                                    alt=""> --}}
                                                <h4
                                                    class="text-[#263238] font-semibold text-sm text-ellipsis overflow-hidden ...">
                                                    {{$order->gig->gigDetail->title}}</h4>

                                            </div>
                                        </a>
                                        @else
                                        <h4
                                            class="text-[#263238] font-semibold text-sm text-ellipsis overflow-hidden ...">
                                            {{$order->offer?->title}}</h4>

                                        @endif
                                    </th>
                                    <td class="py-4 px-6">
                                        <a href="{{ route('view_profile', ['name' => $order->seller->seller_name]) }}">
                                            <h4 class="text-[#263238] font-semibold text-sm">
                                                {{$order->seller->seller_name}}</h4>
                                        </a>
                                    </td>
                                    <td class="py-4 px-6">
                                        <h4 class="text-[#263238] font-semibold text-sm">
                                            {{$order->created_at->format('M, d Y')}}</h4>
                                    </td>
                                    <td class="py-4 px-6">
                                        <h4 class="text-[#263238] font-semibold text-sm">
                                            {{$order->orderDetails->delivery_time ?
                                            $order->orderDetails->delivery_time->format('M, d Y') : '--'}}</h4>
                                    </td>
                                    <td class="py-4 px-6">
                                        <h4 class="text-[#263238] font-semibold text-sm">
                                            ${{$order->orderDetails->amount}}</h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section -->

    <section>
        <div class="container 2xl:max-w-screen-xl mx-auto px-4 mt-14 relative">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 sm:p-6">
                    <div class=" gap-3 relative pl-[68px]">
                        <div class="absolute left-0">
                            <img class="w-14 h-14 rounded-lg" src="{{asset('images/newui/order-requirments.png')}}"
                                alt="">
                        </div>
                        <div class="">
                            <h1 class="text-[#263238] font-bold text-lg">Order requirements</h1>
                            <p class="text-sm text-[#263238]">Buyers submitted order requirements</p>
                            <div class="mt-3">
                                <h1 class="text-[#263238] font-bold text-base">
                                    Content requirements
                                </h1>
                                <div class="space-y-4">

                                    @if(gettype($order->orderDetails?->buyer_requirements) == 'string')
                                    <p class="text-[#6A6A6A] text-sm">{{$order->orderDetails->buyer_requirements}}</p>
                                    @else
                                    @if(isset($order->orderDetails->buyer_requirements))
                                        @foreach ($order->orderDetails?->buyer_requirements as $req)
                                        <p class="text-[#6A6A6A] text-sm">{{$req}}</p>
                                        @endforeach
                                    @endif
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-12">
                        <ol class="relative border-l border-gray-200 drk:border-gray-700 ml-[1.1rem]"
                            x-data="{selected:0}">


                            @foreach ($order->timeline as $timeline)
                            @if ($timeline->status == 'Delivered')

                            <li class="mb-10 ml-[45px]">
                                <span
                                    class="flex absolute -left-[23px] justify-center items-center w-[45px] h-[45px] text-xl font-bold bg-[#FFC700] rounded-full text-white">
                                    <i class="fa-light fa-cube"></i>
                                </span>
                                <button class="flex justify-between items-center gap-3 w-full"
                                    @click="selected !== {{$loop->index}} ? selected = {{$loop->index}} : selected = null">
                                    <h1 class="text-[#263238] font-bold text-base">{{$order->seller->seller_name }}
                                        delivered the order <span
                                            class="text-xs font-medium">{{$timeline->created_at->format('M d, H:i
                                            A')}}</span></h1>
                                    <i class="fa-solid fa-chevron-down transition-all duration-200 ease-linear"
                                        x-bind:class="selected == {{$loop->index}}  ? 'rotate-180 ' : ''">
                                    </i>
                                </button>
                                <div class="relative overflow-auto transition-all duration-300 ease-in   "
                                    x-bind:class="selected == {{$loop->index}} ? 'block animate-[show-transition_0.5s_ease-in-out]' : 'opacity-0 hidden'"
                                    id="style-2">
                                    <div class="sm:px-4 py-3">
                                        <div class="border border-[#E2EAED]">
                                            <div class="bg-[#E2EAED] py-2 px-5 border-b border-[#E2EAED]">
                                                <h4 class="text-black font-semibold text-sm">DELIVERY </h4>
                                            </div>
                                            <div class="flex  justify-start items-start gap-2 p-4">
                                                <img class="w-10 h-10 rounded-full"
                                                    src="https://ui-avatars.com/api/?name={{$order->seller->seller_name }}"
                                                    alt="">
                                                <div>
                                                    <h4 class="text-black font-semibold text-sm">
                                                        {{$order->seller->seller_name }}</h4>
                                                    <div class="space-y-6 text-sm text-[#6A6A6A] font-medium">
                                                        <p>
                                                            {{$timeline->modifications}}
                                                        </p>

                                                    </div>
                                                    @if(count($timeline->attachments) > 0)
                                                    <div class="mt-6">
                                                        <h4 class="text-black font-semibold text-sm uppercase">
                                                            ATTACHMENTS</h4>
                                                        <div
                                                            class="flex justify-start items-center gap-3 mt-2 flex-wrap sm:flex-nowrap">
                                                            @foreach ($timeline->attachments as $attachment)
                                                            <div
                                                                class="border border-[#E2EAED] rounded relative before:absolute before:content-[''] before:bg-[#0096D8] before:rounded-[4px_0px_0px_4px] before:left-0 before:top-0 before:bottom-0 before:w-2 py-2 px-5 max-w-[264px] w-full">
                                                                <div class="">
                                                                    <div
                                                                        class="flex justify-between items-center gap-3">
                                                                        <h1 class="font-semibold text-xs">
                                                                            {{strstr($attachment->attachment_path,
                                                                            '/')}}<span class="font-medium"> </span>
                                                                        </h1>
                                                                        <div>
                                                                            <div>
                                                                        <button
                                                                            wire:click="download('{{$attachment->attachment_path}}')"
                                                                            class="text-[#0096D8] text-base font-bold">
                                                                            <i class="fa fa-download" aria-hidden="true"></i>

                                                                        </button>
                                                                        <div wire:loading>
                                                                            <i class="fas fa-spinner fa-pulse"></i>
                                                                        </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach


                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @else
                            <li class="mb-10 ml-[45px]">
                                <span
                                    class="flex absolute -left-[23px] justify-center items-center w-[45px] h-[45px] text-xl font-bold bg-[#FFC700] rounded-full text-white">
                                    <i class="fa-light fa-cube"></i>
                                </span>
                                <button class="flex justify-between items-center gap-3 w-full"
                                    @click="selected !== {{$loop->index}} ? selected = {{$loop->index}} : selected = null">
                                    <h1 class="text-[#263238] font-bold text-base">{{$timeline->request_by}}
                                        {{$timeline->status}} <span
                                            class="text-xs font-medium">{{$timeline->created_at->format('M d, H:i
                                            A')}}</span></h1>
                                    <i class="fa-solid fa-chevron-down transition-all duration-200 ease-linear"
                                        x-bind:class="selected == {{$loop->index}}  ? 'rotate-180 ' : ''">
                                    </i>
                                </button>
                                @if($timeline->status == 'Cancel Request' || $timeline->status == 'Cancel Request
                                Rejected')
                                @if($timeline->status == 'Cancel Request' )
                                <div class="relative overflow-auto transition-all duration-300 ease-in   "
                                    x-bind:class="selected == {{$loop->index}}  ? 'block animate-[show-transition_0.5s_ease-in-out]' : 'opacity-0 hidden'">
                                    <div class="sm:px-4 py-3">
                                        <p class="text-[#6A6A6A] text-base font-medium">Order cancel request by
                                            {{$timeline->request_by}}</p>
                                        @if($isCancellationRequest)
                                        @if($cancellationRequest->subject == 'Seller' && $timeline->request_by ==
                                        'seller')
                                        <div class="hidden" id="loader2" role="status">
                                            <svg class="inline mr-2 w-8 h-8 text-gray-200 animate-spin drk:text-gray-600 fill-green-500"
                                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                    fill="currentFill" />
                                            </svg>
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        <div id="cancellationButtons">
                                            {{-- <p class="text-gray-600">Seller Wants to cancel the order?</p> --}}
                                            <button type="button" wire:click="toggleCancelationAcceptModal"
                                                class="focus:outline-none text-white bg-green-400 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Accept</button>
                                            <button type="button" wire:click="abortCancellationRequest"
                                                class="focus:outline-none text-white bg-red-400 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-red-600 drk:hover:bg-red-700 drk:focus:ring-red-800">Decline</button>
                                        </div>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                                @elseif($timeline->status == 'Cancel Request Rejected')
                                <div class="relative overflow-auto transition-all duration-300 ease-in   "
                                    x-bind:class="selected == {{$loop->index}}  ? 'block animate-[show-transition_0.5s_ease-in-out]' : 'opacity-0 hidden'">
                                    <div class="sm:px-4 py-3">
                                        <p class="text-[#6A6A6A] text-base font-medium">Order cancel request rejected by
                                            {{$timeline->request_by}}</p>

                                    </div>
                                </div>
                                @endif


                                @elseif($timeline->status == 'Requested Extension')
                                <div class="relative overflow-auto transition-all duration-300 ease-in   "
                                    x-bind:class="selected == {{$loop->index}} ? 'block animate-[show-transition_0.5s_ease-in-out]' : 'opacity-0 hidden'">
                                    <div class="sm:px-4 py-3">
                                        <p class="text-[#6A6A6A] text-base font-medium">{{$timeline->request->subject}}
                                        </p>
                                        <p class="text-[#6A6A6A] text-base font-medium">Days:
                                            {{$timeline->request->days}}</p>
                                        <p class="text-[#6A6A6A] text-base font-medium">Status:
                                            {{$timeline->request->status}}</p>
                                    </div>
                                    @if($timeline->request->status == App\Enums\RequestStatus::Pending->value )
                                    <button wire:click="acceptRequest({{$timeline->request->id}})"
                                        class="bg-green-300 hover:bg-green-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                        Accept
                                    </button>
                                    <button wire:click="rejectRequest({{$timeline->request->id}})"
                                        class="bg-red-300 hover:bg-red-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                        Reject
                                    </button>
                                    @endif
                                </div>
                                @elseif($timeline->status == 'Requested Modifcations')

                                <div class="relative overflow-auto transition-all duration-300 ease-in   "
                                    x-bind:class="selected == {{$loop->index}} ? 'block animate-[show-transition_0.5s_ease-in-out]' : 'opacity-0 hidden'"
                                    id="style-2">
                                    <div class="sm:px-4 py-3">
                                        <div class="border border-[#E2EAED]">
                                            <div class="bg-[#E2EAED] py-2 px-5 border-b border-[#E2EAED]">
                                                <h4 class="text-black font-semibold text-sm">Modifications </h4>
                                            </div>
                                            <div class="flex  justify-start items-start gap-2 p-4">
                                                <img class="w-10 h-10 rounded-full"
                                                    src="https://ui-avatars.com/api/?name={{$order->buyer->name }}"
                                                    alt="">
                                                <div>
                                                    <h4 class="text-black font-semibold text-sm">{{$order->buyer->name
                                                        }}</h4>
                                                    <div class="space-y-6 text-sm text-[#6A6A6A] font-medium">
                                                        <p>
                                                            {{$timeline->modifications}}
                                                        </p>

                                                    </div>
                                                    @if(count($timeline->attachments) > 0 ||
                                                    isset($timeline->file_path))
                                                    <div class="mt-6">
                                                        <h4 class="text-black font-semibold text-sm uppercase">
                                                            ATTACHMENTS</h4>
                                                        <div
                                                            class="flex justify-start items-center gap-3 mt-2 flex-wrap sm:flex-nowrap">
                                                            @foreach ($timeline->attachments as $attachment)
                                                            <div
                                                                class="border border-[#E2EAED] rounded relative before:absolute before:content-[''] before:bg-[#0096D8] before:rounded-[4px_0px_0px_4px] before:left-0 before:top-0 before:bottom-0 before:w-2 py-2 px-5 max-w-[264px] w-full">
                                                                <div class="">
                                                                    <div
                                                                        class="flex justify-between items-center gap-3">
                                                                        <h1 class="font-semibold text-xs">
                                                                            {{strstr($attachment->attachment_path,
                                                                            '/')}}<span class="font-medium"> </span>
                                                                        </h1>
                                                                        <button
                                                                            wire:click="download('{{$attachment->attachment_path}}')"
                                                                            class="text-[#0096D8] text-base font-bold">
                                                                            <i class="fa fa-download" aria-hidden="true"></i></button>
                                                                            <div wire:loading>
                                                                                <i class="fas fa-spinner fa-pulse"></i>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                            @if (isset($timeline->file_path))
                                                            <div
                                                                class="border border-[#E2EAED] rounded relative before:absolute before:content-[''] before:bg-[#0096D8] before:rounded-[4px_0px_0px_4px] before:left-0 before:top-0 before:bottom-0 before:w-2 py-2 px-5 max-w-[264px] w-full">
                                                                <div class="">
                                                                    <div
                                                                        class="flex justify-between items-center gap-3">
                                                                        <h1 class="font-semibold text-xs">
                                                                            {{strstr($timeline->file_path, '/')}}<span
                                                                                class="font-medium"> </span></h1>
                                                                        <button
                                                                            wire:click="download('{{$timeline->file_path}}')"
                                                                            class="text-[#0096D8] text-base font-bold">
                                                                            <i class="fa fa-download" aria-hidden="true"></i>

                                                                        </button>
                                                                        <div wire:loading>
                                                                            <i class="fas fa-spinner fa-pulse"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @else
                                <div class="relative overflow-auto transition-all duration-300 ease-in   "
                                    x-bind:class="selected == {{$loop->index}}  ? 'block animate-[show-transition_0.5s_ease-in-out]' : 'opacity-0 hidden'">
                                    <div class="sm:px-4 py-3">
                                        <p class="text-[#6A6A6A] text-base font-medium">{{$timeline->status}} by
                                            {{$timeline->request_by}}</p>

                                    </div>
                                </div>
                                @endif
                            </li>
                            @endif
                            @endforeach
                            <li class="mb-10 ml-[45px]">
                                <span
                                    class="flex absolute -left-[23px] justify-center items-center w-[45px] h-[45px] text-xl font-bold bg-[#00C74F] rounded-full text-white">
                                    <i class="fa-light fa-rocket-launch"></i>
                                </span>
                                <div class="">
                                    <h1 class="text-[#263238] font-bold text-base"> The order started <span
                                            class="text-xs font-medium">{{$order->created_at->format('M d, H:i
                                            A')}}</span></h1>
                                </div>
                            </li>
                            <li class="mb-10 ml-[45px]">
                                <span
                                    class="flex absolute -left-[23px] justify-center items-center w-[45px] h-[45px] text-xl font-bold bg-[#0096D8] rounded-full text-white">
                                    <i class="fa-light fa-cube"></i>
                                </span>
                                <div class="">
                                    <h1 class="text-[#263238] font-bold text-base"><span
                                            class="text-[#0096D8] underline"> {{$order->buyer->name}} </span> placed the
                                        order <span class="text-xs font-medium">{{$order->created_at->format('M d, H:i
                                            A')}}</span></h1>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
                <div>
                    <div class="border border-[#E2EAED] rounded-lg p-6">
                        @if($order->status == App\Enums\OrderStatus::InProgress->value || $order->status ==
                        App\Enums\OrderStatus::Pending->value)
                        <div wire:poll.30000ms>
                            {{$this->getTimeRemaining()}}
                            <h1 class="text-[#263238] font-bold text-lg">
                                @if($isLate)
                                Order is over due date
                                @else
                                Time left to deliver
                                @endif
                            </h1>
                            <div class="my-5 grid grid-cols-3 gap-4">
                                <div
                                    class="bg-[#263238] rounded-2xl bg-opacity-5 flex justify-center items-center w-full h-[90px]">
                                    <div class="text-center">
                                        <h4
                                            class="{{$isLate ? 'text-red-500' : 'text-green-500' }}  text-4xl font-extrabold">
                                            <span>{{$days}}</span>
                                        </h4>
                                        <p><span class="uppercase text-sm font-semibold">Days</span></p>
                                    </div>
                                </div>
                                <div
                                    class="bg-[#263238] rounded-2xl bg-opacity-5 flex justify-center items-center w-full h-[90px]">
                                    <div class="text-center">
                                        <h4
                                            class="{{$isLate ? 'text-red-500' : 'text-green-500' }}  text-4xl font-extrabold">
                                            <span>{{$hours}}</span>
                                        </h4>
                                        <p><span class="uppercase text-sm font-semibold">Hours</span></p>
                                    </div>
                                </div>
                                <div
                                    class="bg-[#263238] rounded-2xl bg-opacity-5 flex justify-center items-center w-full h-[90px]">
                                    <div class="text-center">
                                        <h4
                                            class="{{$isLate ? 'text-red-500' : 'text-green-500' }}  text-4xl font-extrabold">
                                            <span>{{$minutes}}</span>
                                        </h4>
                                        <p><span class="uppercase text-sm font-semibold">mins</span></p>
                                    </div>
                                </div>

                            </div>

                            {{-- <button
                                class="w-full rounded-lg bg-[#0096D8] text-white h-[48px] text-center uppercase text-base font-semibold custom-shadow-btn">Deliver
                                Now</button> --}}
                        </div>
                        @endif
                        @if($this->order->status == App\Enums\OrderStatus::InProgress->value
                        // || $this->order->status == App\Enums\OrderStatus::Delivered->value
                        || $this->order->status == App\Enums\OrderStatus::Pending->value)
                        @if(!$isCancellationRequest)
                        <button wire:click="toggleCancelModal" type="button"
                            class="w-full rounded-lg bg-[#0096D8] text-white h-[48px] text-center uppercase text-base font-semibold custom-shadow-btn">Cancel
                            Order</button>
                        @endif
                        @endif
                        @if($order->status == App\Enums\OrderStatus::Delivered->value)
                        <div class="hidden" id="loader" role="status">
                            <svg class="inline mr-2 w-8 h-8 text-gray-200 animate-spin drk:text-gray-600 fill-green-500"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                            <span class="sr-only">Loading...</span>
                        </div>
                        <button id="loadButton1" type="button" wire:click="toggleModal3"
                            class="w-full rounded-lg bg-[#0096D8] text-white h-[48px] text-center uppercase text-base font-semibold custom-shadow-btn">Accept
                            Order</button>
                        <button id="loadButton2" type="button" wire:click="toggleModal4"
                            class="mt-4 w-full rounded-lg text-white h-[48px] text-center uppercase text-base font-semibold custom-shadow-btn bg-red-400 hover:bg-red-600 focus:ring-4 focus:ring-red-300">Request
                            Modifications</button>
                        @endif
                        @if($order->status == App\Enums\OrderStatus::Completed->value)
                        <livewire:forms.review-form :order="$order" from="buyer" />

                        @endif
                    </div>
                    <div class="border border-[#E2EAED] rounded-lg p-6 mt-7">
                        <div>
                            <h1 class="text-[#263238] font-bold text-lg">Track Order</h1>
                            <div class="mt-7">
                                <ol class="relative border-l border-[#E2EAED] drk:border-gray-700">

                                    <li class="mb-7 ml-6">
                                        <span
                                            class="flex absolute -left-3 justify-center items-center w-6 h-6 bg-blue-200 rounded-full ring-8 ring-white drk:ring-gray-900 drk:bg-blue-900">
                                            <input id="default-radio-1" type="radio" value="" name="default-radio"
                                                class="w-6 h-6 text-[#0096D8] bg-white border border-[#E2EAED] focus:ring-[#0096D8] drk:focus:ring-[#0096D8] drk:ring-offset-gray-800 focus:ring-2 drk:bg-gray-700 drk:border-gray-600"
                                                disabled>
                                        </span>
                                        <div class="text-bold text-black text-base font-semibold">
                                            <p>Requirements submitted</p>
                                            <div class="justify-between items-center mt-2 hidden">
                                                <span class="text-black font-medium text-sm">Dec 16, 04:00 AM</span>
                                                <p class="text-black text-sm font-bold">By <span
                                                        class="text-[#0096D8]">Sandhya Mer</span></p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mb-7 ml-6">

                                        <span
                                            class="flex absolute -left-3 justify-center items-center w-6 h-6 bg-blue-200 rounded-full ring-8 ring-white drk:ring-gray-900 drk:bg-blue-900">
                                            <input {{$this->order->status == App\Enums\OrderStatus::InProgress->value ||
                                            $this->order->status == App\Enums\OrderStatus::Pending->value ? 'checked' :
                                            ''}} id="default-radio-2" type="radio" value="" name="default-radio"
                                            class="w-6 h-6 text-[#0096D8] bg-white border border-[#E2EAED]
                                            focus:ring-[#0096D8] drk:focus:ring-[#0096D8] drk:ring-offset-gray-800
                                            focus:ring-2 drk:bg-gray-700 drk:border-gray-600" disabled>
                                        </span>
                                        <div class="text-bold text-black text-base font-semibold">
                                            <p>Order in progress</p>
                                            <div
                                                class="{{$this->order->status == App\Enums\OrderStatus::InProgress->value  ||  $this->order->status == App\Enums\OrderStatus::Pending->value ? '' : 'hidden'}} justify-between items-center mt-2">
                                                <span
                                                    class="text-black font-medium text-sm">{{$order->updated_at->format('M
                                                    d, H:i A')}}</span>

                                            </div>
                                        </div>
                                    </li>

                                    <li class="mb-7 ml-6">
                                        <span
                                            class="flex absolute -left-3 justify-center items-center w-6 h-6 bg-blue-200 rounded-full ring-8 ring-white drk:ring-gray-900 drk:bg-blue-900">
                                            <input {{$this->order->status == App\Enums\OrderStatus::Delivered->value ?
                                            'checked' : ''}} id="default-radio-4" type="radio" value=""
                                            name="default-radio" class="w-6 h-6 text-[#0096D8] bg-white border
                                            border-[#E2EAED] focus:ring-[#0096D8] drk:focus:ring-[#0096D8]
                                            drk:ring-offset-gray-800 focus:ring-2 drk:bg-gray-700
                                            drk:border-gray-600" disabled>
                                        </span>
                                        <div class="text-bold text-black text-base font-semibold ">
                                            <p>Order Delivered</p>
                                            <div
                                                class="{{$this->order->status == App\Enums\OrderStatus::Delivered->value ? '' : 'hidden'}} justify-between items-center mt-2">
                                                <span
                                                    class="text-black font-medium text-sm">{{$order->updated_at->format('M
                                                    d, H:i A')}}</span>
                                                {{-- <p class="text-black text-sm font-bold">By <span
                                                        class="text-[#0096D8]">Sandhya Mer</span></p> --}}
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mb-7 ml-6">
                                        <span
                                            class="flex absolute -left-3 justify-center items-center w-6 h-6 bg-blue-200 rounded-full ring-8 ring-white drk:ring-gray-900 drk:bg-blue-900">
                                            <input {{$this->order->status == App\Enums\OrderStatus::Completed->value ?
                                            'checked' : ''}} id="default-radio-5" type="radio" value=""
                                            name="default-radio" class="w-6 h-6 text-[#0096D8] bg-white border
                                            border-[#E2EAED] focus:ring-[#0096D8] drk:focus:ring-[#0096D8]
                                            drk:ring-offset-gray-800 focus:ring-2 drk:bg-gray-700
                                            drk:border-gray-600" disabled>
                                        </span>
                                        <div class="text-bold text-black text-base font-semibold ">
                                            <p>Order Completed</p>
                                            <div
                                                class="{{$this->order->status == App\Enums\OrderStatus::Completed->value ? '' : 'hidden'}} justify-between items-center mt-2">
                                                <span
                                                    class="text-black font-medium text-sm">{{$order->updated_at->format('M
                                                    d, H:i A')}}</span>
                                                {{-- <p class="text-black text-sm font-bold">By <span
                                                        class="text-[#0096D8]">Sandhya Mer</span></p> --}}
                                            </div>
                                        </div>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- attachment model --}}
    <x-jet-dialog-modal wire:model="openModal">
        <x-slot name="title">
            Add Attachments
        </x-slot>

        <x-slot name="content">
            <div class="flex justify-center items-center w-full">

                <input accept="image/*,application/pdf,text/plain,.zip" wire:model="files" multiple
                    class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer drk:text-gray-400 focus:outline-none drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400"
                    id="file_input" type="file">
            </div>
            @if(count($fileNames) >0)
            <ul class="ml-2 list-disc">
                @foreach ($fileNames as $name)
                <li>
                    <div class="flex">
                        {{$name}}

                    </div>
                </li>
                @endforeach
            </ul>
            @endif
        </x-slot>


        <x-slot name="footer">
            <div wire:loading.remove wire:target="files">
                <button type="button" wire:click="saveFiles"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Save</button>
            </div>
            <div wire:loading wire:target="files">
                <button type="button"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Loading...</button>
            </div>
            <button type="button" wire:click="toggleModal"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-gray-800 drk:text-white drk:border-gray-600 drk:hover:bg-gray-700 drk:hover:border-gray-600 drk:focus:ring-gray-700">Cancel</button>
        </x-slot>

    </x-jet-dialog-modal>

    {{-- attachment details --}}

    <x-jet-dialog-modal wire:model="openModal2">
        <x-slot name="title">
            Attachment Details
        </x-slot>

        <x-slot name="content">
            <p
                class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white">
                {{$details}}</p>
        </x-slot>


        <x-slot name="footer">

        </x-slot>

    </x-jet-dialog-modal>

    {{-- modification modal --}}
    <x-jet-dialog-modal wire:model="modifModal">
        <x-slot name="title">
            Details
        </x-slot>

        <x-slot name="content">
            <p
                class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white">
                {{$modificationDetails}}</p>
        </x-slot>


        <x-slot name="footer">

        </x-slot>

    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="openModal3">
        <x-slot name="title">
            Accept Order
        </x-slot>

        <x-slot name="content">
            <button wire:click="toggleModal3" type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center drk:hover:bg-gray-800 drk:hover:text-white">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 drk:text-gray-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 drk:text-gray-400">Are you sure you want to accept
                    this order?</h3>

                <button wire:click="acceptOrder" type="button"
                    class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Yes, I'm sure
                </button>
                <button wire:click="toggleModal3" type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 drk:bg-gray-700 drk:text-gray-300 drk:border-gray-500 drk:hover:text-white drk:hover:bg-gray-600 drk:focus:ring-gray-600">No,
                    cancel</button>
            </div>
        </x-slot>


        <x-slot name="footer">
            {{-- <button type="button" wire:click="acceptOrder"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Decline</button>
            --}}

        </x-slot>

    </x-jet-dialog-modal>

    {{-- request modifications model --}}
    <x-jet-dialog-modal wire:model="openModal4">
        <x-slot name="title">
            Request Modifications
            @if(isset($noOfRevisionsLeft))
            <p class="text-sm text-green-700 text-bold">You have {{ $noOfRevisionsLeft }} revisions left.</p>
            @endif
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-inputs.label for="details">Modifications Details</x-inputs.label>


                <x-inputs.text-area maxlength="1000" wire:model="modificationDetails" rows="4" placeholder="Add details here...">
                </x-inputs.text-area>
                @error('modificationDetails')<x-form-error>{{$message}}</x-form-error>@enderror

            </div>

            <div class="mb-4">
                <label class="block mb-2 text-sm font-medium text-gray-900 drk:text-gray-300" for="file_input">Upload
                    file</label>
                <div class="flex justify-center items-center w-full">

                    <input wire:model="modificationFile"
                        class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer drk:text-gray-400 focus:outline-none drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400"
                        id="file_input" type="file" accept="image/*,application/pdf,text/plain,.zip" >


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

    <x-jet-dialog-modal wire:model="openCancellationAcceptModal">
        <x-slot name="title">
            Accept Request
        </x-slot>

        <x-slot name="content">
            <button wire:click="toggleCancelationAcceptModal" type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center drk:hover:bg-gray-800 drk:hover:text-white">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 drk:text-gray-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 drk:text-gray-400">Are you sure you want to accept
                    this request?</h3>
                <button wire:click="acceptCancellationRequest" type="button"
                    class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Yes, I'm sure
                </button>
                <button wire:click="toggleCancelationAcceptModal" type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 drk:bg-gray-700 drk:text-gray-300 drk:border-gray-500 drk:hover:text-white drk:hover:bg-gray-600 drk:focus:ring-gray-600">No,
                    cancel</button>
            </div>
        </x-slot>


        <x-slot name="footer">
            {{-- <button type="button" wire:click="acceptOrder"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Decline</button>
            --}}

        </x-slot>

    </x-jet-dialog-modal>

    {{-- cancel order modal --}}
    <x-jet-dialog-modal wire:model="cancelModal">
        <x-slot name="title">
            Cancel Order
        </x-slot>

        <x-slot name="content">
            <button wire:click="toggleCancelModal" type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center drk:hover:bg-gray-800 drk:hover:text-white">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 drk:text-gray-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
            {{-- <button type="button" wire:click="acceptOrder"
                class="focus:outline-none text-white bg-red-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Decline</button>
            --}}

        </x-slot>

    </x-jet-dialog-modal>

    @push('scripts')
    @once
    <script>
        document.addEventListener('order_completed',event => {
                showLoader();
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
                                hideLoader();
                            }, 3000);
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
                                hideLoader();
                                Livewire.emit('refreshOrder');
                            }, 3000);
                            } else{
                                hideLoader();
                                $('#error').removeClass('hidden');
                                $('#error_message').text("Error occured while completing order! Please try again");
                                setTimeout(function() {
                                $("#error").addClass('hidden');
                                $('#error_message').text("");
                                hideLoader();
                            }, 3000);
                            }


                    })

                    .catch((error) =>{
                        $('#error').removeClass('hidden');
                      $('#error_message').text(error);
                            setTimeout(function() {
                                $("#error").addClass('hidden');
                                $('#error_message').text("");
                                hideLoader();
                            }, 3000);
                    });
            });

            document.addEventListener('order_cancelled',event => {
            showLoader2();
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
                            hideLoader2();
                        }, 3000);
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
                            hideLoader2();
                            Livewire.emit('refreshOrder');
                        }, 3000);

                    } else {
                        $('#error').removeClass('hidden');
                        $('#error_message').text("Error occured while cancelling! Please try again");
                        setTimeout(function() {
                            $("#error").addClass('hidden');
                            $('#error_message').text("");
                            hideLoader2();
                        }, 3000);
                    }
            })
            .catch((error) =>{
                    $('#error').removeClass('hidden');
                        $('#error_message').text(error);
                        setTimeout(function() {
                            $("#error").addClass('hidden');
                            $('#error_message').text("");
                            hideLoader2();
                        }, 3000);
                });
        });

        function showLoader(){
            $('#loader').removeClass('hidden');
            $('#loadButton1').addClass('hidden')
            $('#loadButton2').addClass('hidden')
        }
        function hideLoader(){
            $('#loader').addClass('hidden');
            // $('#loadButton1').removeClass('hidden')
            // $('#loadButton2').removeClass('hidden')
        }

        function showLoader2()
        {
            $('#loader2').removeClass('hidden');
            $('#cancellationButtons').addClass('hidden');

        }

         function hideLoader2()
        {
            $('#loader2').addClass('hidden');
            // $('#cancellationButton1').addClass('hidden');
            // $('#cancellationButton2').addClass('hidden');
        }
    </script>
    @endonce
    @endpush

</div>
