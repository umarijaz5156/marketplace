<x-app-layout>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Hero Section -->
    <section class="bg-[#F4FCFF] lg:min-h-[85vh] flex items-center  ">
        <div class="container 2xl:max-w-screen-2xl mx-auto px-4 h-full">
            <div class="grid lg:grid-cols-2 py-6 lg:py-0">
                <div class="flex items-center">
                    <div class="space-y-6 max-w-lg"  data-aos="fade-right">
                        <div>
                            <h1 class="text-3xl sm:text-6xl sm:leading-[70px] text-[#263238]">Become a TheHotBleep Seller to unlock countless <span class="text-[#0096D8] font-bold">Freelance opportunities </span></h1>
                            <p class="text-[#263238] font-normal text-xl mt-4"> Create a compelling seller account to boost off your special skill and reach buyers.</p>
                        </div>
                        <div class="">
                            <a href="{{route('seller-register')}}">
                            <button class="bg-[#0096D8] text-white p-[21px_36px_21px_36px] rounded mt-9">Become a Seller</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class=""  data-aos="fade-left">
                    <img class="mx-auto max-w-[640px] w-full" src="{{asset('images/bwcome Seller/become-seller-hero.png')}}" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section -->

 <!-- Join Our Growing -->
    <section class="my-20 sm:my-40">
        <livewire:become-seller.freelance-carousal/>
    </div>
   <!-- Join Our Growing -->

   <!-- How it Works -->
   <section class="my-20 sm:my-40" data-aos="fade-up">
    <div class="container 2xl:max-w-screen-2xl mx-auto px-4 h-full">
        <div class="max-w-xl">
            <h1 class="text-4xl sm:text-5xl sm:leading-[70px] font-semibold text-[#263238]">How<span class="text-[#0096D8]">  TheHotBleep  </span> Works</h1>
            <p class="text-lg text-[#6A6A6A] font-normal">
                TheHotBleep offers a safe and secure work space where sellers can interact with buyers and crack a deal
            </p>
        </div>
        <div class="grid sm:grid-cols-3 gap-4 mt-16">
            <div class="relative before:absolute grid before:content-[''] before:bg-[#0096D8] before:bg-opacity-10 before:w-[96px] before:h-[96px] before:rounded-[10px] before:left-[4px] before:top-[70px] lg:before:left-[26px] lg:before:top-[77px] border-2 border-transparent hover:border-[#0096D8] rounded-xl px-4 py-10 lg:px-10 lg:py-14">
                <span class="absolute md:right-3 top-2 text-7xl right-0  md:text-8xl font-bold opacity-5">01</span>
                <img src="{{asset('images/bwcome Seller/list-1.png')}}" alt="">
                <h1 class="text-[#263238] font-bold text-2xl my-4">Create a Service</h1>
                <p class="text-sm text-[#6A6A6A] font-medium ">Sell your skill by creating a relevant service that introduces your skill to the buyer. Make sure to use concise and specific information to boost off your skillset.</p>
            </div>
            <div class="relative before:absolute grid before:content-[''] before:bg-[#0096D8] before:bg-opacity-10 before:w-[96px] before:h-[96px] before:rounded-[10px] before:left-[4px] before:top-[70px] lg:before:left-[26px] lg:before:top-[77px] border-2 border-transparent hover:border-[#0096D8] rounded-xl px-4 py-10 lg:px-10 lg:py-14">
                <span class="absolute md:right-3 top-2 text-7xl right-0  md:text-8xl font-bold opacity-5">02</span>
                <img src="{{asset('images/bwcome Seller/work-from-home.png')}}" alt="">
                <h1 class="text-[#263238] font-bold text-2xl my-4">Deliver the project</h1>
                <p class="text-sm text-[#6A6A6A] font-medium ">Complete the project as per buyers’ specifications and deliver the project in pre-set time. </p>
            </div>
            <div class="relative before:absolute grid before:content-[''] before:bg-[#0096D8] before:bg-opacity-10 before:w-[96px] before:h-[96px] before:rounded-[10px] before:left-[4px] before:top-[70px] lg:before:left-[26px] lg:before:top-[77px] border-2 border-transparent hover:border-[#0096D8] rounded-xl px-4 py-10 lg:px-10 lg:py-14">
                <span class="absolute md:right-3 top-2 text-7xl right-0  md:text-8xl font-bold opacity-5">03</span>
                <img src="{{asset('images/bwcome Seller/bill.png')}}" alt="">
                <h1 class="text-[#263238] font-bold text-2xl my-4">Get Paid</h1>
                <p class="text-sm text-[#6A6A6A] font-medium ">Once you deliver the project, you will get your pre-set payment from client.</p>
            </div>
        </div>
    </div>
    </section>


    <!-- Tesrimonial Section -->
  <section class="my-20 sm:my-40 bg-[#F4FCFF] py-[7.5rem]">
    <livewire:become-seller.testimonial-section />
  </section>
  <!-- Tesrimonial Section -->

  <!-- Accordian Section -->
  <section class="my-20 sm:my-40">
  <x-faqs title=""/>
  </section>

  <!-- Accordian Section -->

  <!-- SignUp Section -->
  <section class="my-20 sm:my-40" data-aos="fade-up">
    <div class="container 2xl:max-w-screen-2xl mx-auto px-4 h-full">
        <div class="bg-[#F4FCFF] w-full rounded-3xl sm:px-16 px-7 py-9 sm:py-28 relative growing-div">
            <div class="swiper growing-slider">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <div class="grid lg:grid-cols-2 gap-10 items-center">
                        <div class="space-y-5">
                            <h1 class="text-4xl xl:text-5xl xl:leading-[70px] font-semibold text-[#263238]">Work in flexible hours from the    <span class="text-[#0096D8]"> comfort of your home</span></h1>
                            <p class="text-lg text-[#6A6A6A] font-normal">
                                {{-- It seems that only fragments of the original text remain in theLorem Ipsum texts used today. --}}
                            </p>
                            <div class="">
                                <a href="{{route('seller-register')}}" class="inline-block text-white bg-[#0096D8] rounded p-4 uppercase font-medium hover:bg-blue-800 focus:ring-4 " style="box-shadow: 0px 18px 20px rgba(0, 150, 216, 0.1);">
                                    GET STARTED
                                </a>
                            </div>
                        </div>
                        <div>
                            <img class="mx-auto" src="{{ asset('images/newui/designer-girl-.png') }}" alt="">
                        </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="grid lg:grid-cols-2 gap-10 items-center">
                        <div class="space-y-5">
                            <h1 class="text-4xl xl:text-5xl xl:leading-[70px] font-semibold text-[#263238]">Do not pay for commute and enjoy   <span class="text-[#0096D8]"> all your earnings</span></h1>
                            <p class="text-lg text-[#6A6A6A] font-normal">
                                {{-- It seems that only fragments of the original text remain in theLorem Ipsum texts used today. --}}
                            </p>
                            <div class="">
                                <a href="{{route('seller-register')}}" class="inline-block text-white bg-[#0096D8] rounded p-4 uppercase font-medium hover:bg-blue-800 focus:ring-4 " style="box-shadow: 0px 18px 20px rgba(0, 150, 216, 0.1);">
                                    GET STARTED
                                </a>
                            </div>
                        </div>
                        <div>
                            <img class="mx-auto" src="{{ asset('images/newui/designer-girl-.png') }}" alt="">
                        </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="grid lg:grid-cols-2 gap-10 items-center">
                        <div class="space-y-5">
                            <h1 class="text-4xl xl:text-5xl xl:leading-[70px] font-semibold text-[#263238]">Stay-at-home mom?  <span class="text-[#0096D8]">  Don’t worry!</span></h1>
                            <p class="text-lg text-[#6A6A6A] font-normal">
                                You can still work. All you need is passion to work and a seller account at TheHotBleep
                            </p>
                            <div class="">
                                <a href="{{route('seller-register')}}" class="inline-block text-white bg-[#0096D8] rounded p-4 uppercase font-medium hover:bg-blue-800 focus:ring-4 " style="box-shadow: 0px 18px 20px rgba(0, 150, 216, 0.1);">
                                    GET STARTED
                                </a>
                            </div>
                        </div>
                        <div>
                            <img class="mx-auto" src="{{ asset('images/newui/designer-girl-.png') }}" alt="">
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
 </section>
</div>
</x-app-layout>

