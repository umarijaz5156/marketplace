<div class="mx-8 mt-[30px]">
    <div class="w-full lg:max-w-[960px] xl:max-w-[1140px] 2xl:max-w-[1600px] mx-auto h-[85vh]">
         <div class="py-5 flex justify-start items-center gap-x-3 px-3 lg:px-0">
             <h1 class="text-3xl font-semibold">Chat</h1>
             <button class="btn text-[17px]  lg:hidden" id="collapse-sidebar"><i class="fa-solid fa-bars"></i></button>
         </div>
         <div class="w-full flex flex-grow-[1] overflow-hidden rounded-3xl bg-[#F4F6FC] h-[92%]"
             style="box-shadow: rgb(100 100 111 / 20%) 0px 7px 29px 0px;">


             {{-- <div class="overflow-y-auto overflow-x-hidden flex flex-col bg-[#FFFFFF] lg:relative z-10 rounded-3xl w-[375px] flex-shrink-0 h-full leftbar transition-all duration-500 ease-in-out absolute bottom-0 top-0 translate-x-[-375px] lg:translate-x-0"
                 style="box-shadow: rgb(149 157 165 / 20%) 0px 8px 24px;">
                 <livewire:message-center.chat-list access="manager" :chatId="$chatId"/>
             </div> --}}
             {{-- main div --}}

             <div class="w-full overflow-auto  flex flex-col bg-[#F4F6FC] ChatArea" id="chatarea">
                 <livewire:message-center.chat-area access="manager" :chatId="$chatId"/>

             </div>


         </div>

     </div>
 </div>
