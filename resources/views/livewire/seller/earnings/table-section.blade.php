<div class="mb-12 container md:max-w-[900px] xl:max-w-[1450px] w-full  mx-auto" >

    <div class="p-4 sm:p-6 ">

         <div class="flex justify-between items-center mb-5">
        <h1 class="text-[22px] font-semibold">Earnings</h1>
        @if(count($orders) > 0)
        <div class="flex">

           <select id="statuses" wire:model="selectedFilter" class="w-[158px] bg-white border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block p-[12px]  drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
               <option value="" selected>All</option>
               @foreach($filters as $filter)
               @if($filter->value == App\Enums\OrderStatus::UnPaid->value)
                @continue
              @endif
                <option value="{{$filter->value}}">{{$filter->value}}</option>
               @endforeach
           </select>
        </div>

        @endif
      </div>
      @if(count($orders) > 0)
      <div>

        <div class="overflow-x-auto h-90  md:overflow-visible relative sm:rounded-lg">
          <table class="w-full text-sm text-left text-gray-500 drk:text-gray-400 border-separate border-spacing-y-3">
              <thead class="text-base text-[#707176] bg-[#F4F6FC] rounded-[18px] drk:bg-gray-700 drk:text-gray-400  ">
                  <tr class="">
                    <th scope="col" class="py-4 px-6  font-normal rounded-tl-[18px] rounded-bl-[18px] ">
                      <div class="flex items-center">
                          <button wire:click="sortBy('id')" type="button">Order#</button>
                            <x-sorting-icon
                                       field="id"
                                       :sortField="$sortBy"
                                       :sortDirection="$sortDirection"
                           />
                      </div>
                      </th>
                      <th scope="col" class="py-4 pl-16  font-normal ">
                        Service
                      </th>
                      <th scope="col" class="py-4 px-6 font-normal">
                        <div class="flex items-center">
                        <button wire:click="sortBy('created_at')" type="button">Date</button>
                            <x-sorting-icon
                                       field="created_at"
                                       :sortField="$sortBy"
                                       :sortDirection="$sortDirection"
                           />
                        </div>
                      </th>
                        <th scope="col" class="py-4 px-6 font-normal">
                          Total

                      </th>
                      <th scope="col" class="py-4 px-6 font-normal">
                        Status
                      </th>
                      <th scope="col" class="py-4 px-6 rounded-tr-[18px] rounded-br-[18px] font-normal">
                        <div class="flex items-center">
                        <button wire:click="sortBy('amount')" type="button">Earning</button>
                        <x-sorting-icon
                                   field="amount"
                                   :sortField="$sortBy"
                                   :sortDirection="$sortDirection"
                       />
                        </div>
                      </th>
                  </tr>
              </thead>
              <tbody>
                @if(count($orders) > 0)
                @foreach($orders as $order)
                  <tr class=" drk:bg-gray-800 drk:border-gray-700 hover:bg-gray-600rounded-[18px] drk:hover:bg-gray-600  overflow-hidden hover:scale-x-[1.02] transition-all duration-300" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                      <th scope="row" class="py-4 px-6 font-medium whitespace-nowrap drk:text-white rounded-tl-[18px] rounded-bl-[18px]">
                          <p class="mt-[10px] lg:mt-0">{{$order->id}}</p>
                      </th>
                      <td class="py-4 px-16">
                        @if($order->orderType == 'normal')
                        {{$order->title}}
                        @else
                        {{  \Illuminate\Support\Str::limit($order->offerTitle,  40, $end='...' ) }}
                        @endif
                    </td>
                      <td class="py-4 px-6">
                          {{$order->created_at->format('M d, Y')}}
                      </td>
                        <td class="py-4 px-6">
                          ${{$order->amount}}
                      </td>
                      <td class="py-4 px-6">
                         <span
                                class="{{$order->status == App\Enums\OrderStatus::Completed->value ? 'bg-green-200 text-green-600' :

                                    ($order->status == App\Enums\OrderStatus::Cancelled->value ? 'bg-red-200 text-red-600' :
                                    ($order->status == App\Enums\OrderStatus::InProgress->value ? 'bg-green-200 text-green-600' : ''

                                    )
                                    )

                                }}

                                py-1 px-3 rounded-full ">{{$order->status}}</span>

                      </td>
                    <td class="{{
                      ($order->status == App\Enums\OrderStatus::Cancelled->value ? 'bg-red-200 text-red-600' :
                       ($order->status == App\Enums\OrderStatus::Completed->value ? 'bg-green-200 text-green-600' : ''

                      )
                      ) }} py-4 px-6 ">
                        ${{$order->total}}
                          {{-- <a href="#" class="font-medium drk:text-blue-500 hover:underline">Edit</a> --}}
                      </td>
                  </tr>
                @endforeach
                @else
                <td class="py-4 px-6 text-center" colspan="5">
                    No Record Found
                </td>
                @endif
              </tbody>

          </table>
          {{$orders->links()}}
        </div>
      </div>
       @else
        <p class="bg-gray-100 p-5 mt-10 text-gray-500 text-lg text-center">No earnings yet</p>
     @endif
    </div>
   </div>
