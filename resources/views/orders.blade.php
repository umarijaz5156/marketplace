<x-app-layout>
  <x-slot name="header">
       {{-- <x-header type="simple"/> --}}
       <livewire:header type="simple">
    </x-slot>
    <!-- HeroSection -->
    <section class="mt-[74px] h-[275px] relative bg-cover bg-no-repeat flex justify-center items-center bg-center" style="background-image: url('./images/header_img.png');">
     <div>
       <div class="text-center">
           <h1 class="font-bold text-[38px]">
             Orders
           </h1>
           <p class="text-[#8f8e8d] text-[18px]">Stand out from the crowd with a thats fits your brands personality</p>
       </div>
     </div>
    </section>
    <!-- HeroSection -->

    <div class="mt-[118px]">
     <div class="container md:max-w-[900px] xl:max-w-[1450px] w-full mx-auto" >
       <div class="p-4 sm:p-6 ">
         <div class="flex justify-between items-center mb-5">
           <h1 class="text-[22px] font-semibold">Complete Orders</h1>
           <div>
             <select id="countries" class="w-[158px] bg-white border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block p-[12px]  drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
               <option selected>Last 30 Days</option>
               <option value="US">Last 25 Days</option>
               <option value="CA">Last 20 Days</option>
               <option value="FR">Last 15 Days</option>
               <option value="DE">Last 10 Days</option>
             </select>
           </div>
         </div>
         <div>
           <div class="overflow-x-auto xl:overflow-visible relative sm:rounded-lg p-2">
             <table class="w-max xl:w-full text-sm text-left text-gray-500 drk:text-gray-400 border-separate border-spacing-y-3">
                 <thead class="text-base text-[#707176] bg-[#F4F6FC] rounded-[18px] drk:bg-gray-700 drk:text-gray-400  ">
                     <tr>
                         <th scope="col" colspan="2" class="py-6 px-6 font-normal rounded-tl-[18px] rounded-bl-[18px]">
                           Gig
                         </th>
                         <th scope="col" class="py-6 px-6 font-normal">
                           Order Date
                         </th>
                         <th scope="col" class="py-6 px-6 font-normal">
                           Due On
                         </th>
                         <th scope="col" class="py-6 px-6 font-normal">
                           Total
                         </th>
                         <th scope="col" class="py-6 px-6 rounded-tr-[18px] rounded-br-[18px] font-normal">
                           Status
                         </th>
                     </tr>
                 </thead>
                 <tbody>
                   <tr class=" drk:bg-gray-800 drk:border-gray-700 hover:bg-[#3957CF] group rounded-[18px] drk:hover:bg-gray-600 hover:text-white overflow-hidden hover:scale-x-[1.02] transition-all duration-300" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                     <td class="py-4 px-6 rounded-tl-[18px] rounded-bl-[18px]" colspan="2">
                       <div class="flex justify-start items-center gap-x-5">
                         <img  src="{{ asset('images/Rounded Rectangle 40 copy 3.png') }}" alt="">
                         <p class="mt-[10px] lg:mt-0">Do clean professional web landing page UI / UX design figma</p>
                       </div>
                     </td>
                     <td class="py-4 px-6">
                         16.02.2022
                     </td>
                     <td class="py-4 px-6">
                         19.02.2022
                     </td>
                     <td class="py-4 px-6">
                         $211
                     </td>
                     <td class="py-4 px-6 rounded-tr-[18px] rounded-br-[18px] ">
                         <a href="#" class="font-medium group-hover:text-white group-hover:border-white text-[#2646C4] text-[15px] border rounded-full border-[#3959D6] drk:text-blue-500 py-3 px-4">Order Again</a>
                     </td>
                   </tr>
                     <tr class=" drk:bg-gray-800 drk:border-gray-700 hover:bg-[#3957CF] group rounded-[18px] drk:hover:bg-gray-600 hover:text-white overflow-hidden hover:scale-x-[1.02] transition-all duration-300" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                       <td class="py-4 px-6 rounded-tl-[18px] rounded-bl-[18px]" colspan="2">
                         <div class="flex justify-start items-center gap-x-5">
                           <img  src="{{ asset('images/Rounded Rectangle 40 copy 3.png')}}" alt="">
                           <p class="mt-[10px] lg:mt-0">Do clean professional web landing page UI / UX design figma</p>
                         </div>
                       </td>
                       <td class="py-4 px-6">
                           16.02.2022
                       </td>
                       <td class="py-4 px-6">
                           19.02.2022
                       </td>
                       <td class="py-4 px-6">
                           $211
                       </td>
                       <td class="py-4 px-6 rounded-tr-[18px] rounded-br-[18px]">
                          <a href="#" class="font-medium group-hover:text-white group-hover:border-white text-[#2646C4] text-[15px] border rounded-full border-[#3959D6] drk:text-blue-500 py-3 px-4">Order Again</a>
                       </td>
                     </tr>
                     <tr class=" drk:bg-gray-800 drk:border-gray-700 hover:bg-[#3957CF] group rounded-[18px] drk:hover:bg-gray-600 hover:text-white overflow-hidden hover:scale-x-[1.02] transition-all duration-300" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                       <td class="py-4 px-6 rounded-tl-[18px] rounded-bl-[18px]" colspan="2">
                         <div class="flex justify-start items-center gap-x-5">
                           <img  src="{{ asset('images/Rounded Rectangle 40 copy 3.png')}}" alt="">
                           <p class="mt-[10px] lg:mt-0">Do clean professional web landing page UI / UX design figma</p>
                         </div>
                       </td>
                       <td class="py-4 px-6">
                           16.02.2022
                       </td>
                       <td class="py-4 px-6">
                           19.02.2022
                       </td>
                       <td class="py-4 px-6">
                           $211
                       </td>
                       <td class="py-4 px-6 rounded-tr-[18px] rounded-br-[18px]">
                          <a href="#" class="font-medium group-hover:text-white group-hover:border-white text-[#2646C4] text-[15px] border rounded-full border-[#3959D6] drk:text-blue-500 py-3 px-4">Order Again</a>
                       </td>
                     </tr>
                     <tr class=" drk:bg-gray-800 drk:border-gray-700 hover:bg-[#3957CF] group rounded-[18px] drk:hover:bg-gray-600 hover:text-white overflow-hidden hover:scale-x-[1.02] transition-all duration-300" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                       <td class="py-4 px-6 rounded-tl-[18px] rounded-bl-[18px]" colspan="2">
                         <div class="flex justify-start items-center gap-x-5">
                           <img  src="{{ asset('images/Rounded Rectangle 40 copy 3.png')}}" alt="">
                           <p class="mt-[10px] lg:mt-0">Do clean professional web landing page UI / UX design figma</p>
                         </div>
                       </td>
                       <td class="py-4 px-6">
                           16.02.2022
                       </td>
                       <td class="py-4 px-6">
                           19.02.2022
                       </td>
                       <td class="py-4 px-6">
                           $211
                       </td>
                       <td class="py-4 px-6 rounded-tr-[18px] rounded-br-[18px]">
                          <a href="#" class="font-medium group-hover:text-white group-hover:border-white text-[#2646C4] text-[15px] border rounded-full border-[#3959D6] drk:text-blue-500 py-3 px-4">Order Again</a>
                       </td>
                     </tr>
                     <tr class=" drk:bg-gray-800 drk:border-gray-700 hover:bg-[#3957CF] group rounded-[18px] drk:hover:bg-gray-600 hover:text-white overflow-hidden hover:scale-x-[1.02] transition-all duration-300" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                       <td class="py-4 px-6 rounded-tl-[18px] rounded-bl-[18px]" colspan="2">
                         <div class="flex justify-start items-center gap-x-5">
                           <img  src="{{ asset('images/Rounded Rectangle 40 copy 3.png')}}" alt="">
                           <p class="mt-[10px] lg:mt-0">Do clean professional web landing page UI / UX design figma</p>
                         </div>
                       </td>
                       <td class="py-4 px-6">
                           16.02.2022
                       </td>
                       <td class="py-4 px-6">
                           19.02.2022
                       </td>
                       <td class="py-4 px-6">
                           $211
                       </td>
                       <td class="py-4 px-6 rounded-tr-[18px] rounded-br-[18px]">
                          <a href="#" class="font-medium group-hover:text-white group-hover:border-white text-[#2646C4] text-[15px] border rounded-full border-[#3959D6] drk:text-blue-500 py-3 px-4">Order Again</a>
                       </td>
                     </tr>
                 </tbody>
             </table>
           </div>
           <div class="text-center mt-12">
             <div class="my-5">
               <nav class="flex flex-row flex-nowrap justify-between md:justify-center items-center" aria-label="Pagination">
                 <a class="flex w-10 h-10 mr-1 justify-center items-center rounded-full border border-gray-200 bg-white text-black hover:border-gray-300" href="#" title="Previous Page">
                     <span class="sr-only">Previous Page</span>
                     <svg class="block w-4 h-4 fill-current" viewBox="0 0 256 512" aria-hidden="true" role="presentation">
                         <path d="M238.475 475.535l7.071-7.07c4.686-4.686 4.686-12.284 0-16.971L50.053 256 245.546 60.506c4.686-4.686 4.686-12.284 0-16.971l-7.071-7.07c-4.686-4.686-12.284-4.686-16.97 0L10.454 247.515c-4.686 4.686-4.686 12.284 0 16.971l211.051 211.05c4.686 4.686 12.284 4.686 16.97-.001z"></path>
                     </svg>
                 </a>
                 <a class="hidden md:flex w-10 h-10 mx-1 justify-center items-center rounded-full border border-gray-200 bg-white text-black hover:border-gray-300" href="#" title="Page 1">
                     1
                 </a>
                 <a class="hidden md:flex w-10 h-10 mx-1 justify-center items-center rounded-full border border-gray-200 bg-white text-black hover:border-gray-300" href="#" title="Page 2">
                     2
                 </a>
                 <a class="hidden md:flex w-10 h-10 mx-1 justify-center items-center rounded-full border border-[#3252cf] bg-[#3252cf] text-white pointer-events-none drop-shadow-[0px_2px_11px_rgba(43,75,200,0.4)]" href="#" aria-current="page" title="Page 3">
                     3
                 </a>
                 <a class="hidden md:flex w-10 h-10 mx-1 justify-center items-center rounded-full border border-gray-200 bg-white text-black hover:border-gray-300" href="#" title="Page 4">
                     4
                 </a>
                 <a class="hidden md:flex w-10 h-10 mx-1 justify-center items-center rounded-full border border-gray-200 bg-white text-black hover:border-gray-300" href="#" title="Page 5">
                     5
                 </a>
                 <a class="flex w-10 h-10 ml-1 justify-center items-center rounded-full border border-gray-200 bg-white text-black hover:border-gray-300" href="#" title="Next Page">
                     <span class="sr-only">Next Page</span>
                     <svg class="block w-4 h-4 fill-current" viewBox="0 0 256 512" aria-hidden="true" role="presentation">
                         <path d="M17.525 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L205.947 256 10.454 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L34.495 36.465c-4.686-4.687-12.284-4.687-16.97 0z"></path>
                     </svg>
                 </a>
               </nav>
             </div>
         </div>
         </div>
       </div>
      </div>
    </div>

     <!-- Inspired by work  -->
     {{-- <div class="relative before:content-[''] before:absolute before:w-[100%] before:bottom-[-25px] before:bg-[#f4f5fc] before:h-[300px] before:-z-[1]">
       <div class=" mt-[50px] md:mt-[88px]">
         <div class="text-center">
           <h1 class="text-[26px] md:text-[42px] font-bold">Inspired By Your <span class="font-[400]">Shopping Trends</span></h1>
         </div>
         <div class="mt-12">
           <div class="freelance-slider">
             <div>
               <div class="flex justify-center items-center relative z-10">
                 <div class="max-w-[410px] w-[95%] mx-auto inline-block ">
                   <div class=" bg-white rounded-3xl border border-gray-200 shadow-md drk:bg-gray-800 drk:border-gray-700 group mb-4">
                     <div class="p-3">
                       <a href="#">
                         <img class="rounded-3xl mx-auto w-full h-[240px]" src="{{ asset('images/card_img1.png') }}" alt="" />
                       </a>
                     </div>
                     <div class="px-6 py-4">
                       <div class="border-b border-[rgba(0,0,0,.125)] pb-2">
                         <a href="#">
                           <h3 class="text-[#1f1f1f] text-[17px] mb-3">
                             I will Design 3 Flat Minimalist Logo Design
                           </h3>
                         </a>
                           <div class="flex justify-between items-center mb-2">
                             <h4>Starting At</h4>
                             <div class="flex justify-start items-center">
                               <i class="fa fa-star text-[#ffb33e]" aria-hidden="true"><span> 4.9 </span></i>
                               <p class="text-[#979797] text-[17px]">(1K+)</p>
                             </div>
                           </div>
                           <div>
                             <p class="text-[#2646c4] text-[16px]">$<span class="text-[25px] font-bold">35</span></p>
                           </div>
                       </div>
                       <div class="flex justify-between items-center">
                         <div class="flex justify-start items-center mt-3">
                           <div class="relative after:content-[''] after:absolute after:bottom-[17%] after:z-[1] after:rounded-full after:h-[10px] after:w-[10px] after:bg-green-700  after:right-[-4%] after:border after:border-white">
                             <img class="rounded-full min-w-[40px] h-[40px] object-cover" src="{{ asset('images/user_6.png') }}" alt="">
                           </div>
                           <div class="ml-2">
                             <h4>Fallanzado</h4>
                             <p>Level 2 Seller</p>
                           </div>
                         </div>
                         <div>
                           <i class="fa-regular fa-heart text-[20px] text-[#aeaeae] cursor-pointer group-hover:text-[red]"></i>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
             <div>
               <div class="flex justify-center items-center">
                 <div class="max-w-[410px] w-[95%] mx-auto inline-block ">
                   <div class=" bg-white rounded-3xl border border-gray-200 shadow-md drk:bg-gray-800 drk:border-gray-700 group mb-4">
                     <div class="p-3">
                       <a href="#">
                         <img class="rounded-3xl mx-auto w-full h-[240px]" src="{{ asset('images/card_img1.png') }}" alt="" />
                       </a>
                     </div>
                     <div class="px-6 py-4">
                       <div class="border-b border-[rgba(0,0,0,.125)] pb-2">
                         <a href="#">
                           <h3 class="text-[#1f1f1f] text-[17px] mb-3">
                             I will Design 3 Flat Minimalist Logo Design
                           </h3>
                         </a>
                           <div class="flex justify-between items-center mb-2">
                             <h4>Starting At</h4>
                             <div class="flex justify-start items-center">
                               <i class="fa fa-star text-[#ffb33e]" aria-hidden="true"><span> 4.9 </span></i>
                               <p class="text-[#979797] text-[17px]">(1K+)</p>
                             </div>
                           </div>
                           <div>
                             <p class="text-[#2646c4] text-[16px]">$<span class="text-[25px] font-bold">35</span></p>
                           </div>
                       </div>
                       <div class="flex justify-between items-center">
                         <div class="flex justify-start items-center mt-3">
                           <div class="relative after:content-[''] after:absolute after:bottom-[17%] after:z-[1] after:rounded-full after:h-[10px] after:w-[10px] after:bg-green-700  after:right-[-4%] after:border after:border-white">
                             <img class="rounded-full min-w-[40px] h-[40px] object-cover" src="{{ asset('images/user_6.png') }}" alt="">
                           </div>
                           <div class="ml-2">
                             <h4>Fallanzado</h4>
                             <p>Level 2 Seller</p>
                           </div>
                         </div>
                         <div>
                           <i class="fa-regular fa-heart text-[20px] text-[#aeaeae] cursor-pointer group-hover:text-[red]"></i>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
             <div>
               <div class="flex justify-center items-center">
                 <div class="max-w-[410px] w-[95%] mx-auto inline-block ">
                   <div class=" bg-white rounded-3xl border border-gray-200 shadow-md drk:bg-gray-800 drk:border-gray-700 group mb-4">
                     <div class="p-3">
                       <a href="#">
                         <img class="rounded-3xl mx-auto w-full h-[240px]" src="{{ asset('images/card_img1.png') }}" alt="" />
                       </a>
                     </div>
                     <div class="px-6 py-4">
                       <div class="border-b border-[rgba(0,0,0,.125)] pb-2">
                         <a href="#">
                           <h3 class="text-[#1f1f1f] text-[17px] mb-3">
                             I will Design 3 Flat Minimalist Logo Design
                           </h3>
                         </a>
                           <div class="flex justify-between items-center mb-2">
                             <h4>Starting At</h4>
                             <div class="flex justify-start items-center">
                               <i class="fa fa-star text-[#ffb33e]" aria-hidden="true"><span> 4.9 </span></i>
                               <p class="text-[#979797] text-[17px]">(1K+)</p>
                             </div>
                           </div>
                           <div>
                             <p class="text-[#2646c4] text-[16px]">$<span class="text-[25px] font-bold">35</span></p>
                           </div>
                       </div>
                       <div class="flex justify-between items-center">
                         <div class="flex justify-start items-center mt-3">
                           <div class="relative after:content-[''] after:absolute after:bottom-[17%] after:z-[1] after:rounded-full after:h-[10px] after:w-[10px] after:bg-green-700  after:right-[-4%] after:border after:border-white">
                             <img class="rounded-full min-w-[40px] h-[40px] object-cover" src="{{ asset('images/user_6.png') }}" alt="">
                           </div>
                           <div class="ml-2">
                             <h4>Fallanzado</h4>
                             <p>Level 2 Seller</p>
                           </div>
                         </div>
                         <div>
                           <i class="fa-regular fa-heart text-[20px] text-[#aeaeae] cursor-pointer group-hover:text-[red]"></i>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
             <div>
               <div class="flex justify-center items-center">
                 <div class="max-w-[410px] w-[95%] mx-auto inline-block ">
                   <div class=" bg-white rounded-3xl border border-gray-200 shadow-md drk:bg-gray-800 drk:border-gray-700 group mb-4">
                     <div class="p-3">
                       <a href="#">
                         <img class="rounded-3xl mx-auto w-full h-[240px]" src="{{ asset('images/card_img1.png') }}" alt="" />
                       </a>
                     </div>
                     <div class="px-6 py-4">
                       <div class="border-b border-[rgba(0,0,0,.125)] pb-2">
                         <a href="#">
                           <h3 class="text-[#1f1f1f] text-[17px] mb-3">
                             I will Design 3 Flat Minimalist Logo Design
                           </h3>
                         </a>
                           <div class="flex justify-between items-center mb-2">
                             <h4>Starting At</h4>
                             <div class="flex justify-start items-center">
                               <i class="fa fa-star text-[#ffb33e]" aria-hidden="true"><span> 4.9 </span></i>
                               <p class="text-[#979797] text-[17px]">(1K+)</p>
                             </div>
                           </div>
                           <div>
                             <p class="text-[#2646c4] text-[16px]">$<span class="text-[25px] font-bold">35</span></p>
                           </div>
                       </div>
                       <div class="flex justify-between items-center">
                         <div class="flex justify-start items-center mt-3">
                           <div class="relative after:content-[''] after:absolute after:bottom-[17%] after:z-[1] after:rounded-full after:h-[10px] after:w-[10px] after:bg-green-700  after:right-[-4%] after:border after:border-white">
                             <img class="rounded-full min-w-[40px] h-[40px] object-cover" src="{{ asset('images/user_6.png') }}" alt="">
                           </div>
                           <div class="ml-2">
                             <h4>Fallanzado</h4>
                             <p>Level 2 Seller</p>
                           </div>
                         </div>
                         <div>
                           <i class="fa-regular fa-heart text-[20px] text-[#aeaeae] cursor-pointer group-hover:text-[red]"></i>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
             <div>
               <div class="flex justify-center items-center">
                 <div class="max-w-[410px] w-[95%] mx-auto inline-block ">
                   <div class=" bg-white rounded-3xl border border-gray-200 shadow-md drk:bg-gray-800 drk:border-gray-700 group mb-4">
                     <div class="p-3">
                       <a href="#">
                         <img class="rounded-3xl mx-auto w-full h-[240px]" src="{{ asset('images/card_img1.png') }}" alt="" />
                       </a>
                     </div>
                     <div class="px-6 py-4">
                       <div class="border-b border-[rgba(0,0,0,.125)] pb-2">
                         <a href="#">
                           <h3 class="text-[#1f1f1f] text-[17px] mb-3">
                             I will Design 3 Flat Minimalist Logo Design
                           </h3>
                         </a>
                           <div class="flex justify-between items-center mb-2">
                             <h4>Starting At</h4>
                             <div class="flex justify-start items-center">
                               <i class="fa fa-star text-[#ffb33e]" aria-hidden="true"><span> 4.9 </span></i>
                               <p class="text-[#979797] text-[17px]">(1K+)</p>
                             </div>
                           </div>
                           <div>
                             <p class="text-[#2646c4] text-[16px]">$<span class="text-[25px] font-bold">35</span></p>
                           </div>
                       </div>
                       <div class="flex justify-between items-center">
                         <div class="flex justify-start items-center mt-3">
                           <div class="relative after:content-[''] after:absolute after:bottom-[17%] after:z-[1] after:rounded-full after:h-[10px] after:w-[10px] after:bg-green-700  after:right-[-4%] after:border after:border-white">
                             <img class="rounded-full min-w-[40px] h-[40px] object-cover" src="{{ asset('images/user_6.png') }}" alt="">
                           </div>
                           <div class="ml-2">
                             <h4>Fallanzado</h4>
                             <p>Level 2 Seller</p>
                           </div>
                         </div>
                         <div>
                           <i class="fa-regular fa-heart text-[20px] text-[#aeaeae] cursor-pointer group-hover:text-[red]"></i>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>

     </div> --}}
     <livewire:home-page.inspired-work />


 </x-app-layout>
