<div>

    <x-message-area-notification />


    {{-- gigs table --}}

    <div class="mt-[18px]">
        <div class="container md:max-w-[900px] xl:max-w-[1450px] w-full mx-auto" >
          <div class="md:p-4 sm:p-0 ">
            @if(count($gigs) > 0)
            <div class="flex justify-between items-center mb-9">
              <h1 class="text-[22px] font-semibold">Active Services</h1>
              <div>
                <select wire:model="filterDate" class="w-[158px] bg-white border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block p-[12px]  drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                  <option selected value="0">All</option>
                  <option value="1">Last Day</option>
                  <option value="2">Last Week</option>
                  <option value="3">Last Month</option>
                  <option value="4">Last Year</option>
                </select>
              </div>
            </div>
            <div>
              <div class="overflow-x-auto md:overflow-visible relative sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 drk:text-gray-400 border-separate border-spacing-y-3">
                    <thead class="text-base text-[#707176] bg-[#F4F6FC] rounded-[18px] drk:bg-gray-700 drk:text-gray-400  ">
                        <tr class="">
                            {{-- <th scope="col" class="p-6 rounded-tl-[18px] rounded-bl-[18px]">
                                <div class="flex items-center">
                                    <input id="checkbox-all" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 drk:focus:ring-blue-600 drk:ring-offset-gray-800 focus:ring-2 drk:bg-gray-700 drk:border-gray-600">
                                    <label for="checkbox-all" class="sr-only">checkbox</label>
                                </div>
                            </th> --}}
                            <th scope="col" class="py-6 px-6 font-normal ">
                              Service
                            </th>
                            <th scope="col" class="py-6 px-6 font-normal">
                              Impressions
                            </th>
                            <th scope="col" class="py-6 px-6 font-normal">
                              Clicks
                            </th>
                            <th scope="col" class="py-6 px-6 font-normal">
                              Orders
                            </th>
                            <th scope="col" class="py-6 px-6 font-normal">
                              Cancellations
                            </th>
                            <th scope="col" class="py-6 px-6 rounded-tr-[18px] rounded-br-[18px] font-normal">
                              Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                       @if(count($gigs) >0)
                        @foreach ($gigs as $gig)
                            <tr class=" drk:bg-gray-800 drk:border-gray-700 hover:bg-[#3957CF] rounded-[18px] drk:hover:bg-gray-600 hover:text-white overflow-hidden hover:scale-x-[1.02] transition-all duration-300" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                                {{-- <td class="p-4 w-4 rounded-tl-[18px] rounded-bl-[18px]">
                                    <div class="flex items-center">
                                        <input id="checkbox-table-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 drk:focus:ring-blue-600 drk:ring-offset-gray-800 focus:ring-2 drk:bg-gray-700 drk:border-gray-600">
                                        <label for="checkbox-table-1" class="sr-only">checkbox</label>
                                    </div>
                                </td> --}}
                                <th scope="row" class="py-4 px-6 font-medium  drk:text-white ">

                                    <div class="md:flex  items-center">
                                      @if($gig->mainImage?->mime_type == 'mp4')
                                      <video src="{{asset('/gigs/images/'.$gig->mainImage->image_path) }}" width="60px" height="64px" class="rounded-[4px]"></video>
                                      @elseif($gig->mainImage)
                                      <img src="{{asset('/gigs/images/'.$gig->mainImage->image_path) }}" width="60px"  alt="gig" class="h-16 rounded-[4px] ">
                                      @endif

                                      <p class="ml-1 mt-[10px] lg:mt-0  text-ellipsis overflow-hidden ...">{{ $gig->gigDetail->title }}</p>
                                    </div>

                                </th>
                                <td class="py-4 px-6">
                                    0
                                </td>
                                <td class="py-4 px-6">
                                    0
                                </td>
                                <td class="py-4 px-6">
                                    {{ $gig->gigStat->order_count ?? 0}}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $gig->gigStat->order_cancelled ?? 0 }}
                                </td>
                                <td class="py-4 px-6">
                                  <span class="{{ $gig->is_approved ? 'bg-green-200 text-green-600' : 'bg-red-200 text-red-600' }}        py-1 px-3 rounded-full ">
                                    {{$gig->is_approved ? 'Approved' : 'Pending'}}
                                  </span>

                                </td>
                                <td class="py-4 px-6">
                                    <a href="{{ route('edit-gig' ,['id' => $gig->id]) }}" class="font-medium drk:text-blue-500 hover:underline">Edit</a>
                                </td>
                                <td class="py-4 px-6">
                                    <a  wire:click="pauseGigModal({{ $gig->id }})" class="cursor-pointer font-medium drk:text-red-500 hover:underline">{{ $gig->is_active ? 'Pause' : 'Unpause'}}</a>
                                </td>
                                <td class="py-4 px-6 rounded-tr-[18px] rounded-br-[18px]">
                                  <a href="{{ route('gig_details' ,['slug' => $gig->gigDetail->slug]) }}" class="font-medium drk:text-blue-500 hover:underline">Preview</a>
                                </td>
                            </tr>
                        @endforeach
                       {{$gigs->links() }}
                       @else
                        <td colspan="6" class="text-[14px] text-center text-gray-400 font-medium py-4 px-6 rounded-tr-[18px] rounded-br-[18px]">
                                No Record Found
                        </td>
                       @endif
                    </tbody>
                </table>
              </div>
              <div class="text-center mt-12">
                <a href="{{ route('create_gig') }}">
                    <button  type="button" class="inline-block w-[211px] h-[60px] m-auto bg-gradient-to-t from-[rgba(38,70,196,1)] to-[rgba(57,89,214,1)] text-white font-medium text-sm leading-tight rounded-full focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Create a New Service</button>
                </a>
              </div>
            </div>
            @else
            <p class="bg-gray-100 p-5 mt-10 text-gray-500 text-lg text-center">You have not added any services yet</p>
            <div class="text-center mt-12">
              <a href="{{ route('create_gig')}}">
                  <button  type="button" class="inline-block w-[211px] h-[60px] m-auto bg-gradient-to-t from-[rgba(38,70,196,1)] to-[rgba(57,89,214,1)] text-white font-medium text-sm leading-tight rounded-full focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Create a New Service</button>
              </a>
            </div>
            @endif
          </div>
         </div>
       </div>

       {{-- confirm delete modal --}}
    <x-jet-confirmation-modal  wire:model="confirmingItemDelete">
      <x-slot name="title">
          Delete Service
      </x-slot>
      <x-slot name="content">
        <div class="p-6 text-center">

          <h3 class="mb-5 text-lg font-normal text-gray-500 drk:text-gray-400">Are you sure you want to delete
              this Service?</h3>
          </div>

      </x-slot>


      <x-slot name="footer">
          <button wire:click.prevent="deleteGig()"  type="button"
              class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
              Yes, I'm sure
          </button>
          <button  wire:click="closeDeleteModal()" type="button"
              class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 drk:bg-gray-700 drk:text-gray-300 drk:border-gray-500 drk:hover:text-white drk:hover:bg-gray-600 drk:focus:ring-gray-600">No,
              cancel</button>
      </x-slot>
    </x-jet-confirmation-modal>
    @if($confirmingItemPause)
    {{-- confirm pause modal --}}
    <x-jet-confirmation-modal  wire:model="confirmingItemPause">
        <x-slot name="title">
            Pause Service
        </x-slot>
        <x-slot name="content">
          <div class="p-6 text-center">

            <h3 class="mb-5 text-lg font-normal text-gray-500 drk:text-gray-400">Are you sure you want to {{ $pauseGig->is_active ? 'Pause' : 'Unpause'}}
                this Service?</h3>
            </div>

        </x-slot>


        <x-slot name="footer">
            <button wire:click.prevent="pauseGig()"  type="button"
                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                Yes, I'm sure
            </button>
            <button  wire:click="closePauseModal()" type="button"
                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 drk:bg-gray-700 drk:text-gray-300 drk:border-gray-500 drk:hover:text-white drk:hover:bg-gray-600 drk:focus:ring-gray-600">No,
                cancel</button>
        </x-slot>
      </x-jet-confirmation-modal>
      @endif
    </div>
