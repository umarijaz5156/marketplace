<div class="">
    <button wire:click='toggleModal' type="button"
    class=" rounded px-6 py-3 bg-red-200 text-red-600 font-medium text-sm"> <i class="fa fa-exclamation-triangle mr-2"></i>Start Dispute</button>
    <x-jet-dialog-modal wire:model="openModal">
        <x-slot name="title">
           Start Dispute
        </x-slot>

        <x-slot name="content">
            <div class="flex-grow p-[30px] lg:p-[30px_60px]">
                <div class="flex items-center justify-between flex-wrap">
                    <div class="w-full mb-7 ">
                        <label for="exampleFormControlInput1" class="form-label inline-block mb-2 text-[#7F7D7C] text-[15px]">Subject</label>
                        <input type="text" wire:model="subject" class="form-control block w-full px-5 py-5 text-sm font-normal  text-gray-700  bg-white bg-clip-padding border border-solid border-[#e5e5e5] rounded-full transition ease-in-out m-0  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none " id="exampleFormControlInput1" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;" maxlength="1000">
                        @error('subject')<x-form-error><span>{{$message}}</span></x-form-error>@enderror
                    </div>

                </div>
                <div class="pt-14">
                    <label for="exampleFormControlInput1" class="form-label inline-block mb-2 text-[#7F7D7C] text-[15px]">Details</label>
                    <div>

                            <div class="mb-4 w-full bg-gray-50 rounded-2xl border border-gray-200 focus:ring-4 drk:bg-gray-700 drk:border-gray-600" style="box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;">
                                <div class="py-2 px-4 bg-white rounded-t-2xl drk:bg-gray-800">
                                    <textarea maxlength="1000" wire:model.lazy="details" id="comment" rows="8" class="px-0 w-full text-sm text-gray-500 bg-white border-0 drk:bg-gray-800 focus:ring-0 drk:text-white drk:placeholder-gray-400  placeholder:text-gray-400" placeholder="Write your message" required></textarea>
                                </div>
                                {{-- <div class="flex justify-between items-center py-2 px-3 border-t drk:border-gray-600 bg-white rounded-b-2xl">
                                    <div class="flex pl-0 space-x-1 sm:pl-2">
                                        <button type="button" class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 drk:text-gray-400 drk:hover:text-white drk:hover:bg-gray-600">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path></svg>
                                            <span class="sr-only">Attach file</span>
                                        </button>
                                        <button type="button" class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 drk:text-gray-400 drk:hover:text-white drk:hover:bg-gray-600">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                                            <span class="sr-only">Set location</span>
                                        </button>
                                        <button type="button" class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 drk:text-gray-400 drk:hover:text-white drk:hover:bg-gray-600">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>
                                            <span class="sr-only">Upload image</span>
                                        </button>
                                    </div>
                                    <div class="flex items-center">
                                        <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots" class="inline-flex items-center p-2 text-[19px] font-medium text-center text-[#8B8C91] rounded-lg hover:bg-gray-100 focus:outline-none drk:text-white focus:ring-gray-50 drk:bg-gray-800 drk:hover:bg-gray-700 drk:focus:ring-gray-600" type="button">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                          </button>
                                          <!-- Dropdown menu -->
                                          <div id="dropdownDots" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow drk:bg-gray-700 drk:divide-gray-600">
                                              <ul class="py-1 text-sm text-gray-700 drk:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                                                <li>
                                                  <a href="#" class="block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">Dashboard</a>
                                                </li>
                                                <li>
                                                  <a href="#" class="block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">Settings</a>
                                                </li>
                                                <li>
                                                  <a href="#" class="block py-2 px-4 hover:bg-gray-100 drk:hover:bg-gray-600 drk:hover:text-white">Earnings</a>
                                                </li>
                                              </ul>
                                              <div class="py-1">
                                                <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 drk:hover:bg-gray-600 drk:text-gray-200 drk:hover:text-white">Separated link</a>
                                              </div>
                                          </div>
                                    </div>
                                </div> --}}
                                @error('details')<x-form-error><span>{{$message}}</span></x-form-error>@enderror
                            </div>

                        <div class="text-end">
                            <p class="ml-auto text-sm text-[#3959D5] drk:text-gray-400">Submit an appeal for Pushiii to review</p>
                        </div>
                    </div>
                </div>

            </div>

        </x-slot>


        <x-slot name="footer">
            <div class="text-center mt-6">
                <button wire:click="createTicket" type="button" class="inline-block w-[211px] h-[50px] m-auto bg-gradient-to-t from-[rgba(38,70,196,1)] to-[rgba(57,89,214,1)] text-white font-medium text-sm leading-tight rounded-full   hover:shadow-[rgba(100, 100, 111, 0.2) 0px 7px 29px 0px] focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">Send</button>
            </div>
        </x-slot>

    </x-jet-dialog-modal>

</div>
