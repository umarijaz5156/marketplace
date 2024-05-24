<div>


    <div class="mt-[18px]">
        <div class="container md:max-w-[900px] xl:max-w-[1450px] w-full mx-auto" >
          <div class="md:p-4 sm:p-0 ">

            <div class="flex justify-between items-center mb-9">
              <h1 class="text-[22px] font-semibold">Active Requests</h1>
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
            <div>
              <div class="overflow-x-auto md:overflow-visible relative sm:rounded-lg">
                @if (session('success'))
                <x-alerts.success :success="session('success')" />
                @endif

                @if (session('error'))
                <x-alerts.error :error="session('error')" />
                @endif
                <table class="w-full text-sm text-left text-gray-500 drk:text-gray-400 border-separate border-spacing-y-3">
                    <thead class="text-base text-[#707176] bg-[#F4F6FC] rounded-[18px] drk:bg-gray-700 drk:text-gray-400  ">
                        <tr class="">

                            <th scope="col" class="py-6 px-6 font-normal ">
                              Request
                            </th>
                            <th scope="col" class="py-6 px-6 font-normal">
                              Category
                            </th>
                            <th scope="col" class="py-6 px-6 font-normal">
                              Posted At
                            </th>
                            <th scope="col" class="py-6 px-6 font-normal">
                              Budget
                            </th>
                            <th scope="col" class="py-6 px-6 font-normal">
                              Bids
                            </th>
                            <th scope="col" class="py-6 px-6 rounded-tr-[18px] rounded-br-[18px] font-normal">

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                       @if(count($requests) >0)
                        @foreach ($requests as $request)
                            <tr class=" drk:bg-gray-800 drk:border-gray-700  rounded-[18px] drk:hover:bg-gray-600" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">

                                <th  class="max-w-[40px]  py-4  px-6 font-medium  drk:text-white ">
                                    <a href="{{ route('requests.details', $request->id) }}" class=" max-h-[20px]  ml-1 mt-[10px] lg:mt-0 text-ellipsis overflow-hidden ...">         {{  \Illuminate\Support\Str::limit( $request->requirements ,  40, $end='...' ) }}</a>
                                </th>
                                <td class="py-4 px-6">
                                 {{ $request->category?->name }}
                                </td>

                                <td class="py-4 px-6">
                                    {{ $request->created_at->diffForHumans() }}
                                </td>
                                <td class="py-4 px-6">
                                    ${{ $request->min_budget }} - ${{ $request->max_budget }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ count($request->proposals) }}

                                </td>
                                <td class="py-4 px-6 rounded-tr-[18px] rounded-br-[18px]">
                                    @if($request->proposals?->where('seller_id', auth()->user()->seller->id)->count() > 0)
                                       <a href="{{ route('seller.requests.details', $request->id)  }}" class="text-lg">
                                        <i class="fas fa-eye text-green-500 text-lg"></i>
                                       </a>
                                    @else
                                    <a href="{{ route('seller.requests.details', $request->id) }}" class="bg-blue-500 px-2 hover:bg-blue-800 rounded-full text-white font-medium drk:text-blue-500 ">Bid</a>
                                    @endif
                                  </td>

                            </tr>
                        @endforeach
                       {{$requests->links() }}
                       @else
                        <td colspan="6" class="text-[14px] text-center text-gray-400 font-medium py-4 px-6 rounded-tr-[18px] rounded-br-[18px]">
                                No Record Found
                        </td>
                       @endif
                    </tbody>
                </table>
              </div>

            </div>

          </div>
         </div>
       </div>


    </div>
