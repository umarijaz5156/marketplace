<div class="container lg:w-[90%] xl:max-w-[1550px] w-full mx-auto px-4" >
    <div class="flex flex-wrap mt-6 -mx-3">
        <div class="w-full max-w-full px-3 lg:w-5/12 xl:w-4/12 lg:flex-none mt-[33px] lg:mt-0">
          <div>
            <div class="grid sm:grid-cols-2 gap-y-5">
                <div class="flex justify-center items-center bg-white w-full sm:max-w-[220px] sm:w-[95%] rounded-3xl h-[220px] mb-5 xl:mb-0 mx-auto" style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">
                   <div>
                        <img class="mx-auto" src="{{ asset('images/box-icons-main/Group 1.png') }}" alt="">
                        <div class="text-center">
                            <h5 class="2xl:text-2xl xl:text-[20px] text-2xl">
                                $644
                            </h5>
                            <p>Sales</p>
                        </div>
                   </div>
                </div>
                <div class="flex justify-center items-center bg-white w-full sm:max-w-[220px] sm:w-[95%] rounded-3xl h-[220px] mb-5 xl:mb-0 border border-[#EEEFF4] mx-auto">
                    <div>
                         <img class="mx-auto" src="{{ asset('images/box-icons-main/Group 1.png') }}" alt="">
                         <div class="text-center">
                             <h5 class="2xl:text-2xl xl:text-[20px] text-2xl">
                                $11.15
                             </h5>
                             <p>Avg. Selling Price</p>
                         </div>
                    </div>
                 </div>
                 <div class="flex justify-center items-center bg-white w-full sm:max-w-[220px] sm:w-[95%] rounded-3xl h-[220px] mb-5 xl:mb-0 border border-[#EEEFF4] mx-auto">
                    <div>
                         <img class="mx-auto" src="{{ asset('images/box-icons-main/Group 1.png') }}" alt="">
                         <div class="text-center">
                             <h5 class="2xl:text-2xl xl:text-[20px] text-2xl">
                                74
                             </h5>
                             <p>Orders Completed</p>
                         </div>
                    </div>
                 </div>
                 <div class="flex justify-center items-center bg-white w-full sm:max-w-[220px] sm:w-[95%] rounded-3xl h-[220px] mb-5 xl:mb-0 border border-[#EEEFF4] mx-auto">
                    <div>
                         <img class="mx-auto"  src="{{ asset('images/box-icons-main/Group 1.png') }}" alt="">
                         <div class="text-center">
                             <h5 class="2xl:text-2xl xl:text-[20px] text-2xl font-semibold">
                                 $02
                             </h5>
                             <p>Sales in September</p>
                         </div>
                    </div>
                 </div>
            </div>
          </div>
        </div>
        <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 xl:w-8/12 lg:flex-none">
            <div class="border-black/12.5 drk:bg-slate-850 drk:shadow-drk-xl relative z-[1] flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border" style="box-shadow: rgba(43, 75, 200, 0.2) 0px 7px 29px 0px;">
              <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0 flex justify-between items-center ">
                <h6 class="capitalize drk:text-white text-[1.25rem]">Overview</h6>
                <select id="countries" class="border border-[#3858D6] px-8 py-[0.6rem] w-max rounded-full focus:ring-blue-500 focus:border-blue-500 block p-2.5 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500">
                    <option selected disabled>Month</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                  </select>
              </div>
              <div class="flex-auto p-4">
                <div>
                  <canvas id="chart-line" height="360" width="1101" class="h-[300px] lg:h-[360px]" style="display: block; box-sizing: border-box; width: 1101.6px; height: 360px;"></canvas>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
