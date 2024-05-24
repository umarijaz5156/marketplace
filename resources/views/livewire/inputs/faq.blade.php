<div>



      <div class=" flex justify-between items-center flex-wrap">
        <h1 class="text-[30px] font-light">Frequently Asked Questions</h1>
        <a wire:click.prevent="add({{$i}})" class="cursor-pointer text-[16px] border border-[#3959D6] px-6 py-3 rounded-full mr-3 bg-white text-[#2646C4]">
          <i class=" fa-regular fa-plus text-[16px] mr-2"></i> Add FAQ
        </a>
      </div>

      @error('faq') <span
      class="flex items-center font-medium tracking-wide text-red-500 text-s mt-1 ml-1">{{ $message
      }}</span> @enderror



      @foreach($inputs as $key => $value)
            <div class="mt-7">


                <div class=" bg-white mb-4 w-full p-9 sm:px-[60px] sm:py-[40px] rounded-3xl border border-gray-200 drk:bg-gray-700 drk:border-gray-600" style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">

                    <div class="flex justify-between items-center pb-4 border-b drk:border-gray-600">
                        <div class="flex flex-wrap items-center divide-gray-200 sm:divide-x drk:divide-gray-600">
                            <p class="text-[18px] font-medium">Add Questions & Answers for Your Buyers.</p>
                        </div>
                        <div>
                            <button wire:click.prevent="remove({{$key}})" type="button" class=" text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800">
                                <svg  class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Remove</span>
                              </button>
                        </div>
                    </div>
                    <div class="py-2 rounded-b-lg drk:bg-gray-800">
                        <label for="question" class="sr-only">Question</label>
                        <textarea x-model="faqs[{{$value}}][question]" maxlength="150" name="faqs[{{$value}}][question]"  wire:model="question.{{ $value }}"  rows="1" class="block px-0 w-full text-[18px] text-gray-800 bg-white border-0 drk:bg-gray-800 focus:ring-0 drk:text-white drk:placeholder-gray-400" placeholder="Enter your question here"></textarea>
                    </div>
                    <div class="py-2 mt-4 bg-white rounded-b-lg drk:bg-gray-800">
                        <label for="answer" class="sr-only">Answer</label>
                        <textarea x-model="faqs[{{$value}}][answer]" maxlength="250"  name="faqs[{{$value}}][answer] " wire:model="answer.{{ $value }}"  rows="2" class="block px-0 w-full text-[18px] text-gray-800 bg-white border-0 drk:bg-gray-800 focus:ring-0 drk:text-white drk:placeholder-gray-400" placeholder="Enter your answer here"></textarea>
                    </div>

                </div>

            </div>
        @endforeach

        @foreach ($faqs as $index=>$faq)
        {{-- {{dd($faqs)}} --}}
            <div class="mt-7">
                <div class=" bg-white mb-4 w-full p-9 sm:px-[60px] sm:py-[40px] rounded-3xl border border-gray-200 drk:bg-gray-700 drk:border-gray-600" style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">

                    <div class="flex justify-between items-center pb-4 border-b drk:border-gray-600">
                        <div class="flex flex-wrap items-center divide-gray-200 sm:divide-x drk:divide-gray-600">
                            <p class="text-[18px] font-medium">Add Questions & Answers for Your Buyers.</p>
                        </div>
                        <div>
                            <button wire:click.prevent="remove({{$index}})" type="button" class=" text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center mr-2 drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800">
                                <svg  class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Remove</span>
                            </button>
                        </div>
                    </div>
                    <div class="py-2 rounded-b-lg drk:bg-gray-800">
                        <label for="question" class="sr-only">Question</label>
                        <textarea maxlength="150" name="faqs[{{$index}}][question]"  wire:model="faqs.{{$index}}.question"  rows="1" class="block px-0 w-full text-[18px] text-gray-800 bg-white border-0 drk:bg-gray-800 focus:ring-0 drk:text-white drk:placeholder-gray-400" placeholder="Enter your question here"></textarea>
                    </div>
                    <div class="py-2 mt-4 bg-white rounded-b-lg drk:bg-gray-800">
                        <label for="answer" class="sr-only">Answer</label>
                        <textarea  maxlength="250"  name="faqs[{{$index}}][answer]" wire:model="faqs.{{$index}}.answer"  rows="2" class="block px-0 w-full text-[18px] text-gray-800 bg-white border-0 drk:bg-gray-800 focus:ring-0 drk:text-white drk:placeholder-gray-400" placeholder="Enter your answer here"></textarea>
                    </div>

                </div>

            </div>
        @endforeach

</div>
