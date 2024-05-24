
<div>
    @if(!$isReviewed)
    <button type="button" wire:click="toggleModal" class="w-full focus:outline-none text-white bg-green-400 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Add Review</button>


    <x-jet-dialog-modal wire:model="openModal">
        <x-slot name="title">
            Add Review
        </x-slot>

        <x-slot name="content">


                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="review"  class="text-lg" value="{{ __('Review') }}" />
                    <textarea required maxlength="500"  wire:model.defer="comment" name="comment" class="block w-full px-4 py-3 border-2 rounded-lg focus:border-blue-200 focus:outline-none" placeholder="Review.."></textarea>

                </div>

                <div class="col-span-6 sm:col-span-4 mt-4 mb-4">

                     <x-jet-label for="rating" class="text-lg" value="{{ __('Rating') }}" />

                    <div class="flex space-x-1 rating">
                        <div>
                            <label for="star1">

                                <input class="opacity-0" wire:model="rating" type="radio" id="star1" name="rating" value="1"/>
                                <svg class="cursor-pointer block w-8 h-8 @if($rating >= 1 )  text-yellow-400 @else text-gray-300 drk:text-gray-500 @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            </label>
                        </div>
                        <div>
                            <label for="star2">
                                <input class="opacity-0"  wire:model="rating" type="radio" id="star2" name="rating" value="2" />
                                <svg class="cursor-pointer block w-8 h-8 @if($rating >= 2 )  text-yellow-400 @else text-gray-300  @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            </label>
                        </div>

                        <label for="star3">
                            <input class="opacity-0"    wire:model="rating" type="radio" id="star3" name="rating" value="3" />
                            <svg class="cursor-pointer block w-8 h-8 @if($rating >= 3 )  text-yellow-400 @else text-gray-300 drk:text-gray-500 @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        </label>
                        <label for="star4">
                            <input class="opacity-0"   wire:model="rating" type="radio" id="star4" name="rating" value="4" />
                            <svg class="cursor-pointer block w-8 h-8 @if($rating >= 4 ) text-yellow-400 @else text-gray-300 drk:text-gray-500 @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        </label>
                        <label for="star5">
                            <input class="opacity-0"    wire:model="rating" type="radio" id="star5" name="rating" value="5" />
                            <svg class="cursor-pointer block w-8 h-8 @if($rating >= 5 )  text-yellow-400 @else text-gray-300 drk:text-gray-500 @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        </label>
                    </div>

                </div>




        </x-slot>


        <x-slot name="footer">
        <button type="button" wire:click="addReview"  wire:target='addReview' wire:loading.attr="disabled"
            class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">
            <span wire:target='addReview' wire:loading.remove>Submit</span>
            <span wire:target='addReview' wire:loading>

                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 6.627 5.373 12 12 12v-4a7.963 7.963 0 01-6-2.709z"></path>
                </svg>
            </span>
        </button>
            {{-- <button type="button" wire:click="addReview"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Submit</button> --}}
            <button type="button" wire:click="toggleModal"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-gray-800 drk:text-white drk:border-gray-600 drk:hover:bg-gray-700 drk:hover:border-gray-600 drk:focus:ring-gray-700">Cancel</button>
        </x-slot>

    </x-jet-dialog-modal>
    @else
        <p class="ml-2 text-green-500">Review Given</p>
    @endif
</div>
