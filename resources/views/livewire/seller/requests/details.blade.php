<div>

    <x-message-area-notification />


    {{-- gigs table --}}

    <div class="mt-[18px]">
        <div class="container md:max-w-[900px] xl:max-w-[1450px] w-full mx-auto">
            <div class="pt-4 ">
                <h1 class="text-[22px] font-semibold">Request Details</h1>
            </div>

            <div class="pt-4 ">
                <div class="col-span-2">
                    <label for="message"
                        class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Requirements</label>
                    <textarea disabled id="message" rows="6"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{ $request->requirements }}</textarea>
                </div>

            </div>
            <div class="my-2">

                <div class="grid sm:grid-cols-3 gap-8">


                    <div class="">
                        <div class="">
                            <label for="message"
                                class="block  font-medium text-gray-900 dark:text-white mr-2">Min Budget <span
                                class="text-gray-600">($)</span></label>
                            <input disabled value="{{ $request->min_budget }}" type="number" id="min_budget"
                                aria-describedby="helper-text-explanation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        </div>


                    </div>

                    <div class="">
                        <label for="message" class="block  font-medium text-gray-900 dark:text-white mr-2">Max Budget <span
                            class="text-gray-600">($)</span></label>
                        <input disabled type="number" id="max_budget" value="{{ $request->max_budget }}"
                            aria-describedby="helper-text-explanation"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="max budget" required>

                    </div>

                    <div class="">
                        <label for="duration" class="block  font-medium text-gray-900 dark:text-white mr-2">Duration  <span
                            class="text-gray-600">(days)</span></label>
                        <input disabled type="number" id="duration" value="{{ $request->duration }}"
                            aria-describedby="helper-text-explanation"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="duration" required>

                    </div>
                </div>
            </div>
            <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <div class="mt-8">
                <label for="proposal"
                    class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Propposal</label>
                <textarea {{
                    $this->isEdit ? 'disabled' : ''}} wire:model.defer='proposal' id="proposal" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your proposal here..."></textarea>
                @error('proposal')<x-form-error>{{$message}}</x-form-error>@enderror
            </div>
            <div class="mt-4 grid sm:grid-cols-2 gap-10">
                <div>
                    <label for="price" class="block  font-medium text-gray-900 dark:text-white mr-2">Price</label>
                    <input {{ $this->isEdit ? 'disabled' : ''}} type="number" id="price" wire:model.defer='price'
                    aria-describedby="helper-text-explanation"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                    focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Enter Price in USD"
                    >
                    @error('price')<x-form-error>{{$message}}</x-form-error>@enderror
                </div>
                <div>
                    <label for="duration" class="block  font-medium text-gray-900 dark:text-white mr-2">Duration</label>
                    <input {{ $this->isEdit ? 'disabled' : ''}} type="number" id="duration" wire:model.defer='duration'
                    aria-describedby="helper-text-explanation"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500
                    focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
                    dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Enter number of days"
                    >
                    @error('duration')<x-form-error>{{$message}}</x-form-error>@enderror
                </div>
            </div>
            @if(!$this->isEdit)
            <div class="text-center mt-12">
                <button wire:click='submit' type="button"
                    class="inline-block w-[211px] h-[60px] m-auto bg-gradient-to-t from-[rgba(38,70,196,1)] to-[rgba(57,89,214,1)] text-white font-medium text-sm leading-tight rounded-full focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Send
                    Proposal</button>

            </div>
            @endif
        </div>
    </div>

</div>
