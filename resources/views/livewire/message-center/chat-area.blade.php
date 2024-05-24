<div onscroll="loadMoreChat()" id="chatBar" class="h-[88%] overflow-y-auto overflow-x-hidden scrollbar-hidden ">
    <style>
        .custom-highlighter>a {
            color: #3f83F8;
            text-decoration: underline;
        }
    </style>
    @if (isset($selectedChat))


    <!-- Chat Header -->
    <div class="sticky top-0 left-0 z-[2] bg-white">
        <div class=" flex  w-full items-center justify-between border border-[#E2EAED] md:px-8 py-4">

            @if ($access == 'admin' || $access == 'manager')

                <div>
                    @if ($selectedChat->content_type == 'Gig')
                        <a class="hover:text-blue-500" href="{{ route('gig_details', ['slug' => $this->getGig('slug')]) }}">
                            <p class="text-lg">Service # {{ $selectedChat->content_id }}</p>
                            <p class="text-base">{{ $this->getGig('title') }}</p>
                        </a>
                    @elseif($selectedChat->content_type == 'Order')
                        <a class="hover:text-blue-500"
                            href="{{ route('admin.order_details', ['order' => $selectedChat->content_id]) }}">
                            <p class="text-lg">Order # {{ $selectedChat->content_id }}</p>
                        </a>
                    @elseif($selectedChat->content_type == 'Proposal')
                        <a class="hover:text-blue-500"
                            href="{{ route('requests.details',$selectedChat->content_id) }}">
                            <p class="text-lg">Request # {{ $selectedChat->content_id }}</p>
                        </a>
                    @endif
                </div>
            @else
            <div class="gap-2 flex text-center md:text-start items-center cursor-pointer transition-all duration-200 ">
                <div
                    class=" relative before:content-[''] before:absolute {{ $blocked ? '' : ($isOnline ? 'before:bg-[green]' : 'before:bg-[#E4670F]') }} before:w-3 before:h-3 before:rounded-full before:border before:border-white before:left-[34px] before:bottom-1">
                    @if (!is_null($receiverInstance?->profile_photo_path))
                        <img class="w-[44px] h-[44px] rounded-full object-cover mr-4"
                            src="{{ asset('/storage/' . $receiverInstance->profile_photo_path) }}"
                            alt="{{ $this->receiverInstance->name }}">
                    @else
                        <img class="w-[44px] h-[44px] rounded-full object-cover mr-4"
                            src="https://ui-avatars.com/api/?name={{ $receiverInstance->name }}"
                            alt="{{ $this->receiverInstance->name }}">
                    @endif

                </div>
                <div class="w-full overflow-hidden text-left">

                    @if (!is_null($receiverInstance?->is_seller) && !$blocked &&
                    !is_null($receiverInstance->seller?->seller_name))
                        <a href="{{ route('view_profile', ['name' => $receiverInstance->seller?->seller_name]) }}">
                            <p class="font-semibold text-lg">{{ $receiverInstance?->name }}</p>
                        </a>
                    @else
                        <p class=" font-semibold text-lg">{{ $receiverInstance?->name }}</p>
                    @endif
                    @if (!$blocked)
                        <p class="text-[#00C74F] font-medium text-base">{{ $isOnline ? 'Online' : 'Offline' }}
                        </p>
                    @endif
                    @if (!$blocked)
                        <div class="flex" wire:poll.60000ms>
                            <p class="mr-1 font-light text-[12px]">Local</p>
                            <p class="mr-2 font-light text-[12px]">Time</p>
                            <p class="mr-1 font-light text-[12px]">{{ $this->getLocalTime()['time'] }}</p>
                            <p class="mr-1 font-light text-[12px]">{{ $this->getLocalTime()['noon'] }}</p>

                        </div>
                    @endif
                </div>

            </div>
            @endif

            @if (!isset($access))
            <div class="flex items-center" x-data="{ show: false }" x-on:click.outside="show = false">
               <div>
                    <div
                        class="inline-flex items-center p-2 text-[14px] font-medium text-center text-[#8B8C91] rounded-lg hover:bg-gray-100 focus:outline-none drk:text-white focus:ring-gray-50 drk:bg-gray-800 drk:hover:bg-gray-700 drk:focus:ring-gray-600">
                        <livewire:forms.create-report :content="$selectedChat"
                            contentType="{{ App\Enums\ReportType::Chat->value }}" />

                    </div>
                    @if($selectedChat->content_type == 'Proposal' || $selectedChat->content_type == 'Gig')
                    @if(Auth::user()->id != $selectedChat->sender_id)
                        <div class="p-2 rounded-lg hover:bg-gray-100 focus:outline-none drk:text-white focus:ring-gray-50 text-sm cursor-pointer">
                            <button type="button" wire:click='openOfferModal()' class=" items-center font-medium text-gray-400 drk:text-gray-600 hover:underline">Create a Custom Offer</button>
                        </div>
                    @endif
                    @endif
                 </div>
                <button
                    class="lg:hidden inline-flex items-center p-2 text-[19px] font-medium text-center text-gray-400 rounded-lg hover:bg-gray-100 focus:outline-none drk:text-white focus:ring-gray-50 drk:bg-gray-800 drk:hover:bg-gray-700 drk:focus:ring-gray-600"
                    type="button" @click="sidebar =! sidebar , console.log(sidebar)">
                    <i class="fa-solid fa-bars-staggered"></i>
                </button>
                <button x-on:click="show = !show" @click.outside="show = false" id="dropdownMenuIconButton"
                    class="inline-flex items-center p-2 text-[19px] font-medium text-center text-[#8B8C91] rounded-lg hover:bg-gray-100 focus:outline-none drk:text-white focus:ring-gray-50 drk:bg-gray-800 drk:hover:bg-gray-700 drk:focus:ring-gray-600"
                    type="button">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>

                <!-- Dropdown menu -->
                <div x-show="show" id="dropdownDots"
                    class="z-20 mt-20 w-20 absolute bg-white rounded divide-y divide-gray-100 shadow drk:bg-gray-700 drk:divide-gray-600">
                    <ul class="py-1 text-sm text-gray-700 drk:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                        <li>
                            @if ($blocked)
                            @if ($blockedBy == auth()->user()->id)
                            <a wire:click="unblock"
                                class="cursor-pointer block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">Unblock</a>
                            @endif
                            @else
                            <a wire:click="blockModal"
                                class="cursor-pointer block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">Block</a>
                            @endif
                        </li>
                        <li>

                            {{-- <a wire:click="reportModal"
                                class="block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">Report</a>
                            --}}
                        </li>

                    </ul>
                </div>
            </div>
            @endif
        </div>

        @if($selectedChat->content_type == 'Proposal' || $selectedChat->content_type == 'Gig')

            <div class="sticky top-0 bottom-0 flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 drk:bg-gray-800 drk:text-blue-400" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="flex  gap-2">
                @if($selectedChat->receiver_id == auth()->user()->id)
                    <div>
                        <span class="font-medium ml-2">
                        Get Hired!</span> You can send a custom offer to this buyer to get hired
                    </div>

                @else
                    <div>
                        <span class="font-medium ml-2">Hire Seller!</span> If you want to hire this seller ask them to send a custom offer
                    </div>
                @endif
                @if($selectedChat->content_type == 'Proposal')
                <div><a class="underline hover:text-blue-600" href="{{ route('requests.details', $selectedChat->content_id) }}">View Request</a></div>
                @endif
                </div>
            </div>
        @endif
    </div>



    <!-- Chats Messages -->
    <div class="flex-grow pt-3">



        @if (count($chatMessages) > 0)

        @if ($access == 'manager' || $access == 'admin')
        <div class="sticky top-0 flex justify-between p-[0_40px_45px]">
            <p class="bg-green-200 text-green-600 py-1 px-3 rounded-full ">Seller Chat</p>
            <p class="bg-blue-200 text-blue-600 py-1 px-3 rounded-full ">Buyer Chat</p>
        </div>
        @endif
        @foreach ($chatMessages as $message)
            {{-- message on admin and manager panel --}}
            @if ($access == 'admin' || $access == 'manager')
                @if ($message->sent_by == 'seller')
                <div class="chat-msg flex p-[0_20px_45px]">
                    <div class="relative flex-shrink-0 mb-[-20px]">
                        @if ($this->getUser($message->sender_id, 'profile_photo_path'))
                        <img class="w-[42px] h-[42px] rounded-full object-cover mr-[15px]"
                            src="{{ asset('/storage/' . $this->getUser($message->sender_id, 'profile_photo_path')) }}" alt="">
                        @else
                        <img class="w-[42px] h-[42px] rounded-full object-cover mr-[15px]"
                            src="https://ui-avatars.com/api/?name={{ $this->getUser($message->sender_id, 'name') }}" alt="">
                        @endif

                        <div
                            class="absolute left-[calc(100%_+_12px)] w-full bottom-0 text-[12px] font-normal text-[#c0c7d2] whitespace-nowrap">

                            <p>Message at {{ $message->created_at->format('h i a') }} </p>

                        </div>

                    </div>
                    <div class="ml-3 max-w-[70%] flex flex-col items-start">

                        @if ($message->order_id)
                        <div
                            class="bg-white p-3 rounded-[0px_25px_25px_25px] leading-[1.5] text-[14px] text-[#273346] mb-2 font-normal">
                            <p><a class="text-blue-600 underline"
                                    href="{{ route('order_details', ['id' => $message->order_id]) }}">See
                                    Order Details</a></p>
                        </div>
                        @endif
                        <div class="flex items-center gap-2">
                            <h1 class="text-lg font-bold text-[#263238]">
                                {{ $this->getUser($message->sender_id, 'name') }}</h1>
                            {{-- <p class="text-sm font-medium text-[#263238]">{{$message->created_at->format()}}</p> --}}
                        </div>
                        <div
                            class="bg-[#F3F3FF] p-3 rounded-[0px_8px_8px_8px] leading-[1.5] text-base text-[#263238] mb-2 font-medium">
                            @if(!filter_var($message->message, FILTER_VALIDATE_URL) === false)
                            <a target="_blank" href="{{ $message->message }}" class="text-blue-500 underline cursor-pointer">{{
                                $message->message }}</a>
                            @elseif((strpos($message->message, 'http') !== false || strpos($message->message, 'www.') !==
                            false))
                            <div class='custom-highlighter'>
                                {{ $this->highlightUrl($message->message) }}
                            </div>

                            @else
                            {{ $message->message }}
                            @endif

                            @if ($message->attachments->isNotEmpty())
                            @foreach ($message->attachments as $attachment)
                            @if (str_contains($attachment, 'image'))
                            <img onclick="showModal('{{ asset('storage/' . $attachment->file_url) }}', 'image')"
                                class=" rounded-xl w-full max-w-[300px] object-cover opacity-70 mt-2"
                                src="{{ asset('storage/' . $attachment->file_url) }}" alt="">
                            @else
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $attachment->file_url) }}"
                                    class="text-blue-500 underline flex items-center gap-4" download>
                                    <p>{{ $attachment->name }}</p>
                                    <button type="button">
                                        <i class="fa-solid fa-arrow-down-to-line"></i>
                                    </button>
                                </a>
                            </div>
                            @endif
                            @endforeach
                            @endif
                        </div>

                    </div>
                </div>
                @else
                <div class="Chat-msg-Owner flex p-[0_20px_45px] flex-row-reverse">
                    <div class="flex-shrink-0 mb-[-20px] relative">
                        @if ($this->getUser($message->sender_id, 'profile_photo_path'))
                        <img class="w-[44px] h-[44px] rounded-full object-cover ml-[15px]"
                            src="{{ asset('/storage/' . $this->getUser($message->sender_id, 'profile_photo_path')) }}" alt="">
                        @else
                        <img class="w-[44px] h-[44px] rounded-full object-cover ml-[15px]"
                            src="https://ui-avatars.com/api/?name={{ $this->getUser($message->sender_id, 'name') }}"
                            alt="{{ $this->getUser($message->sender_id, 'name') }}">
                        @endif

                        <div
                            class="absolute left-auto right-[calc(100%_+_98px)] w-full bottom-0 text-[12px] font-normal text-[#c0c7d2] whitespace-nowrap flex items-center">
                            Message at {{ $message->created_at->format('h i a') }} by
                            {{ $this->getUser($message->sender_id, 'name') }}
                            @if ($message->is_seen == 1)
                            <img src="{{ asset('images/double-check.png') }}" class="seenImage ml-2" width="15px" height="20px"
                                alt="seen">
                            @else
                            <img src="{{ asset('images/seen.png') }}" class="sentImage ml-2" width="15px" height="20px"
                                alt="sent">
                            @endif
                        </div>
                    </div>
                    <div class="ml-3 max-w-[70%] flex flex-col items-start">
                        <div class="flex items-center gap-2 w-full justify-end">
                            {{-- <p class="text-sm font-medium text-[#263238]">{{$message->created_at->format('h i a')}}</p>
                            --}}
                            <h1 class="text-lg font-bold text-[#263238]">
                                {{ $this->getUser($message->sender_id, 'name') }}</h1>
                        </div>
                        <div class="mb-2">
                            @if($message->type == 'text')
                            <div
                                class="bg-[#F3F3FF] p-3 rounded-[8px_0px_8px_8px] leading-[1.5] text-base text-[#263238] mb-2 font-medium">
                                @if(!filter_var($message->message, FILTER_VALIDATE_URL) === false)
                                    <a target="_blank" href="{{ $message->message }}"
                                        class="text-blue-500 underline cursor-pointer">{{ $message->message }}</a>
                                @elseif((strpos($message->message, 'http') !== false || strpos($message->message, 'www.') !==
                                    false))
                                    <div class='custom-highlighter'>
                                        {{ $this->highlightUrl($message->message) }}
                                    </div>

                                @else
                                    {{ $message->message }}
                                @endif

                                @if ($message->attachments->isNotEmpty())
                                    @foreach ($message->attachments as $attachment)
                                        @if (str_contains($attachment, 'image'))
                                        <img onclick="showModal('{{ asset('storage/' . $attachment->file_url) }}', 'image')"
                                            class=" rounded-xl w-full max-w-[300px] object-cover opacity-70 mt-2"
                                            src="{{ asset('storage/' . $attachment->file_url) }}" alt="">
                                        @else
                                        <div class="mt-2">
                                            <a href="{{ asset('storage/' . $attachment->file_url) }}"
                                                class="text-blue-500 underline flex items-center gap-4" download>
                                                <p>{{ $attachment->name }}</p>
                                                <button type="button">
                                                    <i class="fa-solid fa-arrow-down-to-line"></i>
                                                </button>
                                            </a>
                                        </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            @elseif($message->type == 'offer')
                                offer
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            @else
            {{-- message for seller and buyer --}}
                @if ($message->sender->id !== Auth::user()->id)
                    <div class="chat-msg flex p-[0_20px_45px]">
                        <div class="relative flex-shrink-0 mb-[-20px]">
                            @if (isset($receiverInstance->profile_photo_path))
                            <img class="w-[42px] h-[42px] rounded-full object-cover mr-[15px]"
                                src="{{ asset('/storage/' . $receiverInstance->profile_photo_path) }}"
                                alt="{{ $this->receiverInstance->name }}">
                            @else
                            <img class="w-[42px] h-[42px] rounded-full object-cover mr-[15px]"
                                src="https://ui-avatars.com/api/?name={{ $receiverInstance->name }}"
                                alt="{{ $this->receiverInstance->name }}">
                            @endif
                            <div
                                class="absolute left-[calc(100%_+_12px)] w-full bottom-0 text-[12px] font-normal text-[#c0c7d2] whitespace-nowrap">

                                Message at {{ $message->created_at->format('h i a') }}
                            </div>
                        </div>
                        <div class="ml-3 max-w-[70%] flex flex-col items-start">

                            @if ($message->order_id)
                            <div
                                class="bg-white p-3 rounded-[0px_25px_25px_25px] leading-[1.5] text-[14px] text-[#273346] mb-2 font-normal">
                                <p><a class="text-blue-600 underline"
                                        href="{{ route('order_details', ['id' => $message->order_id]) }}">See
                                        Order
                                        Details</a></p>
                            </div>
                            @endif
                            <div class="flex items-center gap-2">
                                <h1 class="text-lg font-bold text-[#263238]">{{ $receiverInstance->name }}
                                </h1>
                            </div>

                            @if($message->type == 'text')
                            <div
                                class="bg-[#F3F3FF] p-3 rounded-[0px_8px_8px_8px] leading-[1.5] text-base text-[#263238] mb-2 font-medium">
                                @if(!filter_var($message->message, FILTER_VALIDATE_URL) === false)
                                <a target="_blank" href="{{ $message->message }}" class="text-blue-500 underline cursor-pointer">{{
                                    $message->message }}</a>
                                @elseif((strpos($message->message, 'http') !== false || strpos($message->message, 'www.') !==
                                false))
                                <div class='custom-highlighter'>
                                    {{ $this->highlightUrl($message->message) }}
                                </div>

                                @else
                                {{ $message->message }}
                                @endif

                                @if ($message->attachments->isNotEmpty())
                                    @foreach ($message->attachments as $attachment)
                                        @if (str_contains($attachment, 'image'))
                                        <img onclick="showModal('{{ asset('storage/' . $attachment->file_url) }}', 'image')"
                                            class=" rounded-xl w-full max-w-[300px] object-cover opacity-70 mt-2"
                                            src="{{ asset('storage/' . $attachment->file_url) }}" alt="">
                                        @else
                                        <div class="mt-2">
                                            <a href="{{ asset('storage/' . $attachment->file_url) }}"
                                                class="text-blue-500 underline flex items-center gap-4" download>
                                                <p>{{ $attachment->name }}</p>
                                                <button type="button">
                                                    <i class="fa-solid fa-arrow-down-to-line"></i>
                                                </button>
                                            </a>
                                        </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            @else
                            <div>
                                <div class="block max-w-lg  bg-white border border-gray-200 rounded-lg shadow">

                                    <div class="bg-gray-200 p-2">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 drk:text-white">{{ $message->offer?->title }}</h5>
                                        <div class="flex justify-between">
                                            <p>Price Offered: $<span class="font-medium text-lg text-[#0096D8]">{{ $message->offer?->price }}</span></p>
                                            <p>No of Days: <span class="font-medium text-lg text-[#0096D8]">{{ $message->offer?->duration }} </span></p>
                                        </div>
                                    </div>
                                    <div class="p-4 max-h-56 overflow-y-auto">
                                        <p class="font-normal text-gray-700 drk:text-gray-400">{{ $message->offer?->details }}</p>

                                    </div>
                                    @if($message->offer?->status != 'pending')
                                        <div class="p-2 flex justify-center {{ $message->offer?->status  == 'pending' ? 'bg-yellow-200' :  ($message->offer?->status == 'accepted' ? 'bg-green-200' : 'bg-red-200' )}} ">
                                            <p>{{ ucFirst($message->offer?->status) }}</p>

                                        </div>
                                    @else
                                    <div class="grid grid-cols-2 w-full shadow-sm text-center">
                                        <button wire:click='declineOfferConfirmModal({{ $message->offer?->id }}, {{ $message->id }})'class="px-4 py-4 text-md font-medium  bg-gray-200 border border-gray-300 rounded-s-lg hover:bg-gray-300 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 ">
                                          Decline
                                        </button>
                                        <button wire:click='confirmAcceptOrderModal({{ $message->offer?->id }}, {{ $message->id }})' class="px-4 py-4 text-md font-medium  bg-gray-200 border border-gray-300 rounded-s-lg hover:bg-gray-300 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700">
                                          Accept
                                        </button>

                                      </div>
                                    @endif

                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="Chat-msg-Owner flex p-[0_20px_45px] flex-row-reverse">
                        <div class="flex-shrink-0 mb-[-20px] relative">
                            @if (isset(Auth()->user()->profile_photo_path))
                            <img class="w-[44px] h-[44px] rounded-full object-cover ml-[15px]"
                                src="{{ asset('/storage/' . Auth()->user()->profile_photo_path) }}" alt="">
                            @else
                            <img class="w-[44px] h-[44px] rounded-full object-cover ml-[15px]"
                                src="https://ui-avatars.com/api/?name={{ Auth()->user()->name }}"
                                alt="{{ $this->receiverInstance->name }}">
                            @endif

                            <div
                                class="absolute left-auto right-[calc(100%_+_75px)] w-full bottom-0 text-[12px] font-normal text-[#c0c7d2] whitespace-nowrap flex items-center">
                                Message at {{ $message->created_at->format('h i a') }}
                                @if ($message->is_seen == 1)
                                <img src="{{ asset('images/double-check.png') }}" class="seenImage ml-2" width="15px" height="20px"
                                    alt="seen">
                                @else
                                <img src="{{ asset('images/seen.png') }}" class="sentImage ml-2" width="15px" height="20px"
                                    alt="sent">
                                @endif
                            </div>
                        </div>
                        <div class="ml-3 max-w-[70%] flex flex-col items-start">
                            <div class="flex items-center gap-2 w-full justify-end">
                                {{-- <p class="text-sm font-medium text-[#263238]">16 Jun 2022</p> --}}
                                <h1 class="text-lg font-bold text-[#263238]">{{ Auth()->user()->name }}</h1>
                            </div>
                            <div class="mb-2">
                                @if($message->type == 'text')
                                <div
                                    class="bg-[#F3F3FF] p-3 rounded-[8px_0px_8px_8px] leading-[1.5] text-base text-[#263238] mb-2 font-medium">
                                    @if(!filter_var($message->message, FILTER_VALIDATE_URL) === false)
                                    <a target="_blank" href="{{ $message->message }}"
                                        class="text-blue-500 underline cursor-pointer">{{ $message->message }}</a>
                                    @elseif((strpos($message->message, 'http') !== false || strpos($message->message, 'www.') !==
                                    false))
                                    <div class='custom-highlighter'>
                                        {{ $this->highlightUrl($message->message) }}
                                    </div>

                                    @else
                                    {{ $message->message }}
                                    @endif


                                    @if ($message->attachments->isNotEmpty())
                                    @foreach ($message->attachments as $attachment)
                                    @if (str_contains($attachment, 'image'))
                                    <img onclick="showModal('{{ asset('storage/' . $attachment->file_url) }}', 'image')"
                                        class=" rounded-xl w-full max-w-[300px] object-cover opacity-70 mt-2"
                                        src="{{ asset('storage/' . $attachment->file_url) }}" alt="">
                                    @else
                                    <div class="mt-2">
                                        <a href="{{ asset('storage/' . $attachment->file_url) }}"
                                            class="text-blue-500 underline flex items-center gap-4" download>
                                            <p>{{ $attachment->name }}</p>
                                            <button type="button">
                                                <i class="fa-solid fa-arrow-down-to-line"></i>
                                            </button>
                                        </a>
                                    </div>
                                    @endif
                                    @endforeach
                                    @else
                                    <div class=""></div>
                                    @endif
                                </div>
                                @else
                                <div>
                                    <div class="block max-w-lg  bg-white border border-gray-200 rounded-lg shadow">
                                        <div class="bg-gray-200 p-2">
                                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 drk:text-white">{{ $message->offer?->title }}</h5>
                                            <div class="flex justify-between">
                                                <p>Price Offered: $<span class="font-medium text-lg text-[#0096D8]">{{ $message->offer?->price }}</span></p>
                                                <p>No of Days: <span class="font-medium text-lg text-[#0096D8]">{{ $message->offer?->duration }} </span></p>
                                            </div>
                                        </div>
                                        <div class="p-4 max-h-56 overflow-y-auto">
                                            <p class="font-normal text-gray-700 drk:text-gray-400">{{ $message->offer?->details }}</p>

                                        </div>
                                        <div class="p-2 flex justify-center {{ $message->offer?->status  == 'pending' ? 'bg-yellow-200' :  ($message->offer?->status == 'accepted' ? 'bg-green-200' : 'bg-red-200' )}} ">
                                            <p>{{ ucFirst($message->offer?->status) }}</p>

                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                    </div>
                @endif
            @endif
        @endforeach
        @else
        @if (!$blocked)
        <p class="mt-[10rem]  text-center text-gray-400">No message found</p>
        @endif
        @endif
    </div>
    @if ($blocked)
    <p class="text-center text-gray-500 w-full sticky bottom-0 py-[15px] bg-[#F4F6FC]">This chat is blocked</p>
    @endif
    @else
    <div class="h-full flex justify-center items-center">
        <p class="text-center text-lg text-gray-400">No conversation selected</p>
    </div>
    @endif

    {{-- block modal --}}
    <x-jet-confirmation-modal wire:model="confirmBlock">
        <x-slot name="title">
            Block User
        </x-slot>
        <x-slot name="content">
            <div class="p-6 text-center">

                <h3 class="mb-5 text-lg font-normal text-gray-500 drk:text-gray-400">Are you sure you want to block
                    this user?</h3>
            </div>

        </x-slot>


        <x-slot name="footer">
            <button wire:click.prevent="blockUser()" type="button"
                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                Yes, I'm sure
            </button>
            <button wire:click="closeBlockModal()" type="button"
                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 drk:bg-gray-700 drk:text-gray-300 drk:border-gray-500 drk:hover:text-white drk:hover:bg-gray-600 drk:focus:ring-gray-600">No,
                cancel</button>
        </x-slot>
    </x-jet-confirmation-modal>
    {{-- block modal --}}


    {{-- report modal --}}
    <x-jet-confirmation-modal wire:model="confirmReport">
        <x-slot name="title">
            Report Chat
        </x-slot>
        <x-slot name="content">
            <div class="p-6 text-center">

                <h3 class="mb-5 text-lg font-normal text-gray-500 drk:text-gray-400">Are you sure you want to report
                    this chat?</h3>
            </div>

        </x-slot>


        <x-slot name="footer">
            <button wire:click.prevent="blockUser()" type="button"
                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                Yes, I'm sure
            </button>
            <button wire:click="closeBlockModal()" type="button"
                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 drk:bg-gray-700 drk:text-gray-300 drk:border-gray-500 drk:hover:text-white drk:hover:bg-gray-600 drk:focus:ring-gray-600">No,
                cancel</button>
        </x-slot>
    </x-jet-confirmation-modal>
    {{-- block modal --}}

    <!-- The Modal -->
    <div id="modal"
        class="hidden fixed top-0 left-0 z-[999] w-screen h-screen bg-black/70 flex justify-center items-center">

        <!-- The close button -->
        <a class="fixed z-90 top-0 right-8 text-white text-5xl font-bold" href="javascript:void(0)"
            onclick="closeModal()">&times;</a>

        <!-- A big image will be displayed here -->

        <video id='modal-video' class=" max-h-[600px] object-cover" controls></video>
        <div class="overflow-y-auto max-h-[90%]">
            <img id="modal-img" class="max-w-full mx-auto w-full" />

        </div>
    </div>

      {{-- custom offer modal --}}

    <x-jet-dialog-modal maxWidth="2xl" wire:model="customOfferModal">
        <x-slot name="title">
            Create New Offer
        </x-slot>

        <x-slot name="content">

            <div>
                <label for="offerTitle" class="block mb-2 text-sm font-medium text-gray-900 drk:text-white">Title</label>
                <input type="text" wire:model.defer='offerTitle' id="offerTitle" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500"  required maxlength="250">
                @error('offerTitle')<x-form-error>{{$message}}</x-form-error>@enderror
            </div>

            <div class="my-4">
                <label for="offerDetails" class="block mb-2 text-sm font-medium text-gray-900 drk:text-white">Details</label>
                <textarea wire:model.defer='offerDetails' id="offerDetails" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500" maxlength="2000"></textarea>

                    @error('offerDetails')<x-form-error>{{$message}}</x-form-error>@enderror
            </div>

            <div>
                <label for="offerPrice" class="block mb-2 text-sm font-medium text-gray-900 drk:text-white">Price ($)</label>
                <input type="number" id="offerPrice" wire:model='offerPrice'
                    aria-describedby="helper-text-explanation"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500"
                  placeholder="Enter price in USD" required>
                @error('offerPrice')<x-form-error>{{$message}}</x-form-error>@enderror
            </div>
            <div class="my-4">
                <label for="offerDuration" class="block mb-2 text-sm font-medium text-gray-900 drk:text-white">Duration</label>
                <input type="number" id="offerDuration" wire:model.defer='offerDuration'
                aria-describedby="helper-text-explanation"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500" placeholder="Enter number of days"
                 >
                 @error('offerDuration')<x-form-error>{{$message}}</x-form-error>@enderror
            </div>


        </x-slot>


        <x-slot name="footer">

            <button type="button" wire:click="submitOffer"
                class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800">
                Send Offer</button>

        </x-slot>

    </x-jet-dialog-modal>

    {{-- accept offer modal --}}
    <x-jet-confirmation-modal wire:model="acceptCustomOfferModal">
        <x-slot name="title">
            Accept Offer
        </x-slot>
        <x-slot name="content">
            <div class="p-6 text-center">
                <h3 class="mb-5 text-lg font-normal text-gray-500 drk:text-gray-400">Are you sure you want to accept this offer?</h3>
            </div>

        </x-slot>


        <x-slot name="footer">
            <button wire:click.prevent="acceptOffer()" type="button"
                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                Yes, I'm sure
            </button>
            <button wire:click="closeOfferModal('acceptCustomOfferModal')" type="button"
                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 drk:bg-gray-700 drk:text-gray-300 drk:border-gray-500 drk:hover:text-white drk:hover:bg-gray-600 drk:focus:ring-gray-600">No,
                cancel</button>
        </x-slot>
    </x-jet-confirmation-modal>
    {{-- accept offer modal --}}

       {{-- decline offer modal --}}
       <x-jet-confirmation-modal wire:model="declineCustomOfferModal">
        <x-slot name="title">
            Decline Offer
        </x-slot>
        <x-slot name="content">
            <div class="p-6 text-center">
                <h3 class="mb-5 text-lg font-normal text-gray-500 drk:text-gray-400">Are you sure you want to decline this offer?</h3>
            </div>

        </x-slot>


        <x-slot name="footer">
            <button wire:click.prevent="declineOffer()" type="button"
                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                Yes, I'm sure
            </button>
            <button wire:click="closeOfferModal('declineCustomOfferModal')" type="button"
                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 drk:bg-gray-700 drk:text-gray-300 drk:border-gray-500 drk:hover:text-white drk:hover:bg-gray-600 drk:focus:ring-gray-600">No,
                cancel</button>
        </x-slot>
    </x-jet-confirmation-modal>
    {{-- decline offer modal --}}
    @push('scripts')
    <script>
        var cahtBar = document.getElementById('chatBar');
            var chatBarPrevScrollHeight = 0;
            var lastScrollPosition = 0;
            var currentScrollPosition = 0;
            var loadMoreEventTriggered = false;

            function loadMoreChat() {

                currentScrollPosition = cahtBar.scrollTop;

                var scrollThreshold = 0.25 * (cahtBar.scrollHeight - cahtBar.clientHeight);

                if (!loadMoreEventTriggered && currentScrollPosition < lastScrollPosition && chatBar.scrollTop <
                    scrollThreshold) {
                    loadMoreEventTriggered = true;
                    scrollPosition = chatBar.scrollTop;
                    chatBarPrevScrollHeight = chatBar.scrollHeight;

                    Livewire.emit('loadMore')
                    // cahtBar.scrollTo(0, cahtBar.scrollHeight - scrollPosition);
                } else {
                    // console.log('down')
                }

                lastScrollPosition = currentScrollPosition;
            }

            window.addEventListener('setScrollPosition', e => {
                loadMoreEventTriggered = !e.detail.flag;
                newScrollHeight = chatBar.scrollHeight - (chatBar.scrollHeight - chatBarPrevScrollHeight) -
                    scrollPosition;

                cahtBar.scrollTo(0, cahtBar.scrollHeight - newScrollHeight);
            })
    </script>

    <script>
        // Get the modal by id
            var modal = document.getElementById("modal");

            // Get the modal image tag
            var modalImg = document.getElementById("modal-img");

            var modalVideo = document.getElementById('modal-video');

            // this function is called when a small image is clicked
            function showModal(src, type) {
                modal.classList.remove('hidden');

                if (type == 'image') {
                    modalVideo.classList.add('hidden');
                    modalImg.classList.remove('hidden');
                    modalImg.src = src;
                } else {
                    modalVideo.classList.remove('hidden');
                    modalImg.classList.add('hidden');
                    modalVideo.src = src;
                }

            }

            // this function is called when the close button is clicked
            function closeModal() {
                modal.classList.add('hidden');
                pauseVideo();
            }

            function pauseVideo() {
                if (!modalVideo.paused) {
                    modalVideo.pause();
                }
            }
    </script>

    <script>
        window.addEventListener('markMessageAsRead', event => {
                document.querySelectorAll('.sentImage').forEach(function(element, index) {
                    element.src = '{{ asset('images/double-check.png') }}';
                });

            });
            if ($('#chatBar')) {
                function scrollBottom() {
                    $('#chatBar').scrollTop($('#chatBar')[0].scrollHeight);
                }
            }


            window.addEventListener('chatSelected', event => {
                chatBarPrevScrollHeight = 0;
                lastScrollPosition = 0;
                currentScrollPosition = 0;
                loadMoreEventTriggered = false;

                scrollBottom();
            });
            scrollBottom();
    </script>
    @endpush
</div>
