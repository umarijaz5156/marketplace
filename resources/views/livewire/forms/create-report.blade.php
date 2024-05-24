<div class="">

    @if(auth()->check())
    @if($contentType == App\Enums\ReportType::Gig->value || $contentType == App\Enums\ReportType::Chat->value)
    <p @click="sidebar = true" class="text-gray-500 drk:text-gray-400"><a wire:click="toggleModal" class="cursor-pointer inline-flex items-center font-medium text-gray-400 drk:text-gray-600 hover:underline">
        <span class="gap-4 flex">
            <i class="mt-1 fa-solid fa-circle-info"></i>
            <span class="hidden sm:block">Report this {{$contentType}}</span>
        </span>

        {{-- <svg aria-hidden="true" class="w-5 h-5 ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg> --}}
        </a></p>
    @elseif($contentType == App\Enums\ReportType::Seller->value)
    <p class="text-gray-500 drk:text-gray-400"><a wire:click="toggleModal" class="cursor-pointer inline-flex items-center font-medium text-gray-400 drk:text-gray-600  hover:underline">
        <span class="gap-4">
            <i class="text-xl mt-1 fa-solid fa-circle-info"></i>
            Report this seller
        </span>

        </a></p>
    @else
        <button  data-tooltip-target="tooltip-light" data-tooltip-style="light"  {{ $isReported ? 'disabled' : ''}} wire:click="toggleModal" type="button" class="">

            <img src="{{asset('images/warning.png')}}" width="40px"/>
            <div id="tooltip-light" role="tooltip" class="inline-block absolute invisible z-10 py-2 px-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 shadow-sm opacity-0 tooltip">
            {{$isReported ? 'reported' : 'report'}}
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </button>
    @endif
    @endif
    @if($isBlock)
    <x-jet-dialog-modal wire:model="openModal">


        <x-slot name="title">
            Report {{ $contentType }}
        </x-slot>

        <x-slot name="content">
            @if(session()->has('message'))

            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 60000)" id="alert-border-3"
                class=" flex p-4 mb-4 bg-green-100 border-t-4 border-green-500 drk:bg-green-200" role="alert">
                <svg class="flex-shrink-0 w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <div class="ml-3 text-sm font-medium text-green-700">
                    {{ session('message') }}
                </div>

            </div>

            @endif
            <div class="col-span-6 sm:col-span-4">
                <textarea maxlength="1000" required wire:model.defer="description" name="desc"
                    class="block w-full px-4 py-3 border-2 rounded-lg focus:border-blue-200 focus:outline-none"
                    placeholder="Add report details..."></textarea>
            </div>
            @error('description')
                <x-form-error>{{ $message }}</x-form-error>
            @enderror
        </x-slot>


        <x-slot name="footer">
            <button type="button" wire:click="addReport"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Report</button>
            <button type="button" wire:click="toggleModal"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-gray-800 drk:text-white drk:border-gray-600 drk:hover:bg-gray-700 drk:hover:border-gray-600 drk:focus:ring-gray-700">Close</button>
        </x-slot>

    </x-jet-dialog-modal>
    @endif
</div>
