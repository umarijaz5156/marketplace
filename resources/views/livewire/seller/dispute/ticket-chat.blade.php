<div class="w-full">
    @if($chat)
    <div class="h-full flex flex-col bg-[#F4F6FC] " >
        <!-- Chat Header -->

        <div class="sticky top-0 left-0 z-[2] p-[30px] lg:p-[30px_60px] bg-[#F4F6FC]">
            <div class="flex w-full items-center justify-between mb-5">
                <div class="flex items-center cursor-pointer transition-all duration-200 relativ">
                    <div class="w-full overflow-hidden">
                        <p class="mb-1 font-normal text-lg sm:text-[30px] ">{{$chat->subject}}</p>
                        <a href="{{route('order_details', ['id' => $orderId])}}">
                            <p class=" hover:text-blue-500  font-medium text-[17px] text-gray-500 ">Order# {{$orderId}}</p>
                        </a>

                    </div>
                </div>
                <div class="flex items-center">
                    <p class="text-[16px] text-gray-600 group-hover:text-[#f0f0f0a1]">{{$chat->created_at->format('M, d Y')}}</p>
                </div>
            </div>
            <div class="w-full bg-[#DBE0ED] h-[2px]"></div>
        </div>
        <!-- Chats Messages -->
        <div class="flex-grow ">
            {{-- Chat Area Component --}}
            <x-AdminPanel.ticket.chat-area :chat="$chat" :sender_id="$senderId" />

            <form wire:submit.prevent="sendMessage" class="sticky bottom-0">
                <label for="chat" class="sr-only">Your message</label>
                <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg drk:bg-gray-700">
                    <button type="button"
                        class="inline-flex justify-center p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 drk:text-gray-400 drk:hover:text-white drk:hover:bg-gray-600">
                        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Upload image</span>
                    </button>
                    <button type="button"
                        class="p-2 text-gray-500 rounded-lg cursor-pointer hover:text-gray-900 hover:bg-gray-100 drk:text-gray-400 drk:hover:text-white drk:hover:bg-gray-600">
                        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-.464 5.535a1 1 0 10-1.415-1.414 3 3 0 01-4.242 0 1 1 0 00-1.415 1.414 5 5 0 007.072 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Add emoji</span>
                    </button>
                    <input wire:model="message" id="chat" rows="1"
                        class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 drk:bg-gray-800 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500"
                        placeholder="Your message...">
                    <button type="submit" {{ empty(trim($message)) ? 'disabled' : '' }}
                        class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 drk:text-blue-500 drk:hover:bg-gray-600">
                        <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                            </path>
                        </svg>
                        <span class="sr-only">Send message</span>
                    </button>
                </div>
            </form>
        </div>

    </div>



    <script>
        const scrollToBottom = (id) => {
            const element = document.getElementById(id);
            element.scrollTop = element.scrollHeight;
        }

        scrollToBottom("ChatArea");

        window.addEventListener('ticketSelected', event => {
            scrollToBottom(event.detail.id);
        })
    </script>
      @endif
</div>

