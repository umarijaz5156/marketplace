

    <!-- Footer -->
    <Footer>


      <div class="container 2xl:max-w-screen-2xl mx-auto px-4 h-full py-16">
          <div class="flex justify-between items-start gap-10 flex-wrap pb-10 border-b border-gray-300">
              <div>
                  <h1 class="text-[#263238] text-2xl font-bold">Pushiii</h1>
                  {{-- <ul class="space-y-4 mt-7">
                      @foreach ($categories as $category)
                       <li>
                          <a href="{{ route('category_details', ['catId'=>$category->id]) }}" class="text-[#263238] text-base font-medium hover:text-[#0096D8]">
                            {{ $category->name }}
                          </a>
                      </li>
                      @endforeach


                  </ul> --}}
                  <p class="space-y-4 mt-7 w-[10rem]">Connecting talented freelancers with dropshippers worldwide.</p>
              </div>
              <div class="w-full sm:w-[70%] space-y-10">
                  <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                      <div>
                          <h1 class="text-[#263238] text-2xl font-bold">Policies</h1>
                          <ul class="space-y-4 mt-7">
                              {{-- <li>
                                  <a href="#" class="text-[#263238] text-base font-medium hover:text-[#0096D8]">
                                      Careers
                                  </a>
                              </li> --}}
                              <li>
                                  <a href="{{route('refund-policy')}}" class="text-[#263238] text-base font-medium hover:text-[#0096D8]">
                                      Refund Policy
                                  </a>
                              </li>
                              <li>
                                  <a href="{{route('terms')}}" class="text-[#263238] text-base font-medium hover:text-[#0096D8]">
                                    Terms & Conditions
                                  </a>
                              </li>
                              <li>
                                  <a href="{{route('privacy-policy')}}" class="text-[#263238] text-base font-medium hover:text-[#0096D8]">
                                      Privacy Policy
                                  </a>
                              </li>
                          </ul>
                      </div>
                      <div>
                          <h1 class="text-[#263238] text-2xl font-bold">Support</h1>
                          <ul class="space-y-4 mt-7">
                              <li>

                                  <a href="mailto:support@pushiii.com" class="text-[#263238] text-base font-medium hover:text-[#0096D8]">
                                      support@pushiii.com
                                  </a>
                              </li>
                              {{-- <li>
                                  <a href="#" class="text-[#263238] text-base font-medium hover:text-[#0096D8]">
                                      Trust & Safety
                                  </a>
                              </li>
                              <li>
                                  <a href="#" class="text-[#263238] text-base font-medium hover:text-[#0096D8]">
                                      Selling on Fringe
                                  </a>
                              </li>
                              <li>
                                  <a href="#" class="text-[#263238] text-base font-medium hover:text-[#0096D8]">
                                      Buying on Fringe
                                  </a>
                              </li> --}}
                          </ul>
                      </div>
                      {{-- <div>
                        <x-logo type="drk" home_link="/"/>
                          <ul class="space-y-4 mt-7">


                              <li>
                                A Whole World of Freelance Talent on Your Fingertips.
                              </li>
                          </ul>
                      </div> --}}
                  </div>
                  {{-- <div class="flex justify-start items-center">
                      <div class="group hover:bg-[#0096D8] bg-[#263238] bg-opacity-10  hover:text-[white] cursor-pointer text-[23px] mr-[5px] w-[40px] h-[40px] rounded-lg border border-[white] text-center leading-[50px] flex justify-center items-center hover:border-[#0096D8]">
                        <i class="fa-brands fa-linkedin-in text-black font-bold group-hover:text-white text-xl"></i><i class=""></i>
                      </div>
                      <div class="group hover:bg-[#0096D8] bg-[#263238] bg-opacity-10  hover:text-[white] cursor-pointer text-[23px] mr-[5px] w-[40px] h-[40px] rounded-lg border border-[white] text-center leading-[50px] flex justify-center items-center hover:border-[#0096D8]">
                          <i class="fa-brands fa-facebook-f text-black font-bold group-hover:text-white text-xl"></i><i class=""></i>
                      </div>
                      <div class="group hover:bg-[#0096D8] bg-[#263238] bg-opacity-10  hover:text-[white] cursor-pointer text-[23px] mr-[5px] w-[40px] h-[40px] rounded-lg border border-[white] text-center leading-[50px] flex justify-center items-center hover:border-[#0096D8]">
                          <i class="fa-brands fa-instagram text-black font-bold group-hover:text-white text-xl"></i><i class=""></i>
                      </div>
                      <div class="group hover:bg-[#0096D8] bg-[#263238] bg-opacity-10  hover:text-[white] cursor-pointer text-[23px] mr-[5px] w-[40px] h-[40px] rounded-lg border border-[white] text-center leading-[50px] flex justify-center items-center hover:border-[#0096D8]">
                          <i class="fa-brands fa-twitter text-black font-bold group-hover:text-white text-xl"></i><i class=""></i>
                      </div>
                  </div>
                  <div class="flex justify-start items-center gap-6">
                      <div class="relative max-w-[210px] w-full">
                          <select id="countries" class="bg-white  border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-8 pr-2.5 py-2.5 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500">
                              <option selected>English</option>
                              <option value="US">ECR</option>
                          </select>
                          <img class="absolute top-[11px] left-[9px] w-5" src="./images/language.png" alt="">
                      </div>
                      <div class="relative max-w-[210px] w-full">
                          <select id="countries" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-8 pr-2.5 py-2.5 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500">
                              <option selected>English</option>
                              <option value="US">ECR</option>
                          </select>
                          <img class="absolute top-[13px] left-[16px] w-[10px] h-[15px]" src="./images/dollar.png" alt="">
                      </div>
                  </div> --}}
              </div>
          </div>
          <div class="mt-8 flex justify-between items-center gap-5 flex-wrap">
            <x-logo type="drk" home_link="/"/>
              <div>
                  <p class="text-[#263238] text-base font-medium">© Pushiii Ltd. 2023</p>
              </div>
          </div>
      </div>
  </Footer>
  <!-- Footer -->
