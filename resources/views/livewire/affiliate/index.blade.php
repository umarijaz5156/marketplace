<section class="" x-data="{ active: @entangle('active') }">
    <div class="bg-[#F4FCFF]">
        <div class="container 2xl:max-w-screen-xl mx-auto px-4 h-full pt-14 lg:min-h-[30vh] relative">
            <div class="flex justify-between">
                <div>
                    <h1 class="text-[#263238] text-5xl font-bold">Affiliate Portal</h1>
                    <p class="text-[#6A6A6A] text-lg font-medium mt-3">Current users with your affiliate link</p>
                </div>
                <div class="flex justify-end gap-2 md:flex-row flex-col">
                    <div class="p-[14px] flex justify-start items-center bg-white w-full sm:max-w-[310px] rounded-3xl h-[134px] mb-5 xl:mb-0">
                        <img width="50px" height="50px" src="{{ asset('images/user-group.png') }}" alt="">
                        <div class="ml-[21px]">
                            <h5 class="2xl:text-2xl xl:text-[20px] text-2xl">
                               {{ count($users) }}
                            </h5>
                            <p>Total Users</p>
                        </div>
                    </div>
                    <div class="p-[14px] flex justify-start items-center bg-white w-full sm:max-w-[310px] rounded-3xl h-[134px] mb-5 xl:mb-0">
                        <img width="80px" height="80px" src="{{ asset('images/box-icons-main/Group 1.png') }}" alt="">
                        <div class="ml-[21px]">
                            <h5 class="2xl:text-2xl xl:text-[20px] text-2xl">
                              $ {{ $users->sum('commission') ?? 0}}
                            </h5>
                            <p>Total Commission</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="h-full">
                <div class="mt-24">
                    <div class="max-w-2xl">
                        <div class="flex justify-start items-center gap-6 sm:gap-0 flex-wrap sm:flex-nowrap">

                            <button
                                class="{{ $active == 0 ? 'text-[#0096D8] animate-[press_0.2s_linear] border-b-2 border-[#0096D8]'  : ''}} px-4 py-1 hover:text-[#0096D8] font-semibold w-max h-[50px]"
                                wire:click="$set('active', 0)">

                                Affiliate Users
                            </button>

                            <button
                                class="{{ $active == 1 ? 'text-[#0096D8] animate-[press_0.2s_linear] border-b-2 border-[#0096D8]'  : ''}}  px-4 py-1 hover:text-[#0096D8] font-semibold w-max h-[50px]"
                                wire:click="$set('active', 1)"
                                x-bind:class="active == 1 ?
                                        'text-[#0096D8] animate-[press_0.2s_linear] border-b-2 border-[#0096D8]' : ' '">
                                Affiliate Commissions
                            </button>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container 2xl:max-w-screen-xl  mx-auto px-4 h-full mt-14">
        <div
            class=" {{ $active == 0 ? 'animate-[show-transition_0.5s_ease-in-out] block' : 'max-h-0 opacity-0 hidden'  }} relative overflow-auto rounded p-6 transition-all duration-300 ease-in space-y-11">
            <div>
                <div class="overflow-x-auto relative">
                    <table class="lg:w-full text-sm text-left text-gray-500 drk:text-gray-400">
                        <thead
                            class="text-sm border-b border-[#E2EAED] text-[#6A6A6A] uppercase drk:bg-gray-700 drk:text-gray-400 ">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Name

                                </th>
                                <th scope="col" class="py-3 px-6">
                                    <div class="flex items-center">
                                        Email

                                    </div>

                                </th>
                                <th scope="col" class="py-3 px-6">
                                    <div class="flex items-center">
                                        Commission
                                    </div>

                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Joined Date
                                </th>
                                {{-- <th scope="col" class="py-3 px-6">
                                    Status
                                </th> --}}

                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($users as $user)

                            <tr class=" border-b border-[#E2EAED]  drk:bg-gray-800 drk:border-gray-700">
                                <th class="py-4 px-6 font-medium text-gray-900  drk:text-white">
                                    <div class="">

                                        <h4 class="text-[#263238] font-semibold text-sm">{{ $user->name }}
                                        </h4>
                                    </div>
                                </th>

                                <td class="py-4 px-6">
                                    <h4 class="text-[#263238] font-semibold text-sm">
                                        {{ $user->email }}
                                    </h4>
                                </td>
                                <td class="py-4 px-6">
                                    <h4 class="text-[#263238] font-semibold text-sm">
                                        ${{ $user->commission }}
                                    </h4>
                                </td>
                                <td class="py-4 px-6">
                                    <h4 class="text-[#263238] font-semibold text-sm">
                                        {{ $user->created_at->format('Y-m-d')}}
                                    </h4>

                                </td>
                                {{-- <td class="py-4 px-6">
                                    <h4 class="text-[#263238] font-semibold text-sm">
                                        <span
                                            class=" font-semibold text-sm px-6 py-2 rounded {{ $user->status == 'Pending' ?'bg-red-200 text-red-600' : 'bg-green-200 text-green-600' }}">
                                            {{ $user->status }}</span>
                                    </h4>

                                </td> --}}

                            </tr>
                            @empty
                            <td colspan="6"
                                class="text-[14px] text-center text-gray-400 font-medium py-4 px-6 rounded-tr-[18px] rounded-br-[18px]">
                                No Record Found
                            </td>
                            @endforelse
                            {{ $users->links('vendor.livewire.custom-pagination') }}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div
            class=" {{ $active == 1 ? 'animate-[show-transition_0.5s_ease-in-out] block' : 'max-h-0 opacity-0 hidden'  }} relative overflow-auto rounded p-6 transition-all duration-300 ease-in space-y-11">
            <div>
                <div class="overflow-x-auto relative">
                    <table class="lg:w-full text-sm text-left text-gray-500 drk:text-gray-400">
                        <thead
                            class="text-sm border-b border-[#E2EAED] text-[#6A6A6A] uppercase drk:bg-gray-700 drk:text-gray-400 ">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Name

                                </th>
                                <th scope="col" class="py-3 px-6">
                                    <div class="flex items-center">
                                        Email

                                    </div>

                                </th>
                                <th scope="col" class="py-3 px-6">
                                    <div class="flex items-center">
                                        Commission
                                    </div>

                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Joined Date
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Status
                                </th>

                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($users as $user)

                            <tr class=" border-b border-[#E2EAED]  drk:bg-gray-800 drk:border-gray-700">
                                <th class="py-4 px-6 font-medium text-gray-900  drk:text-white">
                                    <div class="">

                                        <h4 class="text-[#263238] font-semibold text-sm">{{ $user->name }}
                                        </h4>
                                    </div>
                                </th>

                                <td class="py-4 px-6">
                                    <h4 class="text-[#263238] font-semibold text-sm">
                                        {{ $user->email }}
                                    </h4>
                                </td>
                                <td class="py-4 px-6">
                                    <h4 class="text-[#263238] font-semibold text-sm">
                                        ${{ $user->commission }}
                                    </h4>
                                </td>
                                <td class="py-4 px-6">
                                    <h4 class="text-[#263238] font-semibold text-sm">
                                        {{ $user->created_at->format('Y-m-d')}}
                                    </h4>

                                </td>
                                <td class="py-4 px-6">
                                    <h4 class="text-[#263238] font-semibold text-sm">
                                        <span
                                            class=" font-semibold text-sm px-6 py-2 rounded {{ $user->status == 'Pending' ?'bg-red-200 text-red-600' : 'bg-green-200 text-green-600' }}">
                                            {{ $user->status }}</span>
                                    </h4>

                                </td>

                            </tr>
                            @empty
                            <td colspan="6"
                                class="text-[14px] text-center text-gray-400 font-medium py-4 px-6 rounded-tr-[18px] rounded-br-[18px]">
                                No Record Found
                            </td>
                            @endforelse
                            {{ $users->links('vendor.livewire.custom-pagination') }}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
