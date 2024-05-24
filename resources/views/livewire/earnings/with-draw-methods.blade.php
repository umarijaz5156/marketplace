<div class="relative before:content-[''] before:absolute before:w-[100%] before:top-[-40px]  before:bg-[#f4f5fc] before:h-[206px] before:-z-[1] mt-[176px]">
    <div class="container mx-auto px-[15px]">
      <div class="grid grid-cols-1 gap-y-12 md:gap-y-0 md:grid-cols-2">
        <div>
          <div class="bg-white rounded-3xl sm:max-w-[720px] md:h-[350px] xl:h-[233px]  w-[95%] p-[32px_38px]" style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">
            <h1 class="text-[20px] font-medium">Withdrawn</h1>
            <div class="mt-[18px]">
              <ul class="grid gap-x-3 w-full sm:grid-cols-2 gap-y-3 xl:grid-cols-4">
                <li class="relative">
                    <input type="checkbox" name="withdraw" id="paypal-option" value="" class="peer rounded-full bg-[#E7ECFC] border-white w-5 h-5 absolute right-3 top-3 checked:ring-0" required="" onclick="onlyOne(this)">
                    <label for="paypal-option" class="inline-flex justify-between p-3 w-full text-gray-500 bg-white rounded-xl border-2 border-gray-200 cursor-pointer drk:hover:text-gray-300 drk:border-gray-700 peer-checked:border-[#2646C4] hover:text-gray-600 drk:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 drk:text-gray-400 drk:bg-gray-800 drk:hover:bg-gray-700 h-[116px]">
                        <div class="block">
                            <img src="{{asset('images/earningpage/Layer 237.png')}}" alt="">
                            <div class="w-full lg:text-[14px]  2xl:text-[16px] font-medium absolute bottom-3">Paypal</div>
                        </div>
                    </label>
                </li>
                <li class="relative">
                  <input type="checkbox" name="withdraw" id="visacard-option" value="" class="peer rounded-full bg-[#E7ECFC] border-white w-5 h-5 absolute right-3 top-3 checked:ring-0" required="" onclick="onlyOne(this)">
                  <label for="visacard-option" class="inline-flex justify-between  p-3 w-full text-gray-500 bg-white rounded-xl border-2 border-gray-200 cursor-pointer drk:hover:text-gray-300 drk:border-gray-700 peer-checked:border-[#2646C4] hover:text-gray-600 drk:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 drk:text-gray-400 drk:bg-gray-800 drk:hover:bg-gray-700  h-[116px]">
                      <div class="block">
                          <img src="{{asset('images/earningpage/Layer 239.png')}}" alt="">
                          <div class="w-full lg:text-[14px]  2xl:text-[16px] font-medium absolute bottom-3">Visa Card</div>
                      </div>
                  </label>
                </li>
                <li class="relative">
                <input type="checkbox" name="withdraw" id="bank-option" value="" class="peer rounded-full bg-[#E7ECFC] border-none w-5 h-5 absolute right-3 top-3 checked:ring-0 checked:outline-none required="" onclick="onlyOne(this)">
                <label for="bank-option" class="inline-flex justify-between  p-3 w-full text-gray-500 bg-white rounded-xl border-2 border-gray-200 cursor-pointer drk:hover:text-gray-300 drk:border-gray-700 peer-checked:border-[#2646C4] hover:text-gray-600 drk:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 drk:text-gray-400 drk:bg-gray-800 drk:hover:bg-gray-700  h-[116px]">
                    <div class="block">
                        <img src="{{asset('images/earningpage/Layer 240.png')}}" alt="">
                        <div class="w-full lg:text-[14px]  2xl:text-[16px] font-medium absolute bottom-3">Back Transfer</div>
                    </div>
                </label>
                </li>
                <li class="relative">
              <input type="checkbox" name="withdraw" id="master-option" value="" class="peer rounded-full bg-[#E7ECFC] border-white w-5 h-5 absolute right-3 top-3 checked:ring-0" required="" onclick="onlyOne(this)">
              <label for="master-option" class="inline-flex justify-between  p-3 w-full text-gray-500 bg-white rounded-xl border-2 border-gray-200 cursor-pointer drk:hover:text-gray-300 drk:border-gray-700 peer-checked:border-[#2646C4] hover:text-gray-600 drk:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 drk:text-gray-400 drk:bg-gray-800 drk:hover:bg-gray-700  h-[116px]">
                  <div class="block">
                      <img src="{{asset('images/earningpage/Layer 241.png')}}" alt="">
                      <div class="w-full lg:text-[14px]  2xl:text-[16px] font-medium absolute bottom-3">Master Card</div>
                  </div>
              </label>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div>
          <div class="bg-white rounded-3xl sm:max-w-[720px] md:h-[350px] xl:h-[233px]  w-[95%] p-[32px_38px] " style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">
            <h1 class="text-[20px] font-medium">Show</h1>
            <div class="flex items-center lg:h-[80%]">
             <div class="w-full">
                <div class="mt-5">
                  <label for="underline_select" class="sr-only">Everthing</label>
                    <select id="underline_select" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none drk:text-gray-400 drk:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option selected>Everything</option>
                        <option value="US">United States</option>
                        <option value="CA">Canada</option>
                        <option value="FR">France</option>
                        <option value="DE">Germany</option>
                    </select>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-11 mt-9">
                  <div>
                    <label for="underline_select" class="sr-only">2022</label>
                    <select id="underline_select" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none drk:text-gray-400 drk:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option selected>2022</option>
                        <option value="US">United States</option>
                        <option value="CA">Canada</option>
                        <option value="FR">France</option>
                        <option value="DE">Germany</option>
                    </select>
                  </div>
                  <div class="mt-9 md:mt-0">
                    <label for="underline_select" class="sr-only">All Month</label>
                    <select id="underline_select" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none drk:text-gray-400 drk:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option selected>All Month</option>
                        <option value="US">United States</option>
                        <option value="CA">Canada</option>
                        <option value="FR">France</option>
                        <option value="DE">Germany</option>
                    </select>
                  </div>
                </div>
             </div>
            </div>
          </div>
        </div>
      </div>
      <div class="text-center mt-12">
        <button type="button" class="inline-block px-8 sm:px-0 sm:w-[280px] h-[60px] m-auto bg-gradient-to-t from-[rgba(38,70,196,1)] to-[rgba(57,89,214,1)] text-white font-medium text-sm leading-tight rounded-full focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out" style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">Get Statement of Earnings</button>
      </div>
    </div>
   </div>
