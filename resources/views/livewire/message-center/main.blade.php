<div>
    <p class="font-bold text-2xl mt-16 mb-3">Messages</p>
    @if ($count > 0)
    <div x-data="{ sidebar: false }" x-init="console.log(sidebar)"
        class="h-[80vh] w-full relative flex flex-grow-[1] overflow-hidden  rounded-tr-xl rounded-br-xl rounded-bl-xl border border-[#E2EAED] bg-[#F4F6FC]">

        <div
            class="overflow-y-scroll flex flex-col bg-[#FFFFFF] lg:relative border-r border-[#E2EAED] lg:z-0 z-50 rounded-bl-xl sm:w-[375px] w-full flex-shrink-0 h-full leftbar transition-all duration-500 ease-in-out absolute bottom-0 top-0  lg:translate-x-0"
            :class="sidebar ? '-translate-x-full' : 'translate-x-0'">
            <livewire:message-center.chat-list :chatId="$chatId" />
        </div>
        {{-- main div --}}
        <div class=" h-[625px] md:h-[80vh]  w-full flex flex-col overflow-auto scrollbar-hidden bg-white ChatArea">
            {{-- <div class="w-full overflow-auto  flex flex-col bg-[#F4F6FC] ChatArea" id="chatarea"> --}}
                <livewire:message-center.chat-area :chatId="$chatId" />
                <livewire:message-center.send-message :chatId="$chatId" />
            </div>

        </div>
        @else
        <div class="flex items-center justify-center h-screen">
            <p class=" bg-gray-100 p-5 w-full  text-gray-500 text-lg text-center">No Conversation Found</p>
        </div>
    </div>
    @endif
</div>
