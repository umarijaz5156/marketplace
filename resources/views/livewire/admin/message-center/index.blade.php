<div class="mx-8 mt-[30px]">
    <div class="w-full lg:max-w-[960px] xl:max-w-[1140px] 2xl:max-w-[1600px] mx-auto h-[85vh]">
        <div class="flex items-center justify-between">
            <div class="py-5 flex justify-start items-center gap-x-3 px-3 lg:px-0">
                <h1 class="text-3xl font-semibold">Chat</h1>
                <button class="btn text-[17px]  lg:hidden" id="collapse-sidebar"><i class="fa-solid fa-bars"></i></button>
            </div>
            <div class="">
                <div class="inline-flex flex-col justify-center relative text-gray-500">
                    <div class="relative">
                        <input wire:model="search" type="text" class="p-2 pl-8 rounded border border-gray-200 bg-gray-200 focus:bg-white focus:outline-none focus:ring-2 focus:ring-yellow-600 focus:border-transparent" placeholder="search..."  />
                        <svg class="w-4 h-4 absolute left-2.5 top-3.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <ul class="bg-white border border-gray-100 w-full mt-2 absolute bottom-[-140px]">
                        @foreach ($users as $user)
                            <li wire:click="searchedUser({{ $user->id }})" class="pl-8 pr-2 py-1 border-b-2 border-gray-100 relative cursor-pointer hover:bg-yellow-50 hover:text-gray-900">
                                <svg class="absolute w-4 h-4 left-2 top-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                                {{ $user->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
        </div>

         <div class="w-full flex flex-grow-[1] overflow-hidden rounded-3xl bg-[#F4F6FC] h-[92%]"
             style="box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;">

             <div class="overflow-y-auto overflow-x-hidden flex flex-col bg-[#FFFFFF] lg:relative z-10 rounded-3xl w-[375px] flex-shrink-0 h-full leftbar transition-all duration-500 ease-in-out absolute bottom-0 top-0 translate-x-[-375px] lg:translate-x-0"
                 style="box-shadow: rgb(149 157 165 / 20%) 0px 8px 24px;">
                 <livewire:message-center.chat-list access="admin" :chatId="$chatId" />
             </div>
             {{-- main div --}}

             <div class="w-full overflow-auto  flex flex-col bg-[#F4F6FC] ChatArea" id="chatarea">
                 <livewire:message-center.chat-area access="admin" :chatId="$chatId"/>

             </div>


         </div>

     </div>
 </div>
