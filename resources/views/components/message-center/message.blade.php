
@props(['owner' => false, 'message'])

@if ($owner)
    <div class="chat-msg flex p-[0_20px_45px]">
        <div class="relative flex-shrink-0 mb-[-20px]">
            <img class="w-[44px] h-[44px] rounded-full object-cover mr-[15px]" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%2812%29.png" alt="">
            <div class="absolute left-[calc(100%_+_12px)] w-full bottom-0 text-[12px] font-normal text-[#c0c7d2] whitespace-nowrap">
                Message seen 1.22pm
            </div>
        </div>
        <div class="ml-3 max-w-[70%] flex flex-col items-start">
            <div class="bg-white p-3 rounded-[0px_25px_25px_25px] leading-[1.5] text-[14px] text-[#273346] mb-2 font-normal">
                <p>{{$message->message}}</p>
            </div>
        </div>
    </div>
@else
    <div class="Chat-msg-Owner flex p-[0_20px_45px] flex-row-reverse">
        <div class="flex-shrink-0 mb-[-20px] relative">
            <img class="w-[44px] h-[44px] rounded-full object-cover ml-[15px]" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3364143/download+%281%29.png" alt="">
            <div class="absolute left-auto right-[calc(100%_+_75px)] w-full bottom-0 text-[12px] font-normal text-[#c0c7d2] whitespace-nowrap">
                Message seen 1.22pm
            </div>
        </div>
    <div class="ml-3 max-w-[70%] flex flex-col items-start">
            <div class="mb-2">
                <div class="bg-white p-3 rounded-[25px_0px_25px_25px] leading-[1.5] font-normal text-[14px] text-white bg-gradient-to-t from-[#2545C3] to-[#3959D5]">
                    <p>{{$message->message}}</p>
                </div>
            </div>
    </div>
        
    </div>
@endif


