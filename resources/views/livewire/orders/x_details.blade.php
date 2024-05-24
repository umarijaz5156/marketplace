
<div class="m-40 block p-6 bg-gray-100 rounded-lg border border-gray-200 shadow-md drk:bg-gray-800 drk:border-gray-700 drk:hover:bg-gray-700">

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
        <x-stripe.notification />

    <div class="mb-4">
        <div class="flex  justify-between">
            <h3 class="text-3xl font-bold text-gray-600 drk:text-white">Order Details
            </h3>
            <div>
                <h3 class="text-2xl font-bold text-gray-600 drk:text-white"><small
                    class="ml-2 font-semibold text-gray-500 drk:text-gray-400">
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
                        py-2 px-16  rounded-full ">{{$order->status}}</span></small></h3>
            </div>
            <h3 class="text-2xl font-bold text-gray-600 drk:text-white"><small class="ml-2 font-semibold text-gray-500 drk:text-gray-400">(Order # {{$order->id}})</small></h3>
        </div>

      <div class="flex justify-between">

        <div>


            @if($this->order->status == App\Enums\OrderStatus::InProgress->value
            || $this->order->status == App\Enums\OrderStatus::Delivered->value
            || $this->order->status == App\Enums\OrderStatus::Pending->value)
                @if($isCancellationRequest)
                    @if($cancellationRequest->subject == 'Seller')
                    <div class="hidden" id="loader2" role="status">
                        <svg class="inline mr-2 w-8 h-8 text-gray-200 animate-spin drk:text-gray-600 fill-green-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div id="cancellationButtons">
                        <p class="text-gray-600">Seller Wants to cancel the order?</p>
                        <button type="button" wire:click="toggleCancelationAcceptModal" class="focus:outline-none text-white bg-green-400 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Accept</button>
                        <button type="button" wire:click="abortCancellationRequest" class="focus:outline-none text-white bg-red-400 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-red-600 drk:hover:bg-red-700 drk:focus:ring-red-800">Decline</button>
                    </div>
                    @endif
                {{-- @else
                    <button type="button" wire:click="toggleCancelModal"
                    class="w-full focus:outline-none text-white bg-yellow-400 hover:bg-orange-600 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-orange-600 drk:hover:bg-orange-700 drk:focus:ring-orange-800">
                    Cancel Order
                    </button> --}}
                @endif
            @endif
        </div>
        <div>

            @if($order->status == App\Enums\OrderStatus::Delivered->value)
                <div class="hidden" id="loader" role="status">
                    <svg class="inline mr-2 w-8 h-8 text-gray-200 animate-spin drk:text-gray-600 fill-green-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
                <button id="loadButton1" type="button" wire:click="toggleModal3" class="focus:outline-none text-white bg-green-400 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Accept Order</button>
                <button id="loadButton2" type="button" wire:click="toggleModal4" class="focus:outline-none text-white bg-red-400 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-red-600 drk:hover:bg-red-700 drk:focus:ring-red-800">Request Modifications</button>
            @endif
            @if($order->status == App\Enums\OrderStatus::Completed->value)
                <livewire:forms.review-form :order="$order" from="buyer"/>

            @endif
        </div>


    </div>
    </div>
    <div class="bg-[#E9ECF3] rounded-bl-2xl rounded-br-2xl mt-[-10px] flex justify-center items-center p-6">
        @if($chat_id)
        <button wire:click='redirectChat' type="button"
            class="w-[205px] text-[#545454] bg-white border border-[#707070] hover:bg-[#2545c3] focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-4 text-center mr-2 mb-2 hover:text-white drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800">Open chat</button>
        @else
            <livewire:forms.create-chat  :orderId="$order->id"/>
        @endif
        @if($order->status == App\Enums\OrderStatus::InProgress->value || $order->status == App\Enums\OrderStatus::Delivered->value || $order->status == App\Enums\OrderStatus::Pending->value)

            <livewire:dispute.create :order="$order"/>
        @endif
        @if($order->status == App\Enums\OrderStatus::Disputed->value)
        <button wire:click="redirectDispute" type="button"
        class="w-[205px] text-[#545454] bg-white border border-[#707070] hover:bg-[#2545c3] focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-4 text-center mr-2 mb-2 hover:text-white drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800">Open Dispute</button>
        @endif
        @if($this->order->status == App\Enums\OrderStatus::InProgress->value
            || $this->order->status == App\Enums\OrderStatus::Delivered->value
            ||  $this->order->status == App\Enums\OrderStatus::Pending->value)
            @if(!$isCancellationRequest)
            <button wire:click="toggleCancelModal" type="button"
                class="w-[205px] text-[#545454] bg-white border border-[#707070] hover:bg-[#2545c3] focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-4 text-center mr-2 mb-2 hover:text-white drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800">Cancel Order</button>
            @endif
        @endif
    </div>
    {{-- <div class="bg-[#E9ECF3] rounded-bl-2xl rounded-br-2xl mt-[-10px] flex justify-center items-center p-6">

    </div> --}}
@if($order->status == App\Enums\OrderStatus::InProgress->value || $order->status == App\Enums\OrderStatus::Pending->value)
<div class=" flex items-center justify-center px-5 py-5">
    <div wire:poll.30000ms class="text-blue">
        {{$this->getTimeRemaining()}}
        <h1 class="text-2xl text-center mb-3 font-light">
            @if($isLate)
                Order is over due date
            @else
                Time remaining in delivering the order
            @endif
        </h1>
        <div class="text-6xl text-center flex w-full items-center justify-center">

            <div class="w-24 mx-1 p-2 bg-white {{$isLate ? 'text-red-500' : 'text-green-500' }} rounded-lg ">
                <div  class="font-mono leading-none">{{$days}}</div>
                <div class="font-mono uppercase text-sm leading-none">Days</div>
            </div>
            <div class="w-24 mx-1 p-2 bg-white {{$isLate ? 'text-red-500' : 'text-green-500' }} rounded-lg">
                <div class="font-mono leading-none" >{{$hours}}</div>
                <div class="font-mono uppercase text-sm leading-none">Hours</div>
            </div>
            <div class="w-24 mx-1 p-2 bg-white {{$isLate ? 'text-red-500' : 'text-green-500' }} rounded-lg">
                <div class="font-mono leading-none">{{$minutes}}</div>
                <div class="font-mono uppercase text-sm leading-none">Minutes</div>
            </div>
            {{-- <div class="text-2xl mx-1 font-extralight">and</div>
            <div class="w-24 mx-1 p-2 bg-white text-yellow-500 rounded-lg">
                <div class="font-mono leading-none" >00</div>
                <div class="font-mono uppercase text-sm leading-none">Seconds</div>
            </div> --}}
        </div>
        {{-- <p class="text-sm text-center mt-3">*<a href="https://twitter.com/10DowningStreet/status/1363897254340419587" class="underline hover:text-yellow-200" target="_blank">As per goverment plan</a>. Subject to change.</p> --}}
    </div>
</div>
@endif

<div class=" overflow-x-auto relative shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-600 drk:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 drk:bg-gray-700 drk:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Service
                </th>
                <th scope="col" class="py-3 px-6">
                    Seller
                </th>
                <th scope="col" class="py-3 px-6">
                    Order Date
                </th>
                <th scope="col" class="py-3 px-6">
                    Due On
                </th>
                <th scope="col" class="py-3 px-6">
                    Total
                </th>

            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b drk:bg-gray-800 drk:border-gray-700">
                <th rowspan="2" scope="row" class="py-4 px-6 font-medium text-gray-900 drk:text-white">
                    <div class="flex  items-center">
                        <img  src="{{asset('/gigs/images/'.$order->gig->mainImage->image_path) }}" class="h-40 w-60 rounded-[4px]"    alt="">
                        <p class="ml-1 mt-[10px] font-medium text-base text-ellipsis overflow-hidden ...">{{$order->gig->gigDetail->title}}</p>
                    </div>

                </th>
                <td class="py-4 px-6">
                    <div class="flex">
                        {{$order->seller->seller_name}}
                        <livewire:forms.create-report :content="$order->seller" contentType="{{App\Enums\ReportType::Seller->value}}"/>
                    </div>

                </td>
                <td class="py-4 px-6">
                    {{$order->created_at->format('M, d Y')}}
                </td>
                <td class="py-4 px-6">
                    {{$order->orderDetails->delivery_time ? $order->orderDetails->delivery_time->format('M, d Y') : '--'}}
                </td>
                <td class="py-4 px-6">
                    ${{$order->orderDetails->amount}}
                </td>

            </tr>

        </tbody>
    </table>
</div>

@if(count($order->requests->where('type', 'Days')) > 0)
<div class="mt-10">
    <div class="flex justify-between">
        <h3 class="text-2xl font-bold text-gray-600 drk:text-white"><small class="ml-2 font-semibold text-gray-500 drk:text-gray-400">Seller Requests</small></h3>

    </div>


    <div class="">

        <div  class="mt-1 h-60 overflow-y-auto relative">
            <table class="w-full text-sm text-left text-gray-500 drk:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 drk:bg-gray-700 drk:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            Subject
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Days
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Sent at
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Status
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->requests as $request)
                    <tr class="bg-white border-b drk:bg-gray-800 drk:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap drk:text-white">
                            {{$request->subject}}
                        </th>
                        <td class="py-4 px-6">
                            {{$request->days}}
                        </td>
                        <td class="py-4 px-6">
                            {{$request->created_at->diffForHumans()}}
                        </td>
                        <td class="py-4 px-6">
                            {{$request->status}}
                        </td>
                        <td class="py-4 px-6">

                              @if($request->status ==  App\Enums\RequestStatus::Pending->value )
                            <button wire:click="acceptRequest({{$request->id}})" class="bg-green-300 hover:bg-green-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                Accept
                            </button>
                            <button wire:click="rejectRequest({{$request->id}})" class="bg-red-300 hover:bg-red-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                Reject
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

<div class="mt-10">
    <div class=" flex justify-between">

        <h3 class="text-2xl font-bold text-gray-600 drk:text-white"><small class="ml-2 font-semibold text-gray-500 drk:text-gray-400">Attachments</small></h3>
        <button wire:click="toggleModal" type="button" class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 drk:focus:ring-gray-700 drk:bg-gray-800 drk:text-gray-400 drk:border-gray-600 drk:hover:text-white drk:hover:bg-gray-700">Add Attachment</button>
    </div>

    @if(count($order->orderAttachments->where('is_delivery', false)) >  0)
        <div  class="mt-4 h-60  overflow-y-auto relative">
            <table class="w-full text-sm text-left text-gray-500 drk:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 drk:bg-gray-700 drk:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            File Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Added By
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Added At
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderAttachments->where('is_delivery', false) as $attachment)
                        <tr class="bg-white border-b drk:bg-gray-800 drk:border-gray-700">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap drk:text-white">
                                {{substr($attachment->attachment_path, strpos($attachment->attachment_path,'/') + 1)}}
                            </th>
                            <td class="py-4 px-6">
                                {{$attachment->added_by}}
                            </td>
                            <td class="py-4 px-6">
                                {{$attachment->created_at->diffforHumans()}}
                            </td>
                            <td class="py-4 px-6">
                                <button wire:click="download('{{$attachment->attachment_path}}')" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                                    <span>Download</span>
                                </button>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    @endif
</div>

 {{-- order timeline --}}
 @if(count($order->timeline) > 0)
 <div class="mt-14">
     <h3 class="text-2xl font-bold text-gray-600 drk:text-white"><small
             class="ml-2 font-semibold text-gray-500 drk:text-gray-400">Order Timeline</small></h3>
     <div class="h-60 overflow-y-auto mt-4  relative">
         <table class="w-full overflow-scroll text-sm text-left text-gray-500 drk:text-gray-400">
             <thead class="text-xs text-gray-700 uppercase bg-gray-50 drk:bg-gray-700 drk:text-gray-400">
                 <tr>
                     <th scope="col" class="py-3 px-6">
                        Modified At
                     </th>

                     <th scope="col" class="py-3 px-6">
                         Status
                     </th>
                     <th scope="col" class="py-3 px-6">
                        By
                    </th>
                     <th scope="col" class="py-3 px-6">
                         Action
                     </th>
                 </tr>
             </thead>
             <tbody>
                 @foreach ($order->timeline as $timeline)
                     <tr class="bg-white border-b drk:bg-gray-800 drk:border-gray-700">
                         <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap drk:text-white">
                             {{$timeline->created_at->format('M d, H:i a')}}
                         </th>
                         <td class="py-4 px-6">
                             {{$timeline->status}}
                         </td>
                          <td class="py-4 px-6">
                             {{$timeline->request_by}}
                         </td>
                         <td class="py-4 px-6">
                             {{-- --}}
                             @if($timeline->file_path)
                                 <button  wire:click="download('{{$timeline->file_path}}')"  class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                     <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                                     <span>Download</span>
                                 </button>
                             @endif
                             @if($timeline->modifications)
                             <button wire:click="showModifDetails('{{$timeline->modifications}}')" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                 <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
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
 @endif

@if(count($deliveryFiles) >  0)
<div class="mt-10">
    <h3 class="text-2xl font-bold text-gray-600 drk:text-white"><small class="ml-2 font-semibold text-gray-500 drk:text-gray-400">Delivered Files</small></h3>

        <div  class="mt-4 h-60  overflow-y-auto relative">
            <table class="w-full text-sm text-left text-gray-500 drk:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 drk:bg-gray-700 drk:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            File Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Added By
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Added At
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deliveryFiles as $attachment)
                        <tr class="bg-white border-b drk:bg-gray-800 drk:border-gray-700">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap drk:text-white">
                                {{substr($attachment->attachment_path, strpos($attachment->attachment_path,'/') + 1)}}
                            </th>
                            <td class="py-4 px-6">
                                {{$attachment->added_by}}
                            </td>
                            <td class="py-4 px-6">
                                {{$attachment->created_at->diffForHumans()}}
                            </td>
                            <td class="py-4 px-6">
                                <button wire:click="download('{{$attachment->attachment_path}}')" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                                    <span>Download</span>
                                </button>
                                <button wire:click="showFileDetails('{{$attachment->details}}')" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                                    <span>Details</span>
                                </button>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>


</div>
@endif


 {{-- order reviews table --}}
 @if(count($order->orderReviews) > 0 )
 <div class="mt-10">
     <h3 class="text-2xl font-bold text-gray-600 drk:text-white"><small
             class="ml-2 font-semibold text-gray-500 drk:text-gray-400">Order Reviews</small></h3>
     <div class="mt-4 overflow-y-auto relative">
         <table class="w-full text-sm text-left text-gray-500 drk:text-gray-400">
             <thead class="text-xs text-gray-700 uppercase bg-gray-50 drk:bg-gray-700 drk:text-gray-400">
                 <tr>
                     <th scope="col" class="py-3 px-6">
                         Review
                     </th>
                     <th scope="col" class="py-3 px-6">
                         Rating
                     </th>
                     <th scope="col" class="py-3 px-6">
                         Review By
                     </th>
                     <th scope="col" class="py-3 px-6">
                         Date
                     </th>
                 </tr>
             </thead>
             <tbody>
                 @foreach ($order->orderReviews as $review)
                 <tr class="bg-white border-b drk:bg-gray-800 drk:border-gray-700">
                     <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap drk:text-white">
                         {{$review->review}}
                     </th>
                     <td class="py-4 px-6">
                        <div class="flex items-center">
                            <svg aria-hidden="true" class="w-5 h-5 {{$review->rating > 0 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500'}} " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>First star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg aria-hidden="true" class="w-5 h-5 {{$review->rating > 1 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500'}}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Second star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg aria-hidden="true" class="w-5 h-5 {{$review->rating > 2 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500'}}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Third star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg aria-hidden="true" class="w-5 h-5 {{$review->rating > 3 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500'}}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fourth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <svg aria-hidden="true" class="w-5 h-5 {{$review->rating > 4 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500'}}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fifth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        </div>

                     </td>
                     <td class="py-4 px-6">
                         {{$review->review_type}}
                     </td>
                     <td class="py-4 px-6">
                         {{$review->created_at->format('M d, Y')}}
                     </td>
                 </tr>
                 @endforeach


             </tbody>
         </table>
     </div>


 </div>
 @endif

{{-- attachment model --}}
<x-jet-dialog-modal wire:model="openModal">
    <x-slot name="title">
        Add Attachments
    </x-slot>

    <x-slot name="content">
        <div class="flex justify-center items-center w-full">

            <input wire:model="files" multiple class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer drk:text-gray-400 focus:outline-none drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400" id="file_input" type="file">
        </div>
        @if(count($fileNames) >0)
            <ul  class="ml-2 list-disc">
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
            <button type="button" wire:click="saveFiles" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Save</button>
        </div>
       <div wire:loading wire:target="files">
         <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Loading...</button>
       </div>
        <button type="button" wire:click="toggleModal" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-gray-800 drk:text-white drk:border-gray-600 drk:hover:bg-gray-700 drk:hover:border-gray-600 drk:focus:ring-gray-700">Cancel</button>
    </x-slot>

</x-jet-dialog-modal>

{{-- attachment details --}}

<x-jet-dialog-modal wire:model="openModal2">
    <x-slot name="title">
        Attachment Details
    </x-slot>

    <x-slot name="content">
        <p class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white">{{$details}}</p>
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
        <p class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white">{{$modificationDetails}}</p>
    </x-slot>


    <x-slot name="footer">

    </x-slot>

</x-jet-dialog-modal>

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

                <input wire:model="modificationFile" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer drk:text-gray-400 focus:outline-none drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400" id="file_input"  type="file">


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
                <button wire:click="toggleCancelationAcceptModal" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center drk:hover:bg-gray-800 drk:hover:text-white" >
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 drk:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 drk:text-gray-400">Are you sure you want to accept this request?</h3>
                    <button wire:click="acceptCancellationRequest" type="button" class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, I'm sure
                    </button>
                    <button wire:click="toggleCancelationAcceptModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 drk:bg-gray-700 drk:text-gray-300 drk:border-gray-500 drk:hover:text-white drk:hover:bg-gray-600 drk:focus:ring-gray-600">No, cancel</button>
                </div>
    </x-slot>


    <x-slot name="footer">
        {{-- <button type="button" wire:click="acceptOrder" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Decline</button> --}}

    </x-slot>

</x-jet-dialog-modal>

   {{-- cancel order modal --}}
<x-jet-dialog-modal wire:model="cancelModal">
    <x-slot name="title">
        Cancel Order
    </x-slot>

    <x-slot name="content">
                <button wire:click="toggleCancelModal" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center drk:hover:bg-gray-800 drk:hover:text-white" >
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 drk:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 drk:text-gray-400">Are you sure you want to cancel this order?</h3>
                    <button wire:click="cancelOrder" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                        Yes, I'm sure
                    </button>
                    <button wire:click="toggleCancelModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 drk:bg-gray-700 drk:text-gray-300 drk:border-gray-500 drk:hover:text-white drk:hover:bg-gray-600 drk:focus:ring-gray-600">No, cancel</button>
                </div>
    </x-slot>


    <x-slot name="footer">
        {{-- <button type="button" wire:click="acceptOrder" class="focus:outline-none text-white bg-red-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Decline</button> --}}

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
