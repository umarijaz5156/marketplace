<div class="container mx-auto px-[15px]">

    {{-- maessage --}}
    @if(session()->has('error'))
    <div  x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)" id="error" class=" bg-red-100 border border-red-400 mb-5 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline" >{{session()->get('error')}}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20">
                <title>Close</title>
                <path
                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
            </svg>
        </span>
    </div>
    @elseif(session()->has('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)" id="success" class=" bg-green-100 border border-green-400 mb-5 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{session()->get('success')}}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20">
                <title>Close</title>
                <path
                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
            </svg>
        </span>
    </div>
    @endif

    @if(!auth()->user()->seller->stripe_onboarded)
             <form method="Post" action="{{ route('stripe.redirect', ['seller' => auth()->user()->seller]) }}">
                                @csrf
                                <button type="submit" class=" text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 drk:focus:ring-blue-800 shadow-lg shadow-blue-500/50 drk:shadow-lg drk:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 ">
                                    Configure Payments
                                </button>

            </form>
     @elseif($availableWithdraw > 0)
        <button type="button" wire:click="toggleModal" class="float-right focus:outline-none text-white bg-green-400 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Withdraw</button>
     @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-12 sm:gap-y-0 md:gap-x-10 lg:gap-x-20">
       <div class="flex justify-center">
        <div class="bg-white rounded-3xl sm:max-w-[380px] h-[148px] w-[95%] flex justify-around sm:justify-start items-center p-[34px_14px] lg:mt-8 " style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">
            <div>
                 <img src="{{ asset('images/earningpage/Group 1.png') }}" alt="">
            </div>
            <div>
                 <h3 class="text-[26px] font-medium">${{$netIncome->total ?? 0}}</h3>
                 <p class="text-[#707070] text-base">Net Income</p>
            </div>
         </div>
       </div>
       <div class="flex justify-center">
        <div class="bg-white rounded-3xl sm:max-w-[380px] h-[148px] w-[95%]  flex justify-around sm:justify-start items-center p-[34px_14px]" style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">
            <div>
                 <img src="{{ asset('images/earningpage/Group 2.png') }}" alt="">
            </div>
            <div>
                 <h3 class="text-[26px] font-medium">${{$withdrawn}}</h3>
                 <p class="text-[#707070] text-base">Withdrawn</p>
            </div>
         </div>
       </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 lg:mt-[60px]">
        <div class="order-2 lg:order-1 flex justify-center lg:block">
            <div class="bg-white rounded-3xl sm:max-w-[380px] h-[148px]  w-[95%]  flex justify-around sm:justify-start items-center p-[34px_14px] mt-[50px] lg:mt-[100px]" style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">
                <div>
                     <img src="{{ asset('images/earningpage/Group 3.png') }}" alt="">
                </div>
                <div>
                     <h3 class="text-[26px] font-medium">${{$expectedIncome->total ?? 0}}</h3>
                     <p class="text-[#707070] text-base lg:w-[80%] xl:w-full">Expected Income</p>
                </div>
            </div>
        </div>
        <div class="text-center order-1 lg:order-2 sm:col-span-2 lg:col-span-1 mt-[50px] lg:mt-0">
            <h2 class="text-[30px]">The Best Earning Money <br>
                Services
            </h2>
            <p class="text-[#707070] text-[17px]">
                These are usually used when a text is required purely to fill a space.
            </p>
        </div>
        <div class="order-3 flex justify-center lg:block">
            <div class="bg-white rounded-3xl sm:max-w-[380px] h-[148px]  w-[95%]  flex justify-around sm:justify-start items-center p-[34px_14px] mt-[50px] lg:ml-auto" style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">
                <div>
                     <img src="{{ asset('images/earningpage/Group 4.png') }}" alt="">
                </div>
                <div>
                     <h3 class="text-[26px] font-medium">${{$availableWithdraw ?? 0}}</h3>
                     <p class="text-[#707070] text-base">Available for Withdrawal</p>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="flex justify-center lg:block">
            <div class="bg-white rounded-3xl sm:max-w-[380px] h-[148px] w-[95%]  flex justify-around sm:justify-start items-center p-[34px_14px] mt-[50px] sm:mt-[30px] sm:mx-auto" style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">
                <div>
                     <img src="{{ asset('images/earningpage/Group 5.png') }}" alt="">
                </div>
                <div>
                     <h3 class="text-[26px] font-medium">${{$pendingClearence ?? 0}}</h3>
                     <p class="text-[#707070] text-base">Pending Clearance</p>
                </div>
            </div>
        </div>
    </div>




    <x-jet-dialog-modal wire:model="openModal">
        <x-slot name="title">
            Withdraw amount
        </x-slot>

        <x-slot name="content">
            <form action="{{ route('seller.withdraw') }}" method="post" enctype="multipart/form-data">
                @csrf
                <p class="text-sm text-gray-500 mt-2 mb-2">Total Amount available for withdraw ${{$this->availableWithdraw}}</p>
                <input min="5" max="{{$availableWithdraw}}" id="amount" name="amount" type="number" class="
                bg-gray-50
                border border-gray-300
                text-gray-900 text-sm
                rounded-lg
                focus:ring-blue-500
                focus:border-blue-500 block
                    w-full p-2.5" >
                {{-- @error('requestDays') <x-form-error>{{ $message }}</x-form-error> @enderror --}}
                <div class="mt-4 flex justify-between">

                    <button type="button" wire:click="toggleModal"
                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-gray-800 drk:text-white drk:border-gray-600 drk:hover:bg-gray-700 drk:hover:border-gray-600 drk:focus:ring-gray-700">Cancel</button>
                    <button type="submit"
                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Withdraw</button>

                 </div>
            </form>

        </x-slot>


        <x-slot name="footer">

        </x-slot>

    </x-jet-dialog-modal>
</div>

