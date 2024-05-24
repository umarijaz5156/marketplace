<div class="relative before:content-[''] before:absolute before:w-[100%] before:top-[-40px]  before:bg-[#f4f5fc] before:h-[206px] before:-z-[1] mt-[176px]">
    <div class="container mx-auto px-[15px]">
      {{-- <form wire.submit.prevent = "save"> --}}
      <div class="grid grid-cols-1 gap-y-12 md:gap-y-0 md:grid-cols-2">

        <div>
          <div class="bg-white rounded-3xl sm:max-w-[720px] md:h-[350px] xl:h-[233px]  w-[95%] p-[32px_38px]" style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">
            <h1 class="text-[20px] font-medium">Withdraw Option</h1>
             @error('option')<x-form-error>{{$message}}</x-form-error>@enderror
            <div class="mt-[18px]">
              <ul class="grid gap-x-3 w-full sm:grid-cols-2 gap-y-3 xl:grid-cols-2">
                <li class="relative">
                    <input wire:model="option" type="radio"  id="paypal-option" value="paypal" class="peer rounded-full bg-[#E7ECFC] border-white w-5 h-5 absolute right-3 top-3 checked:ring-0" required="" onclick="onlyOne(this)">
                    <label for="paypal-option" class="inline-flex justify-between p-3 w-full text-gray-500 bg-white rounded-xl border-2 border-gray-200 cursor-pointer drk:hover:text-gray-300 drk:border-gray-700 peer-checked:border-[#2646C4] hover:text-gray-600 drk:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 drk:text-gray-400 drk:bg-gray-800 drk:hover:bg-gray-700 h-[116px]">
                        <div class="block">
                            <img src="{{asset('images/earningpage/Layer 237.png')}}" alt="">
                            <div class="w-full lg:text-[14px]  2xl:text-[16px] font-medium absolute bottom-3">Paypal</div>
                        </div>
                    </label>
                </li>
                <li class="relative">
                  <input wire:model="option" type="radio"  id="visacard-option" value="payoneer" class="peer rounded-full bg-[#E7ECFC] border-white w-5 h-5 absolute right-3 top-3 checked:ring-0" required="" onclick="onlyOne(this)">
                  <label for="visacard-option" class="inline-flex justify-between  p-3 w-full text-gray-500 bg-white rounded-xl border-2 border-gray-200 cursor-pointer drk:hover:text-gray-300 drk:border-gray-700 peer-checked:border-[#2646C4] hover:text-gray-600 drk:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 drk:text-gray-400 drk:bg-gray-800 drk:hover:bg-gray-700  h-[116px]">
                      <div class="block">
                          <img width="40" height="40" src="{{asset('images/payonner-logo.png')}}" alt="">
                          <div class="w-full lg:text-[14px]  2xl:text-[16px] font-medium absolute bottom-3">Payoneer</div>
                      </div>
                  </label>
                </li>

                </li>
              </ul>
            </div>
          </div>
        </div>
        <div>
          <div class="bg-white rounded-3xl sm:max-w-[720px] md:h-[350px] xl:h-[233px]  w-[95%] p-[32px_38px] " style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">
            <h1 class="text-[20px] font-medium">Details</h1>
            <div class="flex items-center lg:h-[80%]">
             <div class="w-full">
               @error('email')<x-form-error>{{$message}}</x-form-error>@enderror
                <div class="mt-5">
                  {{-- <label for="underline_select" class="sr-only">Everthing</label> --}}

                  <div class="relative z-0 w-full mb-6 group">

                    <input type="email" wire:model="email" type="email" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none drk:text-white drk:border-gray-600 drk:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 drk:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:drk:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email address</label>
                  </div>
                </div>

             </div>
            </div>
          </div>
        </div>

      </div>
      <div class="text-center mt-12">
          <div class="flex">
            <button type="button" wire:click="save" class="inline-block px-8 sm:px-0 sm:w-[280px] h-[60px] m-auto bg-gradient-to-t from-[rgba(38,70,196,1)] to-[rgba(57,89,214,1)] text-white font-medium text-sm leading-tight rounded-full focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">Save Withdraw Option</button>

          </div>
          @if (session()->has('message'))
          <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 30000)">
            <span class="text-green-500">{{session('message')}}</span>
          </div>

          @endif
      </div>
    {{-- </form> --}}
    </div>
   </div>
