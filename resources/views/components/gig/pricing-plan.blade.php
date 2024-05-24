 <!-- pricing Plan -->
 <div class="mt-[113px]">
    <div class="container lg:max-w-[960px] xl:max-w-[1140px] 2xl:max-w-[1420px] w-full mx-auto px-[15px]">
      <div class="text-center mb-8">
        <div>
          <h1 class="text-center text-[30px] text-[#1f1f1f] font-bold">
            Compare <span class="font-[400]"> Packages </span>
          </h1>
        </div>
      </div>
      <div class="grid grid-cols-1 lg:grid-cols-3">
        {{-- basic --}}
        <div class=" mt-6 lg:mt-0 py-[31px] px-[40px] w-full lg:w-[95%] lg:max-w-[440px] bg-white rounded-2xl border shadow-xl sm:p-8 drk:bg-gray-800 drk:border-gray-700">
          <div class="flex justify-between items-center">
            <h5 class=" text-[26px] font-medium text-black drk:text-gray-400">Basic</h5>
            <h6 class="text-[#2646C4] text-[16px]">$<span class="text-[26px]">50</span></h6>
          </div>
          <div class="items-baseline drk:text-white mt-[23px]">
              <h4 class="text-black">Silky Flow</h4>
              <p class="mt-2 text-[#707070]">3 logos in JPG & transparent PNG + NO Mascots & Complex design</p>
          </div>
          <!-- List -->
          <ul role="list" class="my-7 space-y-8">
              <li class="flex items-center space-x-3">
                  <!-- Icon -->
                  <img src="{{ asset('images/bluecheck.png') }}" alt="">
                  <span class="text-base font-normal leading-tight text-gray-500 drk:text-gray-400">Source File</span>
              </li>
              <li class="flex items-center space-x-3">
                  <!-- Icon -->
                  <img src="{{ asset('images/bluecheck.png') }}" alt="">
                  <span class="text-base font-normal leading-tight text-gray-500 drk:text-gray-400">Logo Transparency</span>
              </li>
              <li class="flex items-center space-x-3">
                  <!-- Icon -->
                  <img src="{{ asset('images/bluecheck.png') }}" alt="">
                  <span class="text-base font-normal leading-tight text-gray-500 drk:text-gray-400">High Resolution</span>
              </li>
              <li class="flex items-center space-x-3  decoration-gray-500">
                  <!-- Icon -->
                  <img src="{{ asset('images/bluecheck.png') }}" alt="">
                  <span class="text-base font-normal leading-tight text-gray-500">Stationery Designs</span>
              </li>
              <li class="flex items-center space-x-3  decoration-gray-500">
                  <!-- Icon -->
                  <img src="{{ asset('images/bluecheck.png') }}"alt="">
                  <span class="text-base font-normal leading-tight text-gray-500">Social Media Kit</span>
              </li>
          </ul>
          <div class="flex justify-center">
            <button type="button" class="w-[249px] text-white bg-[#2646C4] hover:bg-blue-700 mt-[20px] py-5 focus:ring-4 focus:outline-none focus:ring-blue-200 drk:focus:ring-blue-900 font-medium rounded-full text-sm px-5 shadow-xl inline-flex justify-center text-center">Choose plan</button>
          </div>
        </div>
        {{-- standard --}}
        <div class="mt-6 lg:mt-0 py-[31px] px-[40px] w-full lg:w-[95%] lg:max-w-[440px] bg-[#2747c5] rounded-2xl border shadow-xl sm:p-8 drk:bg-gray-800 drk:border-gray-700">
          <div class="flex justify-between items-center">
            <h5 class=" text-[26px] font-medium text-white drk:text-gray-400">Standard</h5>
            <h6 class="text-white text-[16px]">$<span class="text-[26px]">100</span></h6>
          </div>
          <div class="items-baseline  drk:text-white mt-[23px]">
            <h4 class="text-white">Fluid Flow</h4>
            <p class="mt-2 text-white">3 logos in JPG & transparent PNG + NO Mascots & Complex design</p>
          </div>
          <!-- List -->
          <ul role="list" class="my-7 space-y-8">
              <li class="flex items-center space-x-3">
                  <!-- Icon -->
                  <img src="{{ asset('images/whitecheck.png') }}" alt="">
                  <span class="text-base font-normal leading-tight text-white drk:text-gray-400">Source File</span>
              </li>
              <li class="flex items-center space-x-3">
                  <!-- Icon -->
                  <img src="{{ asset('images/whitecheck.png') }}" alt="">
                  <span class="text-base font-normal leading-tight text-white drk:text-gray-400">Logo Transparency</span>
              </li>
              <li class="flex items-center space-x-3">
                  <!-- Icon -->
                  <img src="{{ asset('images/whitecheck.png') }}" alt="">
                  <span class="text-base font-normal leading-tight text-white drk:text-gray-400">High Resolution</span>
              </li>
              <li class="flex items-center space-x-3  decoration-gray-500">
                  <!-- Icon -->
                  <img src="{{ asset('images/whitecheck.png') }}" alt="">
                  <span class="text-base font-normal leading-tight text-white">Stationery Designs</span>
              </li>
              <li class="flex items-center space-x-3  decoration-gray-500">
                  <!-- Icon -->
                  <img src="{{ asset('images/whitecheck.png') }}" alt="">
                  <span class="text-base font-normal leading-tight text-white">Social Media Kit</span>
              </li>
          </ul>
          <div class="flex justify-center">
            <a href="#" class="text-white  font-medium w-[249px] mt-[10px] py-5 rounded-full md:p-[15px_35px] bg-[#607ae3] border-[2px] border-[#f1f4ff] text-sm px-5 shadow-xl inline-flex justify-center text-center">
              Choose Plan
            </a>
          </div>
        </div>
        {{-- premium --}}
        <div class="mt-6 lg:mt-0 py-[31px] px-[40px] w-full lg:w-[95%] lg:max-w-[440px] bg-white rounded-2xl border shadow-xl sm:p-8 drk:bg-gray-800 drk:border-gray-700">
          <div class="flex justify-between items-center">
            <h5 class=" text-[26px] font-medium text-black drk:text-gray-400">Premium</h5>
            <h6 class="text-[#2646C4] text-[16px]">$<span class="text-[26px]">150</span></h6>
          </div>
          <div class="items-baseline drk:text-white mt-[23px]">
            <h4 class="text-black">Flexible Flow</h4>
            <p class="mt-2 text-[#707070]">3 logos in JPG & transparent PNG + NO Mascots & Complex design</p>
          </div>
          <!-- List -->
          <ul role="list" class="my-7 space-y-8">
              <li class="flex items-center space-x-3">
                  <!-- Icon -->
                  <img src="{{ asset('images/bluecheck.png') }}" alt="">
                  <span class="text-base font-normal leading-tight text-gray-500 drk:text-gray-400">Source File</span>
              </li>
              <li class="flex items-center space-x-3">
                  <!-- Icon -->
                  <img src="{{ asset('images/bluecheck.png') }}" alt="">
                  <span class="text-base font-normal leading-tight text-gray-500 drk:text-gray-400">Logo Transparency</span>
              </li>
              <li class="flex items-center space-x-3">
                  <!-- Icon -->
                  <img src="{{ asset('images/bluecheck.png') }}" alt="">
                  <span class="text-base font-normal leading-tight text-gray-500 drk:text-gray-400">High Resolution</span>
              </li>
              <li class="flex items-center space-x-3  decoration-gray-500">
                  <!-- Icon -->
                  <img src="{{ asset('images/bluecheck.png') }}" alt="">
                  <span class="text-base font-normal leading-tight text-gray-500">Stationery Designs</span>
              </li>
              <li class="flex items-center space-x-3  decoration-gray-500">
                  <!-- Icon -->
                  <img src="{{ asset('images/bluecheck.png') }}" alt="">
                  <span class="text-base font-normal leading-tight text-gray-500">Social Media Kit</span>
              </li>
          </ul>
          <div class="flex justify-center">
            <button type="button" class="w-[249px] text-white bg-[#2646C4] hover:bg-blue-700 mt-[20px] py-5 focus:ring-4 focus:outline-none focus:ring-blue-200 drk:focus:ring-blue-900 font-medium rounded-full text-sm px-5 shadow-xl inline-flex justify-center text-center">Choose plan</button>
          </div>
        </div>
      </div>
    </div>
   </div>
   <!-- pricing Plan -->
