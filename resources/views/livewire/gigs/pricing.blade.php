<div>
   <h1 class="text-[30px] font-light">Pricing</h1>
    <div class="bg-white rounded-3xl px-[30px] py-[50px] sm:p-[40px_20px_20px_20px] mt-7 overflow-x-auto" style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">
        <div class="w-[869px] lg:w-full">
            <div class="overflow-x-auto relative" x-data="{ isAdvanced: @entangle('isAdvanced')}">

                <table class="w-full text-sm text-left text-gray-500 drk:text-gray-400">
                    <label for="default-toggle" class="mt-2 ml-2 inline-flex relative items-center cursor-pointer">
                        <input wire:model="isAdvanced" type="checkbox" name="packageType" value="{{ $isAdvanced }}" id="default-toggle"
                            class="sr-only peer">

                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 drk:peer-focus:ring-blue-800 rounded-full peer drk:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all drk:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-900 drk:text-gray-300" >Advance Packages</span>
                    </label>
                    <tbody>
                        <tr class=" drk:bg-gray-900 drk:border-gray-700">
                            <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap drk:text-white">
                            <td class="py-4 px-6">
                                <p class="text-[16px]">Basic <span style="color:#ff0000">*</span></p>

                                <div class="flex justify-start items-center mt-7">

                                    <input maxlength="250" wire:model.debounce:500="basicTitle" type="text" id="basicName" name="packages[basic][name]" class=" text-[16px] border-0 focus:outline-none px-0 focus:ring-0 focus: focus:border-b-[rgba(38,70,196,1)] max-w-[180px] w-[95%] mr-2" placeholder="Name your Package" autofocus/>

                                    <img src="{{ asset('images/Layer 249.png')}}" alt="">

                                </div>

                                @error('packages.basic.name')  <x-form-error>{{ $message }}</x-form-error>@enderror
                                @error('basicTitle')  <x-form-error>{{ $message }}</x-form-error>@enderror
                                <div class="flex justify-start items-center mt-7">
                                    <input  wire:model.debounce:500="basicDescription" id="basicDescription" name="packages[basic][description]" type="text" class=" text-[16px] border-0 focus:outline-none px-0 focus:ring-0 focus: focus:border-b-[rgba(38,70,196,1)] max-w-[180px] w-[95%] mr-2" placeholder="Describe the details"/>
                                    <img src="{{ asset('images/Layer 249.png')}}" alt="">
                                </div>
                                @error('packages.basic.description')  <x-form-error>{{ $message }}</x-form-error>@enderror
                                @error('basicDescription')  <x-form-error>{{ $message }}</x-form-error>@enderror
                            </td>
                            <td x-show="isAdvanced" class="py-4 px-6">
                                <p class="text-[16px]">Standard<span style="color:#ff0000">*</span></p>
                                <div class="flex justify-start items-center mt-7">
                                    <input wire:model.debounce:500="mediumTitle" type="text" name="packages[medium][name]" id="mediumtitle" class=" text-[16px] border-0 focus:outline-none px-0 focus:ring-0 focus: focus:border-b-[rgba(38,70,196,1)] max-w-[180px] w-[95%] mr-2" placeholder="Name your Package"/>
                                    <img src="{{ asset('images/Layer 249.png')}}" alt="">

                                </div>
                                @error('packages.medium.name')  <x-form-error>{{ $message }}</x-form-error>@enderror
                                @error('mediumTitle')  <x-form-error>{{ $message }}</x-form-error>@enderror
                                <div class="flex justify-start items-center mt-7">
                                    <input wire:model.debounce:500="mediumDescription" type="text" name="packages[medium][description]" id="mediumDescription" class=" text-[16px] border-0 focus:outline-none px-0 focus:ring-0 focus: focus:border-b-[rgba(38,70,196,1)] max-w-[180px] w-[95%] mr-2" placeholder="Describe the details"/>
                                    <img src="{{ asset('images/Layer 249.png')}}" alt="">
                                </div>
                                @error('packages.medium.description')  <x-form-error>{{ $message }}</x-form-error>@enderror
                                @error('mediumDescription')  <x-form-error>{{ $message }}</x-form-error>@enderror
                            </td>
                            <td x-show="isAdvanced" class="py-4 px-6">
                                <p class="text-[16px]">Premium<span style="color:#ff0000">*</span></p>
                                <div class="flex justify-start items-center mt-7">
                                    <input wire:model.debounce:500="advanceTitle"  type="text" name="packages[advance][name]" id="advanceTitle" class=" text-[16px] border-0 focus:outline-none px-0 focus:ring-0 focus: focus:border-b-[rgba(38,70,196,1)] max-w-[180px] w-[95%] mr-2" placeholder="Name your Package"/>

                                    <img src="{{ asset('images/Layer 249.png')}}" alt="">

                                </div>
                                @error('packages.advance.name')  <x-form-error>{{ $message }}</x-form-error>@enderror
                                @error('advanceTitle')  <x-form-error>{{ $message }}</x-form-error>@enderror

                                <div class="flex justify-start items-center mt-7">
                                    <input wire:model.debounce:500="advanceDescription" type="text" name="packages[advance][description]" id="advanceDescription"  class=" text-[16px] border-0 focus:outline-none px-0 focus:ring-0 focus: focus:border-b-[rgba(38,70,196,1)] max-w-[180px] w-[95%] mr-2" placeholder="Describe the details"/>
                                    <img src="{{ asset('images/Layer 249.png')}}" alt="">
                                </div>
                                @error('packages.advance.description')  <x-form-error>{{ $message }}</x-form-error>@enderror
                                @error('advanceDescription')  <x-form-error>{{ $message }}</x-form-error>@enderror
                            </td>
                        </tr>
                        <tr  class=" drk:bg-gray-800 drk:border-gray-700 h-[75px]">
                            <th scope="row" class="py-4 px-6 font-normal text-gray-900 whitespace-nowrap drk:text-white rounded-tl-2xl rounded-bl-2xl">
                                Time (Days 1-90)
                            </th>
                            {{-- basic time --}}
                            <input id="basicType" type="hidden" name="packages[basic][type]" value="0"/>
                            <td class="py-4 px-6">
                                <div>
                                    <input wire:model.debounce:500="basicTime" min="1" max="90" type="number" name="packages[basic][time]" id="basicTime" class=" text-[16px] border-0 focus:outline-none px-0 focus:ring-0 focus: focus:border-b-[rgba(38,70,196,1)] max-w-[180px] w-[95%] mr-2" placeholder="Delivery Time"/>
                                    @error('packages.basic.time')  <x-form-error>{{ $message }}</x-form-error>@enderror
                                    @error('basicTime')  <x-form-error>{{ $message }}</x-form-error>@enderror
                                </div>
                            </td>
                            <input id="mediumType" type="hidden" name="packages[medium][type]" value="1"/>
                            <td x-show="isAdvanced" class="py-4 px-6">
                                <div>
                                    <input wire:model.debounce:500="mediumTime" min="1" max="90" type="number" name="packages[medium][time]" id="basicTime" class=" text-[16px] border-0 focus:outline-none px-0 focus:ring-0 focus: focus:border-b-[rgba(38,70,196,1)] max-w-[180px] w-[95%] mr-2" placeholder="Delivery Time"/>
                                    @error('packages.medium.time')  <x-form-error>{{ $message }}</x-form-error>@enderror
                                    @error('mediumTime')  <x-form-error>{{ $message }}</x-form-error>@enderror
                                </div>
                            </td>
                            <input id="advanceType" type="hidden" name="packages[advance][type]" value="2"/>
                            <td x-show="isAdvanced" class="py-4 px-6 rounded-tr-2xl rounded-br-2xl">
                                <div>
                                    <input wire:model.debounce:500="advanceTime" min="1" max="90" type="number" name="packages[advance][time]" id="basicTime" class=" text-[16px] border-0 focus:outline-none px-0 focus:ring-0 focus: focus:border-b-[rgba(38,70,196,1)] max-w-[180px] w-[95%] mr-2" placeholder="Delivery Time"/>
                                    @error('packages.advance.time')  <x-form-error>{{ $message }}</x-form-error>@enderror
                                    @error('advanceTime')  <x-form-error>{{ $message }}</x-form-error>@enderror
                                </div>
                            </td>
                        </tr>


                        <tr class="bg-white drk:bg-gray-800 drk:border-gray-700 h-[75px]">
                            <th scope="row" class="py-4 px-6 font-normal text-gray-900 whitespace-nowrap drk:text-white rounded-tl-2xl rounded-bl-2xl">
                                Price ($5-5000)
                            </th>
                            {{-- basic price --}}
                            <td class="py-4 px-6">
                               <div class="flex items-center">
                                 <img src="{{ asset('images/$.png') }}" class="mb-1" alt="">
                                    <input wire:model.debounce:500="basicPrice" min="5" max="5000" type="number" name="packages[basic][price]" id="basicPrice" class="border-0 border-b-2 border-[#DFE3EC] focus:outline-none px-1 focus:ring-0 focus: focus:border-b-[rgba(38,70,196,1)]"/>


                               </div>

                                @error('packages.basic.price')  <x-form-error>{{ $message }}</x-form-error>@enderror
                                @error('basicPrice')  <x-form-error>{{ $message }}</x-form-error>@enderror

                            </td>

                            <td x-show="isAdvanced" class="py-4 px-6">
                                 <div class=" flex items-center">
                                    <img src="{{ asset('images/$.png') }}" class="mb-1" alt="">
                                    <input wire:model.debounce:500="mediumPrice"  value="5"  min="5" max="5000" type="number" name="packages[medium][price]" id="mediumPrice" class="border-0 border-b-2 border-[#DFE3EC] focus:outline-none px-1 focus:ring-0 focus: focus:border-b-[rgba(38,70,196,1)]" />


                                </div>
                                @error('packages.medium.price')  <x-form-error>{{ $message }}</x-form-error>@enderror
                                @error('mediumPrice')  <x-form-error>{{ $message }}</x-form-error>@enderror
                            </td>
                            <td x-show="isAdvanced" class="py-4 px-6 rounded-tr-2xl rounded-br-2xl">
                                 <div class="flex  items-center">
                                      <img src="{{ asset('images/$.png') }}" class="mb-1" alt="">
                                    <input wire:model.debounce:500="advancePrice"  min="5" max="5000" type="number" name="packages[advance][price]" id="advancePrice" class="border-0 border-b-2 border-[#DFE3EC] focus:outline-none px-1 focus:ring-0 focus: focus:border-b-[rgba(38,70,196,1)]" />

                               </div>
                               @error('packages.advance.price')  <x-form-error>{{ $message }}</x-form-error>@enderror
                               @error('advancePrice') <x-form-error>{{ $message }}</x-form-error>@enderror
                            </td>
                        </tr>
                        {{-- extra services --}}
                        <tr class="bg-[#F6F8FD] drk:bg-gray-800 drk:border-gray-700 h-[75px]">
                            <th scope="row" class="py-4 px-6 font-normal text-gray-900 whitespace-nowrap drk:text-white rounded-tl-2xl rounded-bl-2xl">
                               Service Features
                            </th>
                            <td class="py-4 px-6 align-top">
                                <div class="mt-9" x-data="{ showBasic: @entangle('showBasic')}">

                                    <div class="mb-5 flex justify-start items-center flex-wrap gap-y-3 w-full max-w-[300px]">
                                        @foreach ($basicSelectedService as $service)
                                            <a  class="text-[16px] cursor-pointer border border-[#D1D1D1] px-7 py-4 rounded-full mr-3">
                                                {{$service}}<i wire:click="removeService('{{ $service }}','basic')" class="fa-solid fa-x text-[12px] ml-2"></i>
                                            </a>
                                        @endforeach

                                        <a @click="showBasic = !showBasic" x-show="!showBasic" class="cursor-pointer text-[16px] border border-[#3959D6] px-7 py-4 rounded-full mr-3 bg-[#F8FAFF] text-[#2646C4]">

                                            <i class="fa-regular fa-plus text-[16px] mr-2"></i> Add Service

                                        </a>
                                        <input x-show="showBasic" list="suggestions" type="text" wire:keydown.enter='addService("basic")' wire:model="basicService" class="w-44 text-[16px] border border-[#3959D6] px-7 py-4 rounded-full mr-3 bg-[#F8FAFF] text-[#2646C4]"   autofocus/>
                                        <datalist id="suggestions">
                                            @foreach ($serviceSuggestions as $serviceSuggestion)
                                                <option value="{{$serviceSuggestion->name}}">
                                            @endforeach
                                        </datalist>
                                    </div>
                                    @error('basicService')  <x-form-error>{{ $message }}</x-form-error> @enderror
                                    @error('basicSelectedService') <x-form-error>{{ $message }}</x-form-error> @enderror

                                 </div>
                            </td>
                            <td x-show="isAdvanced" class="py-4 px-6 align-top">
                                <div class="mt-9 grid grid-cols-1" x-data="{ showMedium: @entangle('showMedium')}">
                                    <div class="mb-5 flex justify-start items-center flex-wrap gap-y-3 w-full max-w-[300px]">
                                        @foreach ($mediumSelectedService as $service)
                                            <a  class="text-[16px] cursor-pointer border border-[#D1D1D1] px-7 py-4 rounded-full mr-3">
                                                {{$service}}<i wire:click="removeService('{{ $service }}','medium')" class="fa-solid fa-x text-[12px] ml-2"></i>
                                            </a>
                                        @endforeach

                                        <a @click="showMedium = !showMedium" x-show="!showMedium" class="cursor-pointer text-[16px] border border-[#3959D6] px-7 py-4 rounded-full mr-3 bg-[#F8FAFF] text-[#2646C4]">

                                            <i class="fa-regular fa-plus text-[16px] mr-2"></i> Add Service

                                        </a>
                                        <input x-show="showMedium"  list="suggestions" type="text" wire:keydown.enter='addService("medium")' wire:model="mediumService" class="w-44 text-[16px] border border-[#3959D6] px-7 py-4 rounded-full mr-3 bg-[#F8FAFF] text-[#2646C4]" autofocus/>
                                        <datalist id="suggestions">
                                            @foreach ($serviceSuggestions as $serviceSuggestion)
                                                <option value="{{$serviceSuggestion->name}}">
                                            @endforeach
                                        </datalist>
                                    </div>
                                    @error('mediumService')  <x-form-error>{{ $message }}</x-form-error> @enderror
                                    @error('mediumSelectedService') <x-form-error>{{ $message }}</x-form-error> @enderror

                                 </div>
                            </td>
                            <td x-show="isAdvanced" class="py-4 px-6 rounded-tr-2xl rounded-br-2xl align-top">
                                <div class="mt-9" x-data="{ showPremium: @entangle('showPremium')}">
                                    <div class="mb-5 flex justify-start items-center flex-wrap gap-y-3 w-full max-w-[300px]">
                                        @foreach ($advanceSelectedService as $service)
                                            <a  class="text-[16px] cursor-pointer border border-[#D1D1D1] px-7 py-4 rounded-full mr-3">
                                                {{$service}}<i wire:click="removeService('{{ $service }}','advance')" class="fa-solid fa-x text-[12px] ml-2"></i>
                                            </a>
                                        @endforeach

                                        <a @click="showPremium = !showPremium" x-show="!showPremium" class="cursor-pointer text-[16px] border border-[#3959D6] px-7 py-4 rounded-full mr-3 bg-[#F8FAFF] text-[#2646C4]">

                                            <i class="fa-regular fa-plus text-[16px] mr-2"></i> Add Service

                                        </a>
                                        <input x-show="showPremium"  list="suggestions" type="text" wire:keydown.enter='addService("advance")' wire:model="advanceService" class="w-44 text-[16px] border border-[#3959D6] px-7 py-4 rounded-full mr-3 bg-[#F8FAFF] text-[#2646C4]"   autofocus/>
                                        <datalist id="suggestions">
                                            @foreach ($serviceSuggestions as $serviceSuggestion)
                                                <option value="{{$serviceSuggestion->name}}">
                                            @endforeach
                                        </datalist>

                                    </div>
                                    @error('advanceService')  <x-form-error>{{ $message }}</x-form-error> @enderror
                                    @error('advanceSelectedService') <x-form-error>{{ $message }}</x-form-error> @enderror

                                 </div>
                            </td>
                         </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="flex justify-center items-center gap-x-5 mt-12">
        <a wire:click="previous()" class="cursor-pointer btn btn-prev px-8 sm:px-0 sm:w-[165px] h-[60px] bg-gradient-to-t from-[rgba(38,70,196,1)] to-[rgba(57,89,214,1)] text-white font-normal  leading-tight rounded-full focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex justify-center items-center text-[20px]" style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">Previous</a>
        <a wire:click="next()" class="cursor-pointer btn btn-next px-8 sm:px-0 sm:w-[165px] h-[60px] bg-gradient-to-t from-[rgba(38,70,196,1)] to-[rgba(57,89,214,1)] text-white font-normal  leading-tight rounded-full focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex justify-center items-center text-[20px]" style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">Next</a>
    </div>
</div>
