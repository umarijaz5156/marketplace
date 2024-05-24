<div class="relative">
    <div wire:loading wire:target='nextPage,previousPage,chatUserSelected'>
        <div id="loader-overlay"
            class="z-10  inset-0 absolute flex items-center justify-center bg-gray-200 opacity-75">
            <!-- Use your loader component or an animated spinner here -->
            <div class="w-16 h-16 border-t-4 border-blue-500 border-solid rounded-full animate-spin"></div>
        </div>
    </div>


    {{-- <div class="custom-loader"></div> --}}
    @if (count($chats) > 0)
    <div class="leftbar max-h-[710px] h-full overflow-y-auto">
    @foreach ($chats as $chat)

    @if (!$chat->sender || !$chat->receiver)
    @continue;
    @endif

    <div @click="sidebar = !sidebar" id="chat_{{ $chat->id }}" wire:key="{{ $chat->id }}"
        wire:click="chatUserSelected({{ $chat }} ,{{ $this->getChatUserInstance($chat, $name = 'id') }})"
        class="flex items-center px-6 py-4 cursor-pointer transition-all duration-200 relative  group {{ $this->getCurrentChatId() == $chat->id ? 'bg-[#0096D8] text-white' : 'text-[#263238]' }} hover:bg-[#0096D8] hover:text-white">

        @if ($access != 'admin')
        @if (!is_null($this->getChatUserInstance($chat, $name = 'profile_photo_path')))
        <img class="w-[44px] h-[44px] rounded-full object-cover mr-[15px]"
            src="{{ asset('/storage/' . $this->receiverInstance->profile_photo_path) }}"
            alt="{{ $this->receiverInstance->name }}">
        @else
        <img class="w-[44px] h-[44px] rounded-full object-cover mr-[15px]"
            src="https://ui-avatars.com/api/?name={{ $this->receiverInstance->name }}"
            alt="{{ $this->receiverInstance->name }}">
        @endif
        @endif
        <div class="w-full overflow-hidden">
            <div class="flex justify-between items-center mb-1 font-semibold text-lg">

                @if ($access != 'admin')
                <p
                    class="{{ $this->getCurrentChatId() == $chat->id ? ' text-white' : 'text-[#263238]' }}  group-hover:text-white ">
                    {{ $this->receiverInstance->name }}</p>
                @endif

                <p class="before:content-['•'] before:mr-[2px] text-sm">
                    {{ $chat->chatMessages->last()?->created_at->shortAbsoluteDiffForHumans() }}</p>
            </div>
            @if ($chat->content_type == 'Gig')
            <p class="truncate text-sm">{{ $this->getGig($chat->id) }}</p>
            @elseif($chat->content_type == 'Order')
            <p class="text-sm ">Order # {{ $chat->content_id }}</p>
            @elseif($chat->content_type == 'Proposal')
            <p class="text-sm "> {{  \Illuminate\Support\Str::limit($this->getProposal($chat->content_id),  50, $end='...' ) }}</p>
            @endif
            <div class="flex justify-between text-[13px] font-medium items-center">
                <p
                    class="whitespace-nowrap overflow-hidden text-ellipsis {{ $this->getCurrentChatId() == $chat->id ? 'text-white' : 'text-[#969eaa]' }} group-hover:text-white ">
                    {{ $chat->chatMessages->last()?->message }}</p>

                @if (count($chat->chatMessages->where('is_seen', 0)->where('receiver_id', Auth()->user()->id)))
                <p class="bg-[#E4670F] p-[1px_7px] rounded-full text-white">
                    {{ count($chat->chatMessages->where('is_seen', 0)->where('receiver_id', Auth()->user()->id)) }}
                </p>
                @endif
            </div>
        </div>

    </div>
    @endforeach
    </div>
    @if($totalChats > $perpage)
    <div class="px-2 py-2 sticky bottom-0  bg-gray-200">
        <div class="flex {{ $pageNumber > 1 ?  'justify-between' : 'justify-end'}}">
            @if($pageNumber > 1)
                <button wire:click='previousPage'
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    « Previous
                </button>
            @endif
            @if($perpage == count($chats))
                <button wire:click='nextPage'
                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    Next »
                </button>
            @endif
        </div>
    </div>
    @endif
    @endif



</div>
