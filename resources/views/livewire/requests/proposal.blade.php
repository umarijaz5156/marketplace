<section class="" >
    <div class="bg-[#F4FCFF]">
        <div class="container 2xl:max-w-screen-xl mx-auto px-4 h-full pt-14 lg:min-h-[20vh] relative">
            <div class="flex justify-between">
                <div>
                    <h1 class="text-[#263238] text-5xl font-bold">Proposals for Request #{{ $request->id }}</h1>
                    <p class="text-[#6A6A6A] text-lg font-medium mt-3">Current proposals for your request</p>
                </div>
                <div>

                </div>
            </div>

        </div>
    </div>
    <div class="container 2xl:max-w-screen-xl  mx-auto px-4 h-full mt-14">
        @if (session('success'))
        <x-alerts.success :success="session('success')" />
        @endif

        @if (session('error'))
        <x-alerts.error :error="session('error')" />
        @endif
        <div class="relative overflow-auto rounded p-6 transition-all duration-300 ease-in space-y-11" {{--
            x-bind:class="active == {{$active}} ? 'animate-[show-transition_0.5s_ease-in-out] block' : 'max-h-0 opacity-0 hidden'"
            --}}>
            <div>
                <div class="overflow-x-auto relative">
                    <table class="lg:w-full text-sm text-left text-gray-500 drk:text-gray-400">
                        <thead
                            class="text-sm border-b border-[#E2EAED] text-[#6A6A6A]  drk:bg-gray-700 drk:text-gray-400 ">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Seller
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    <div class="flex items-center">
                                        <button wire:click="sortBy('created_at')" type="button">Bid Time</button>

                                        <x-sort-icon field="created_at" :sortField="$sortField" :sortAsc="$sortAsc" />
                                    </div>

                                </th>
                                <th scope="col" class="py-3 px-6">
                                    <div class="flex items-center">
                                        <button wire:click="sortBy('price')" type="button">Price</button>

                                        <x-sort-icon field="price" :sortField="$sortField" :sortAsc="$sortAsc" />


                                    </div>

                                </th>

                                <th scope="col" class="py-3 px-3">
                                    <div class="flex items-center">
                                        <button wire:click="sortBy('duration')" type="button">Timeline</button>

                                        <x-sort-icon field="duration" :sortField="$sortField" :sortAsc="$sortAsc" />
                                    </div>
                                </th>

                                <th scope="col" class="py-3 px-6">
                                    Rating
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($proposals) > 0)
                            @foreach ($proposals as $proposal)

                            <tr class=" border-b border-[#E2EAED]  drk:bg-gray-800 drk:border-gray-700">
                                <th class="max-w-[40px] py-4 px-6 font-medium text-gray-900  drk:text-white">
                                    <h4 class="max-h-[20px]  text-[#263238] font-semibold text-sm ">
                                        <a class="hover:underline hover:text-blue-500"
                                            href="{{ route('view_profile', $proposal->seller?->seller_name) }}">{{
                                            $proposal->seller?->seller_name }}</a>
                                    </h4>

                                </th>

                                <td class="py-4 px-6">
                                    <h4 class="text-[#263238] font-semibold text-sm">
                                        {{ $proposal->created_at->diffForHumans() }}
                                    </h4>
                                </td>
                                <td class="py-4 px-6">
                                    <h4 class="text-[#263238] font-semibold text-sm">
                                        ${{ $proposal->price }}
                                    </h4>
                                </td>

                                <td class="py-4 px-6 ">
                                    <h4 class="text-[#263238] font-semibold text-sm">
                                        {{ $proposal->duration }} {{ $proposal->duration > 1 ? 'Days' : 'Day' }}
                                    </h4>
                                </td>
                                <td class="py-4 px-6">
                                    <h4 class="text-yellow-400 font-semibold text-sm">
                                        {{ number_format(round($proposal->seller->sellerStat?->reviews_average, 1), 1)
                                        }}

                                    </h4>
                                </td>
                                <td class="py-4 px-6">
                                    <button wire:click='openDetailsModal({{ $proposal->id }})' type="button"
                                        class="bg-[#0096D8] text-white text-sm rounded-full w-9 h-9 flex justify-center items-center">
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            {{ $proposals->links('vendor.livewire.custom-pagination') }}
                            @else
                            <td colspan="6"
                                class="text-[14px] text-center text-gray-400 font-medium py-4 px-6 rounded-tr-[18px] rounded-br-[18px]">
                                No Record Found
                            </td>

                            @endif


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if(isset($proposalDetails))
    <div x-data="{show: false}">
        <x-jet-dialog-modal maxWidth="2xl" wire:model="detailsModal" >
            <x-slot name="title">
                Proposal Details # {{ $proposalDetails->id }}
            </x-slot>

            <x-slot name="content">
                <div class="p-4 bg-gray-100 h-60 overflow-y-auto">
                    {{ $proposalDetails->proposal }}
                </div>
                <div >



                </div>
            </x-slot>


            <x-slot name="footer" >
                <div  >

                    <div class="flex gap-4">
                        <button type="button" wire:click='contact({{ $proposalDetails->id }})'
                            class=" text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800">
                            Contact</button>
                    </div>

                </div>


            </x-slot>

        </x-jet-dialog-modal>
    </div>

    @endif
</section>
