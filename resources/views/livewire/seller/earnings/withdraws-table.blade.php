<div class="mb-12 container md:max-w-[900px] xl:max-w-[1450px] w-full  mx-auto" >

    <div class="p-4 sm:p-6 ">
         <div class="flex justify-between items-center mb-5">
        <h1 class="text-[22px] font-semibold">Withdraws</h1>
        @if(count($payouts) > 0)
        <div class="flex">

           <select id="limits" wire:model="limit" class="w-[158px] bg-white border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block p-[12px]  drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
               <option value="5" selected>5 items</option>
                <option value="10" >10 items</option>
                <option value="">All items</option>
           </select>
        </div>
        @endif
      </div>
      @if(count($payouts) > 0)
      <div>

        {{-- <div class="overflow-x-auto h-90  md:overflow-visible relative sm:rounded-lg">
          <table class="w-full text-sm text-left text-gray-500 drk:text-gray-400 border-separate border-spacing-y-3">
              <thead class="text-base text-[#707176] bg-[#F4F6FC] rounded-[18px] drk:bg-gray-700 drk:text-gray-400  ">
                  <tr class="">
                    <th scope="col" class="py-4 px-6  font-normal rounded-tl-[18px] rounded-bl-[18px] ">
                      <div class="flex items-center">
                          Amount
                      </div>
                      </th>
                      <th scope="col" class="py-4 pl-16  font-normal ">
                        Requested At
                      </th>
                      <th scope="col" class="py-4 px-6 font-normal">
                        Arrival Date(Expected)
                      </th>

                      <th scope="col" class="py-4 px-6 font-normal">
                        Status
                      </th>

                  </tr>
              </thead>
              <tbody>
                @if(count($payouts) > 0)
                @foreach($payouts as $payout)
                  <tr class=" drk:bg-gray-800 drk:border-gray-700 hover:bg-gray-600rounded-[18px] drk:hover:bg-gray-600  overflow-hidden hover:scale-x-[1.02] transition-all duration-300" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                      <th scope="row" class="py-4 px-6 font-medium whitespace-nowrap drk:text-white rounded-tl-[18px] rounded-bl-[18px]">
                          <p class="mt-[10px] lg:mt-0">${{self::stripeFormat($payout->amount)}}</p>
                      </th>
                      <td class="py-4 px-16">
                        {{date("M d, Y H:i" ,$payout->created)}}
                    </td>
                      <td class="py-4 px-6">
                          {{date("M d, Y H:i" ,$payout->arrival_date)}}
                      </td>
                        <td class="py-4 px-6">
                          {{$payout->status}}
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

        </div> --}}
          <div class="overflow-x-auto h-90  md:overflow-visible relative sm:rounded-lg">
          <table class="w-full text-sm text-left text-gray-500 drk:text-gray-400 border-separate border-spacing-y-3">
              <thead class="text-base text-[#707176] bg-[#F4F6FC] rounded-[18px] drk:bg-gray-700 drk:text-gray-400  ">
                  <tr class="">
                    <th scope="col" class="py-4 px-6  font-normal rounded-tl-[18px] rounded-bl-[18px] ">
                      <div class="flex items-center">
                          Amount
                      </div>
                      </th>
                      <th scope="col" class="py-4 pl-16  font-normal ">
                        Order #
                      </th>
                      <th scope="col" class="py-4 px-6 font-normal">
                        Date
                      </th>

                      <th scope="col" class="py-4 px-6 font-normal">
                        Status
                      </th>

                  </tr>
              </thead>
              <tbody>
                @if(count($payouts) > 0)
                @foreach($payouts as $payout)
                  <tr class=" drk:bg-gray-800 drk:border-gray-700 hover:bg-gray-600rounded-[18px] drk:hover:bg-gray-600  overflow-hidden hover:scale-x-[1.02] transition-all duration-300" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                      <th scope="row" class="py-4 px-6 font-medium whitespace-nowrap drk:text-white rounded-tl-[18px] rounded-bl-[18px]">
                          <p class="mt-[10px] lg:mt-0">${{$this->stripeFormat($payout->amount)}}</p>
                      </th>
                      <td class="py-4 px-16">
                        {{$payout->order_id}}
                    </td>
                      <td class="py-4 px-6">
                          {{date("M d, Y H:i" ,$payout->create_at)}}
                      </td>
                      <td class="py-4 px-6">
                          Paid
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
          {{-- {{$orders->links()}} --}}
        </div>
      </div>
      @else
      <p class="bg-gray-100 p-5 mt-10 text-gray-500 text-lg text-center">No withdrawls yet</p>
      @endif
    </div>
   </div>
