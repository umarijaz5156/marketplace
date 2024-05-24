<div >
    @if (session()->has('order-placed'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)" id="toast-message-cta" class="w-full max-w-lg p-4 text-white font-medium bg-[#0096D8] shadow drk:bg-gray-800 drk:text-gray-400" role="alert">

                <div class="flex">

                        <img class="w-24 rounded-lg  shadow-lg" src="{{ asset('/gigs/images/'.session('image')) }}" alt="{{ session('slug') }}"/>{{-- {{ asset('/gigs/images/'.session('image')) }} --}}

                    <a href="{{ route('gig_details', ['slug' => session('slug')]) }}">
                        <div class="ml-3 text-lg font-normal">
                            {{-- <span class="mb-1 text- font-semibold text-gray-900 drk:text-white">Jese Leos</span> --}}
                            <div class="mb-2 text-lg font-medium">{{ session('order-placed') }}</div>
                            {{-- <a href="{{ route('gig_details', ['slug' => session('slug')]) }}" class="inline-flex px-3.5 py-2.5 text-base font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 drk:bg-blue-500 drk:hover:bg-blue-600 drk:focus:ring-blue-800">View</a> --}}
                            <div class="text-base mt-4">
                                {{ session('date') }}
                            </div>
                        </div>
                    </a>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-[#0096D8] text-white rounded-lg focus:ring-2 p-1.5  inline-flex h-8 w-8 drk:text-gray-500 drk:hover:text-white drk:bg-gray-800 drk:hover:bg-gray-700" data-dismiss-target="#toast-message-cta" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>

        </div>
    @endif
</div>
