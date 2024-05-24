<section class="" x-data="{ active: @entangle('active') }">
    <div class="bg-[#F4FCFF]">
        <div class="container 2xl:max-w-screen-xl mx-auto px-4 h-full pt-14 lg:min-h-[30vh] relative">
            <div>
                <div>
                    <h1 class="text-[#263238] text-5xl font-bold">Manage Orders</h1>
                    <p class="text-[#6A6A6A] text-lg font-medium mt-3">Current orders for your business</p>
                </div>
            </div>
            <div class="h-full">
                <div class="mt-24">
                    <div class="max-w-2xl w-full">
                        <div class=" flex justify-start items-center gap-6 sm:gap-0 flex-wrap sm:flex-nowrap">
                            @foreach ($statusFilters as $filter)
                                @if ($filter->value == App\Enums\OrderStatus::UnPaid->value)
                                    @continue
                                @endif
                                <button class="px-4 py-1 hover:text-[#0096D8] font-semibold w-max h-[50px]"
                                    @click="active = {{ $loop->index }}"
                                    wire:click="changeStatus('{{$filter->value}}',{{$loop->index}})"
                                    x-bind:class="active == {{ $loop->index }} ?
                                        'text-[#0096D8] animate-[press_0.2s_linear] border-b-2 border-[#0096D8]' : ' '">
                                    {{ $filter->value }}
                                </button>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container 2xl:max-w-screen-xl  mx-auto px-4 h-full mt-14">
        <div class="relative overflow-auto rounded p-6 transition-all duration-300 ease-in space-y-11"
            x-bind:class="active == {{$active}} ? 'animate-[show-transition_0.5s_ease-in-out] block' : 'max-h-0 opacity-0 hidden'">
            <div>
                <div class="overflow-x-auto relative">
                    <table class="lg:w-full text-sm text-left text-gray-500 drk:text-gray-400">
                        <thead
                            class="text-sm border-b border-[#E2EAED] text-[#6A6A6A] uppercase drk:bg-gray-700 drk:text-gray-400 ">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Service

                                </th>
                                <th scope="col" class="py-3 px-6">
                                    <div class="flex items-center">
                                        <button wire:click="sortBy('orderCreatedAt')" type="button">Order Date</button>
                                        <x-sort-icon field="orderCreatedAt" :sortField="$sortField" :sortAsc="$sortAsc" />
                                    </div>

                                </th>
                                <th scope="col" class="py-3 px-6">
                                    <div class="flex items-center">
                                        <button wire:click="sortBy('deliveryTime')" type="button">Due On</button>
                                        <x-sort-icon field="deliveryTime" :sortField="$sortField" :sortAsc="$sortAsc" />
                                    </div>

                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Total
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Status
                                </th>
                                <th scope="col" class="py-3 px-6">

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($orders) > 0)
                                @foreach ($orders as $order)
                                @php
                                    $ext = substr(strrchr($order->imagePath, '.'), 1);
                                @endphp
                                    <tr class=" border-b border-[#E2EAED]  drk:bg-gray-800 drk:border-gray-700">
                                        <th class="py-4 px-6 font-medium text-gray-900  drk:text-white">
                                            @if($order->orderType == 'normal')
                                            <div class="flex justify-start items-center gap-3 w-max">
                                                @if($ext == 'mp4')
                                                <video height="56px" width="72px" src="{{asset('/gigs/images/'.$order->imagePath) }}"></video>
                                                @else
                                                <img  src="{{asset('/gigs/images/'.$order->imagePath) }}" class="h-14 rounded-[4px] " width="72px"  alt="">
                                                @endif
                                                <h4 class="text-[#263238] font-semibold text-sm">{{ $order->gigTitle }}
                                                </h4>
                                            </div>
                                            @else         <h4 class="text-[#263238] font-semibold text-sm">
                                                {{  \Illuminate\Support\Str::limit($order->offerTitle,  40, $end='...' ) }}

                                            </h4>


                                            @endif
                                        </th>

                                        <td class="py-4 px-6">
                                            <h4 class="text-[#263238] font-semibold text-sm">
                                                {{ $this->convertDate($order->orderCreatedAt)->format('M, d Y') }}
                                            </h4>
                                        </td>
                                        <td class="py-4 px-6">
                                            <h4 class="text-[#263238] font-semibold text-sm">
                                                {{ $order->deliveryTime ? $this->convertDate($order->deliveryTime)->format('M, d Y') : '--' }}
                                            </h4>
                                        </td>
                                        <td class="py-4 px-6">
                                            <h4 class="text-[#263238] font-semibold text-sm">
                                                ${{ $order->orderAmount }}
                </div>
                </td>
                <td class="py-4 px-6 ">

                    <span
                        class="{{ $order->orderStatus == App\Enums\OrderStatus::InProgress->value
                            ? 'bg-purple-200 text-purple-600'
                            : ($order->orderStatus == App\Enums\OrderStatus::Pending->value
                                ? 'bg-red-200 text-red-600'
                                : ($order->orderStatus == App\Enums\OrderStatus::Cancelled->value
                                    ? 'bg-red-200 text-red-600'
                                    : ($order->orderStatus == App\Enums\OrderStatus::Disputed->value
                                        ? 'bg-red-200 text-red-600'
                                        : ($order->orderStatus == App\Enums\OrderStatus::Delivered->value
                                            ? 'bg-yellow-200 text-yellow-600'
                                            : ($order->orderStatus == App\Enums\OrderStatus::Completed->value
                                                ? 'bg-green-200 text-green-600'
                                                : ''))))) }}

              font-semibold text-sm px-6 py-2 rounded">{{ $order->orderStatus }}</span>
                </td>

                <td class="py-4 px-6">
                    <a href="{{ route('buyerorder_details', ['id' => $order->order_id]) }}"
                        class="bg-[#0096D8] text-white text-sm rounded-full w-9 h-9 flex justify-center items-center">
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </td>
                </tr>
                @endforeach
                {{ $orders->links('vendor.livewire.custom-pagination') }}
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
