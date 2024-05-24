<section class="" x-data="{ active: @entangle('active') }">
    <div class="bg-[#F4FCFF]">
        <div class="container 2xl:max-w-screen-xl mx-auto px-4 h-full pt-14 lg:min-h-[20vh] relative">
            <div class="flex justify-between">
                <div>
                    <h1 class="text-[#263238] text-5xl font-bold">Current Requests</h1>
                    <p class="text-[#6A6A6A] text-lg font-medium mt-3">Current requests posted by buyers</p>
                </div>
                <div>
                    <select wire:model="filterCategory" class="w-[158px] bg-white border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block p-[12px]  drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                      <option selected value="{{ null }}">All</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @if (count($category->childCategories) > 0)
                                @foreach ($category->childCategories as $child)
                                    <option value="{{ $child->id }}">--{{ $child->name }}</option>
                                @endforeach
                            @endif
                        @endforeach
                    </select>
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
                            class="text-sm border-b border-[#E2EAED] text-[#6A6A6A] uppercase drk:bg-gray-700 drk:text-gray-400 ">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Requirement

                                </th>
                                <th scope="col" class="py-3 px-6">
                                    <div class="flex items-center">
                                        <button wire:click="sortBy('created_at')" type="button">Date</button>

                                        <x-sort-icon field="created_at" :sortField="$sortField"
                                            :sortAsc="$sortAsc" />
                                    </div>

                                </th>
                                <th scope="col" class="py-3 px-6">
                                    <div class="flex items-center">
                                        <button type="button">Budget</button>


                                    </div>

                                </th>
                                <th scope="col" class="py-3 px-6">
                                    <div class="flex items-center">
                                        <button wire:click="sortBy('duration')" type="button">Duration</button>

                                        <x-sort-icon field="duration" :sortField="$sortField"
                                            :sortAsc="$sortAsc" />
                                    </div>

                                </th>


                                <th scope="col" class="py-3 px-6">
                                    Bids
                                </th>
                                <th scope="col" class="py-3 px-6">

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($requests) > 0)
                            @foreach ($requests as $request)

                            <tr class=" border-b border-[#E2EAED]  drk:bg-gray-800 drk:border-gray-700">
                                <th class="max-w-[40px] py-4 px-6 font-medium text-gray-900  drk:text-white">
                                    <a href="{{ route('requests.details', $request->id) }}" title="{{ $request->requirements }}" class="cursor-pointer max-h-[20px]  text-[#263238] font-semibold text-sm text-ellipsis overflow-hidden">
                                           {{  \Illuminate\Support\Str::limit( $request->requirements ,  40, $end='...' ) }}
                                    </h4>

                                </th>

                                <td class="py-4 px-6">
                                    <h4 class="text-[#263238] font-semibold text-sm">
                                        {{ $request->created_at->diffForHumans() }}
                                    </h4>
                                </td>
                                <td class="py-4 px-6">
                                    <h4 class="text-[#263238] font-semibold text-sm">
                                        ${{ $request->min_budget}} - ${{ $request->max_budget }}
                                    </h4>
                                </td>
                                <td class="py-4 px-6">
                                    <h4 class="text-[#263238] font-semibold text-sm">
                                        {{ $request->duration}} Days
                                    </h4>
                                </td>
                                <td class="py-4 px-6">
                                    <p class="">{{ $request->proposals?->count() }}</p>
                                </td>
                                <td class="py-4 px-6">
                                    <a href="{{ route('requests.details', $request->id) }}"
                                        class="bg-[#0096D8] text-white text-sm rounded-full w-9 h-9 flex justify-center items-center">
                                        <i class="fa-solid fa-arrow-right"></i>
                                </a>
                                </td>
                            </tr>
                            @endforeach
                            {{ $requests->links('vendor.livewire.custom-pagination') }}
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


</section>
