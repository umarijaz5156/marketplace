<div>
  @if(isset($seller))
    <div class="container lg:max-w-[960px] xl:max-w-[1140px] 2xl:max-w-[1420px] w-full mx-auto px-[15px]">
      <div class="bg-white px-[30px] sm:px-[50px] py-[30px] rounded-2xl" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
        <h1 class="text-[26px] font-[500] ">About The Seller</h1>
        <div class="grid grid-cols-1 lg:grid-cols-2 py-[27px] border-b border-[#EFEFEF]">
          <div>
            <div class="block sm:flex sm:justify-start sm:items-center ">
              <div class="flex justify-center ">
                <img src="{{ asset('/images/aboutprofile.png') }}" alt="">
              </div>
              <div class="ml-[20px] text-center sm:text-left">
                <h3 class="text-[20px] font-[500]">{{$seller->seller_name}}</h3>
                <p class="text-[#757575] text-[14px]">Let me illuminate your ideas through creations</p>
                <div class="mt-[3px] flex justify-center sm:justify-start ">
                  <div class="flex text-[#ffb33d] mt-[2px]">
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                      <i class="fa fa-star" aria-hidden="true"></i>
                  </div>
                  <div class="flex ml-[5px] items-start">
                      <h5 class="text-[#ffb33d] text-[16px]">4.9</h5>
                      <h6 class="flex" >(29,342)</h6>
                  </div>
                </div>
                <button type="button" class=" mt-[17px] w-full sm:w-[138px] text-[#3858D6] bg-white border border-[#3858D6] hover:bg-[#2545c3] focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-3 text-center mr-2 mb-2 hover:text-white drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800">Contact Me</button>
              </div>
            </div>
          </div>
          <div>
            <div class="grid grid-cols-1 sm:grid-cols-2 mt-6 lg:mt-0">
              <div>
                <div class="flex">
                  <div>
                    <img src="{{ asset('/images/location.png') }}" alt="">
                  </div>
                  <div class="ml-[15px]">
                    <p class="text-[#818181]">From</p>
                    <p>India</p>
                  </div>
                </div>
                <div class="flex mt-6 sm:mt-[43px]">
                  <div>
                    <img src="{{ asset('/images/time.png') }}" alt="">
                  </div>
                  <div class="ml-[15px]">
                    <p class="text-[#818181]">Avg. Responce Time</p>
                    <p>2 Hours</p>
                  </div>
                </div>
              </div>
              <div>
                <div class="flex mt-6 sm:mt-0">
                  <div>
                    <img src={{ asset('/images/location.png') }} alt="">
                  </div>
                  <div class="ml-[15px]">
                    <p class="text-[#818181]">Menber Since</p>
                    <p>Dec 2015</p>
                  </div>
                </div>
                <div class="flex mt-6 sm:mt-[43px]">
                  <div>
                    <img src={{ asset('/images/location.png') }} alt="">
                  </div>
                  <div class="ml-[15px]">
                    <p class="text-[#818181]">Last Delivery</p>
                    <p>About 14 Hours</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="text-[#545454] mt-[20px]">
          <p>Hi,</p>
          <p>Mayur here.</p>
          <p>
            I am a professional graphic designer with an experience of 10+ years. Let my field of expertise collaborate with your level of imagination, so together we can create an exceptional brand image. Something which creates an impact. Impact which screams for its acknowledgment without you needing to do  so. Let us make us do want to now to wonders together in this field of designing.
          </p>
          <p class="mt-2">Welcome to the world of Gul Studios where creative minds are always buzzing with unique ideas and talented professionals are always ready.</p>
        </div>
      </div>
    </div>
    @endif
</div>
