<div class="" x-data="{selected:0}">
    <ul class="shadow-box space-y-5">
        @forelse ($faqs as $faq )
        <li class="relative bg-white border border-[#E2EAED] rounded">
            <button type="button" class="w-full px-3 py-[10px] text-left" @click="selected !== {{$loop->index}} ? selected = {{$loop->index}}  : selected = null">
                <div class="flex items-center justify-between">
                <span class="text-base text-black font-semibold ">{{$faq->question}}</span>
                <i class="fa-solid fa-chevron-down transition-all duration-200 ease-linear"
                x-bind:class="selected == {{$loop->index}}  ? 'rotate-180 ' : ''">
                </i>
            </div>
            </button>
            <div class="relative overflow-auto transition-all duration-300 ease-in   " x-bind:class="selected == {{$loop->index}}  ? 'block animate-[show-transition_0.5s_ease-in-out]' : 'opacity-0 hidden'" id="style-2">
                <div class="px-4 py-3">
                    <p class="text-base text-[#6A6A6A] font-medium ">{{$faq->answer}}</p>
                </div>
            </div>
        </li>
        @empty

        @endforelse

    </ul>
</div>
