<div>
    {{-- <button wire:click='openModal' type="button"
        class="w-[205px] text-[#545454] bg-white border border-[#707070] hover:bg-[#2545c3] focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-4 text-center mr-2 mb-2 hover:text-white drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800">Contact
        Seller</button> --}}
        @if($type == 'packages')
        <button wire:click='openModal' type="button"
        class="w-full  text-[#0096D8] hover:text-white border border-[#0096D8] hover:border-blue-800 bg-white hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-3 sm:px-8 py-3 drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800 text-sm sm:text-lg">Contact
        Seller</button>
        @else
        <button  wire:click='openModal' type="button"
        class="w-full  text-white bg-[#0096D8] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-3 sm:px-8 py-3 drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800 text-sm sm:text-lg">Contact
        Me</button>
        @endif

    <x-jet-dialog-modal wire:model="openModal">
        <x-slot name="title">
            Contact Seller
        </x-slot>
        {{-- <x-form-error>{{$message}}</x-form-error> --}}
        <x-slot name="content">
            <div class="mt-10">

                <x-inputs.text-area maxLength='1000' rows="4" id="message" wire:model.defer="message"
                    placeholder="Type Message here..." />
            </div>
            @error('message')
                <x-form-error>{{$message}}</x-form-error>
            @enderror

        </x-slot>


        <x-slot name="footer">
            <button type="submit" wire:click="sendMessage"
                class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800">Send
                Message</button>
        </x-slot>

    </x-jet-dialog-modal>

</div>
