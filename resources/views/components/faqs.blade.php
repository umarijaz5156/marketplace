@props(['title'])
<div class="container 2xl:max-w-screen-2xl mx-auto px-4 h-full">
    <div class="">
        <div class="text-center">
            <h1 class="text-6xl font-bold text-[#263238]">{{$title}} FAQs</h1>
        </div>
        <div class="mt-14 max-w-4xl mx-auto" x-data="{selected:1}">
            <ul class="shadow-box space-y-3">
                <li class="relative bg-white border border-[#E2EAED] rounded">
                    <button type="button" class="w-full px-3 py-[10px] text-left" @click="selected !== 1 ? selected = 1 : selected = null">
                        <div class="flex items-center justify-between">
                          <span class="text-xl text-black font-semibold ">Explain a logo design?</span>
                          <i class="fa-solid fa-chevron-down transition-all duration-200 ease-linear" x-bind:class="selected == 1 ? 'rotate-180 ' : ''">
                          </i>
                      </div>
                    </button>
                    <div class="relative overflow-auto transition-all duration-300 ease-in block animate-[show-transition_0.5s_ease-in-out]" x-bind:class="selected == 1 ? 'block animate-[show-transition_0.5s_ease-in-out]' : 'opacity-0 hidden'" id="style-2">
                        <div class="px-4 py-3">
                            <p class="text-lg text-[#6A6A6A] font-medium ">A logo is a representative symbol or brandmark for an organization. This symbol becomes a visual representation of the organization. Logo is designed in a way to depict brand philosophy and ideology which is conveyed through symbols, style, color scheme etc. </p>
                        </div>
                    </div>
                </li>
                <li class="relative bg-white border border-[#E2EAED] rounded">
                    <button type="button" class="w-full px-3 py-[10px] text-left" @click="selected !== 2 ? selected = 2 : selected = null">
                        <div class="flex items-center justify-between">
                          <span class="text-xl text-black font-semibold ">What are some qualities of good logo?</span>
                          <i class="fa-solid fa-chevron-down transition-all duration-200 ease-linear" x-bind:class="selected == 2 ? 'rotate-180 ' : ''">
                          </i>
                      </div>
                    </button>
                    <div class="relative overflow-auto transition-all duration-300 ease-in block animate-[show-transition_0.5s_ease-in-out]" x-bind:class="selected == 2 ? 'block animate-[show-transition_0.5s_ease-in-out]' : 'opacity-0 hidden'" id="style-2">
                        <div class="px-4 py-3">
                            <p class="text-lg text-[#6A6A6A] font-medium ">A good logo design is one that is unique yet eye-catchy. The logo should distinct your brand from that of competitors while depicting the business ideology but at the same time it should be attractive to attain customers’ attention. </p>
                        </div>
                    </div>
                </li>
                <li class="relative bg-white border border-[#E2EAED] rounded">
                    <button type="button" class="w-full px-3 py-[10px] text-left" @click="selected !== 3 ? selected = 3 : selected = null">
                        <div class="flex items-center justify-between">
                          <span class="text-xl text-black font-semibold ">How can you hire talented logo designers?</span>
                          <i class="fa-solid fa-chevron-down transition-all duration-200 ease-linear" x-bind:class="selected == 3 ? 'rotate-180 ' : ''">
                          </i>
                      </div>
                    </button>
                    <div class="relative overflow-auto transition-all duration-300 ease-in block animate-[show-transition_0.5s_ease-in-out]" x-bind:class="selected == 3 ? 'block animate-[show-transition_0.5s_ease-in-out]' : 'opacity-0 hidden'" id="style-2">
                        <div class="px-4 py-3">
                            <p class="text-lg text-[#6A6A6A] font-medium ">You can scroll through the services of logo designers, communicate with them, see their past samples and knowledge. Based on this information, you can then hire the designer you think is competitive and talented. </p>
                        </div>
                    </div>
                </li>
                <li class="relative bg-white border border-[#E2EAED] rounded">
                    <button type="button" class="w-full px-3 py-[10px] text-left" @click="selected !== 4 ? selected = 4 : selected = null">
                        <div class="flex items-center justify-between">
                          <span class="text-xl text-black font-semibold ">What is cost of logo design?</span>
                          <i class="fa-solid fa-chevron-down transition-all duration-200 ease-linear" x-bind:class="selected == 4 ? 'rotate-180 ' : ''">
                          </i>
                      </div>
                    </button>
                    <div class="relative overflow-auto transition-all duration-300 ease-in block animate-[show-transition_0.5s_ease-in-out]" x-bind:class="selected == 4 ? 'block animate-[show-transition_0.5s_ease-in-out]' : 'opacity-0 hidden'" id="style-2">
                        <div class="px-4 py-3">
                            <p class="text-lg text-[#6A6A6A] font-medium ">The cost of logo design varies with the designers. Every designer gives his/her own bid as per the quality of their work. You can find logo designers of all levels at TheHotBleep offering you a wide price range. You can choose the one that you find suitable as per your budget. </p>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>
