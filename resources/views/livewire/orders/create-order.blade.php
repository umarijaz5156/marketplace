<div>
    @if(auth()->check())
    <button type="button" wire:click="showModal" class="{{isset($class) ? $class : "w-full mb-4 text-white bg-[#0096D8] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-3 sm:px-8 py-3 drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800 text-sm sm:text-lg"}}">{{$title}}</button>
    {{-- <div class="mt-[40px] ">
        <button type="button" wire:click="showModal" class="text-white bg-gradient-to-t from-[#2545c3] to-[#3959d5]  focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-4 text-center mr-2 mb-2  drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800 w-[100%] sm:w-max">Order Now</button>

    </div> --}}
    @endif
    {{-- order form modal --}}
    <x-jet-dialog-modal maxWidth="2xl" wire:model="openModal">
        <x-slot name="title">
            {{-- Order Gig --}}
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-inputs.label for="requirements">Order Details</x-inputs.label>
                <p class="mb-3 text-lg font-normal text-gray-500 md:text-xl drk:text-gray-400">{{$gig->gigDetail->title}}</p>
            </div>
            @if($isRequirements)
                <div  class="max-h-[30rem] overflow-y-auto mb-4">
                    <x-inputs.label for="requirements">Order Requirements</x-inputs.label>
                    @error('requirementAnswer')<x-form-error>{{$message}}</x-form-error>@enderror
                    @foreach ($requirements as $index=>$requirement)
                    <p class="mb-3 text-lg font-light text-gray-500 md:text-xl drk:text-gray-400">{!! $requirement->requirement !!}</p>
                        @if($requirement->type == 'text')
                        <x-inputs.text-area maxLength="1000" name="requirement.{{$index}}" wire:model="requirementAnswer.{{$index}}" rows="4" placeholder="Add here..."></x-inputs.text-area>
                        @else
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 drk:text-gray-300" for="file_input">Upload file</label>
                            <input accept="image/*,application/pdf,text/plain,.zip" wire:model="files" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer drk:text-gray-400 focus:outline-none drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file" multiple>

                        </div>
                        @endif
                        @endforeach
                        @error('files')<x-form-error>{{$message}}</x-form-error>@enderror
                        @error('files.*')<x-form-error>{{$message}}</x-form-error>@enderror
                </div>
            @endif


        </x-slot>


        <x-slot name="footer">
            {{-- <div wire:loading.remove wire:target="files">
                <button type="submit" wire:click="order"
                class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800">
                Order (${{$price}})</button>
            </div>
            <div wire:loading wire:target="files">
                <button type="submit"
                class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800">
               Uploading...</button>
            </div> --}}
            <button type="submit" wire:click="order"
            class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800">
            Proceed to checkout</button>

        </x-slot>

    </x-jet-dialog-modal>




</div>
