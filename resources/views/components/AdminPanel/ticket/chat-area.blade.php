@props(['chat'])

<div class="flex items-start h-[65vh] overflow-y-auto overflow-x-hidden justify-between flex-wrap" id="ChatArea">
    <div class="flex-grow ">
        @if ($chat)
            @foreach ($chat->ticketChat as $message)
                @if ($message->sender_id != auth()->user()->id)
                    <div class="chat-msg flex p-[0_20px_30px]">
                        <div class="relative flex-shrink-0 mb-[-20px]">
                            @if (isset($message->sender->profile_photo_path))
                                <img class="w-[44px] h-[44px] rounded-full object-cover mr-[10px]"
                                    src="{{ asset('/storage/' . $message->sender->profile_photo_path) }}"
                                    alt="">
                            @else
                                <img class="w-[44px] h-[44px] rounded-full object-cover mr-[10px]"
                                    src="https://ui-avatars.com/api/?name={{ $message->sender->name }}"
                                    alt="{{ $message->sender->name }}">
                            @endif
                            <div
                                class="absolute left-[calc(100%_+_12px)] w-full bottom-0 text-[12px] font-normal text-[#c0c7d2] whitespace-nowrap">
                                {{-- Message seen 1.pm --}}
                                Message at {{ $message->created_at->format('h:i a') }} by
                                @if ($chat->ticket_manager_id == $message->sender_id )
                                    <span class=" px-1 py-1 font-bold text-[14px]">Ticket Manager</span>
                                @else
                                {{$message->sender->name}}
                                @endif

                            </div>
                        </div>
                        <div class="ml-3 max-w-[70%] flex flex-col items-start">
                            <div
                                class="{{$chat->ticket_manager_id == $message->sender_id ? 'bg-green-300' : 'bg-white'}}   p-3 rounded-[0px_25px_25px_25px] leading-[1.5] text-[14px] text-[#273346] mb-2 font-normal break-all">
                                <p>{{ $message->message }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="Chat-msg-Owner flex p-[0_20px_30px] flex-row-reverse">
                        <div class="flex-shrink-0 mb-[-20px] relative">
                            @if (isset($message->sender->profile_photo_path))
                                <img class="w-[44px] h-[44px] rounded-full object-cover ml-[10px]"
                                    src="{{ asset('/storage/' . $message->sender->profile_photo_path) }}"
                                    alt="">
                            @else
                                <img class="w-[44px] h-[44px] rounded-full object-cover ml-[10px]"
                                    src="https://ui-avatars.com/api/?name={{ $message->sender->name }}"
                                    alt="{{ $message->sender->name }}">
                            @endif

                            <div
                                class="absolute left-auto right-[calc(100%_+_170px)] w-full bottom-0 text-[12px] font-normal text-[#c0c7d2] whitespace-nowrap">
                                Message at {{ $message->created_at->format('h:i a') }} by {{$message->sender->name}}
                            </div>
                        </div>
                        <div class="ml-3 max-w-[70%] flex flex-col items-start">
                            <div class="mb-2 break-all">
                                <div
                                    class="flex bg-white p-3 rounded-[25px_0px_25px_25px] leading-[1.5] font-normal text-[14px] text-white bg-gradient-to-t from-[#2545C3] to-[#3959D5]">
                                    <p>{{ $message->message }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>

</div>
