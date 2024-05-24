<div class="mt-12">
    @if (session()->has('message'))

    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"  id="alert-border-3" class=" flex p-4 mb-4 bg-green-100 border-t-4 border-green-500 drk:bg-green-200" role="alert">
        <svg class="flex-shrink-0 w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <div class="ml-3 text-sm font-medium text-green-700">
            {{ session('message') }} See <a href="{{route('order_details', ['id' => session('messageLink')])}}" class="font-semibold underline hover:text-green-800">Order details</a>.
        </div>

    </div>

    @endif

    <h4 class="font-[600] text-xl">Orders</h4>

    <div  class="">
        <ul  class="scroll-custom scroll-smooth  m-[2rem_0_2.5rem] bg-white py-[0.375rem] px-4 rounded-full flex text-sm font-medium text-center overflow-x-scroll" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
            <li class="mr-2 flex justify-center items-center w-full" role="presentation">
                <button wire:click="statusFilter(0)" class="inline-block p-4 rounded-t-lg border-b-2 text-[15px]" id="All-tab" data-tabs-target="#All" type="button" role="tab" aria-controls="All" aria-selected="false">All</button>
            </li>
            @foreach ($statusFilters as $filter)
                @if($filter->value == App\Enums\OrderStatus::UnPaid->value)
                    @continue
                @endif
                <li class="mr-2 flex justify-center items-center w-full" role="presentation">
                    <button wire:click="statusFilter('{{$filter->value}}')" class="inline-block p-4 rounded-t-lg border-b-2 text-[15px]" id="{{$filter->value}}" data-tabs-target="#All" type="button" role="tab" aria-controls="{{$filter->value}}" aria-selected="false">{{$filter->value}}</button>
                </li>
            @endforeach

        </ul>
    </div>

    @if(\Request::route()->getName() != 'seller-dashboard')
    <div class="">
        <label class="">Show Items</label>
        <select wire:model="limit" id="statuses" class="w-[158px] bg-white border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block p-[12px]  drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">

            <option value="5">5</option>
            <option value="10"selected>10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            {{-- @foreach ($statusFilters as $filter)


            @endforeach --}}
        </select>
     </div>
     @endif
     @if(count($orders) > 0)
    <div class="">
        <div id="myTabContent" >
            <div  class="rounded-lg drk:bg-gray-800 " id="All" role="tabpanel" aria-labelledby="{{$filter->value}}">
                <table wire:ignore.self class="table table-hover dt-responsive order__table dasboard-table" id="attachmentTable">
                    <thead>
                      <tr>
                        <th>Service</th>
                        <th>Order By</th>
                        <th> <div class="flex items-center">
                            <button wire:click="sortBy('created_at')" type="button">Order Date</button>
                            <x-sorting-icon
                                       field="created_at"
                                       :sortField="$sortBy"
                                       :sortDirection="$sortDirection"
                           />
                        </div></th>
                        <th>
                            <div class="flex items-center">
                                <button wire:click="sortBy('deliveryTime')" type="button">Order Due</button>
                                <x-sorting-icon
                                           field="deliveryTime"
                                           :sortField="$sortBy"
                                           :sortDirection="$sortDirection"
                               />
                            </div>
                        </th>
                        <th><div class="flex items-center">
                            <button wire:click="sortBy('orderAmount')" type="button">Total</button>
                            <x-sorting-icon
                                       field="orderAmount"
                                       :sortField="$sortBy"
                                       :sortDirection="$sortDirection"
                           />
                        </div></th>
                        <th>Status</th>
                        {{-- <th>Action</th> --}}
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($orders as $order)
                    @php
                          $ext = substr(strrchr($order->imagePath, '.'), 1);
                    @endphp

                        <tr wire:click="redirectTo({{$order->order_id}})" class="cursor-pointer border-row" >

                            <td>
                                @if($order->orderType == 'normal')
                                <div class="flex flex-col md:flex-row md:items-center gap-x-5">
                                    @if($ext == 'mp4')
                                    <video height="56px" width="70px" src="{{asset('/gigs/images/'.$order->imagePath) }}"></video>
                                    @else
                                    <img  src="{{asset('/gigs/images/'.$order->imagePath) }}" class="h-14 rounded-[4px] " width="70px"  alt="">
                                    @endif
                                    <p class="mt-[10px] lg:mt-0">{{$order->gigTitle}}</p>
                                </div>
                                @else
                                <p class="mt-[10px] lg:mt-0"> {{  \Illuminate\Support\Str::limit($order->offerTitle,  40, $end='...' ) }}</p>
                                @endif
                            </td>
                            <td class="customers__info">
                                {{$order->user_name}}
                            <td>
                                {{$this->convertDate($order->created_at)->format('M, d Y')}}
                            </td>
                            <td>

                                 {{$order->deliveryTime ? $this->convertDate($order->deliveryTime)->format('M, d Y') : "--"}}
                            </td>
                            <td>$<span>
                                {{$order->orderAmount}}
                            </span></td>
                            <td class="pending-table-orders last-child" >
                                <span
                                class="{{$order->orderStatus == App\Enums\OrderStatus::InProgress->value ? 'bg-purple-200 text-purple-600' :
                                    ($order->orderStatus == App\Enums\OrderStatus::Pending->value ? 'bg-red-200 text-red-600' :
                                    ($order->orderStatus == App\Enums\OrderStatus::Delivered->value ? 'bg-yellow-200 text-yellow-600' :
                                    ($order->orderStatus == App\Enums\OrderStatus::Completed->value ? 'bg-green-200 text-green-600' :
                                    ''
                                    ) )
                                    )
                                }}
                                py-1 px-3 rounded-full ">{{$order->orderStatus}}</span>
                            </td>
                            {{-- <td class="last-child">
                           <div class="gear-icon">

                                <button id="dropdownUserAvatarButton.{{$order->order_id}}" data-dropdown-toggle="dropdownAvatar.{{$order->order_id}}"
                                    class=""
                                    type="button">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="w-8 h-8 rounded-full" src="{{ asset('images/Layer 72.png') }}" alt="user photo">
                                </button>


                                <div id="dropdownAvatar.{{$order->order_id}}"
                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow drk:bg-gray-700 drk:divide-gray-600">

                                    <ul class="py-1 text-sm text-gray-700 drk:text-gray-200" aria-labelledby="dropdownUserAvatarButton.{{$order->order_id}}">

                                        @if($order->orderStatus === App\Enums\OrderStatus::Pending->value)

                                            <li>
                                                <a wire:click="acceptOrder({{$order->order_id}})"
                                                    class="cursor-pointer block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">Accept</a>
                                            </li>
                                        @endif

                                        <li>
                                            <a href="#"
                                                class="cursor-pointer block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">
                                                Details</a>
                                        </li>

                                    </ul>

                                </div>
                            </div>
                            </td> --}}

                        </tr>

                    @endforeach


                    </tbody>
                </table>
            </div>
            {{$orders->links('vendor.livewire.custom-pagination')}}
        </div>
    </div>
    @else
        <p class="bg-gray-100 p-5 mt-10 text-gray-500 text-lg text-center">No Orders Found</p>
    @endif
</div>

