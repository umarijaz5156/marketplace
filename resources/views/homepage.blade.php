
<x-app-layout>

    @slot('header')
        @livewire('new-header')
    @endslot
<section class="py-28 lg:py-30 relative flex justify-center items-center">
    <div class="bg-[#0BA1E5] w-full h-full absolute top-0 left-0 right-0 bottom-0 clipPath"></div>
    <div class="container xl:max-w-screen-2xl mx-auto px-4 relative">
        <div class="grid lg:grid-cols-2 gap-5">
            <div class="flex justify-start items-center">
                <div class="mt-10 lg:mt-0">
                    <h1 class="text-white text-4xl md:text-5xl leading-tight font-bold">
                        The Future of Healthcare work is Remote, <br />
                        Smart and undenaibly Flexible
                    </h1>
                    <h2 class="text-white text-2xl md:text-4xl leading-tight mt-3">
                        Got skills? This is your stage to shine and share your healthcare genius with the world.
                    </h2>
                    <div class="bg-white w-20 h-1.5 rounded-full mt-5"></div>
                    <p class="text-white mt-6 md:text-lg">
                        Healthcare is demanding, but there is no need to juggle it all on your own; find a freelancer to share the load.

                    </p>
                    <livewire:search-autocomplete-v2 />

                </div>
            </div>
            <div class="hidden lg:flex justify-end items-center">
                <img src="{{ asset('new-images/header-img.png') }}" alt="" />
            </div>
        </div>
    </div>
</section>
<section class="py-14 bg-[#FAFAFF]">
    <div class="container xl:max-w-screen-2xl mx-auto px-4 relative">
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-7">
            <div class="flex justify-start items-center md:col-span-1 col-span-2">
                <h1 class="text-lg font-medium">Trusted By:</h1>
            </div>
            <div class="flex justify-start items-center">
                <img class="" src="{{asset('images/newui/logo-autods.svg')}}" alt="" />
            </div>
            <div class="flex justify-start items-center">
                <img src="{{asset('images/newui/1.3.png')}}" alt="" />
            </div>
            <div class="flex justify-start items-center">
                <img src="{{asset('images/newui/peeksta.png')}}" alt="" />
            </div>
            <div class="flex justify-start items-center">
                <img class=" w-40 sm:w-[90px]" src="{{asset('images/newui/bw.jpg')}}" alt="" />
            </div>
            <div class="flex justify-start items-center">
                <img class="bg-gray-600  p-2" src="{{asset('images/newui/incard.png')}}" alt="" />
            </div>

        </div>
    </div>
</section>

<section>
    <x-HomePage.popular-categories :popularCategories="$popularCategories" />
</section>

<section class="mt-10 md:mt-20">
    <div class="container xl:max-w-screen-2xl mx-auto px-4">
        <div class="space-y-2">
            <h1 class="text-black font-semibold text-4xl md:text-5xl">
                Special Services
              </h1>
            <p class="text-sm font-light">
                Most Popular & Top Selling Services will be provided
            </p>
        </div>
     {{-- popluar professional services --}}
     <livewire:home-page.popular-services>
    </div>


</section>

<section class="mt-10 md:mt-20">
    <div class="container xl:max-w-screen-2xl mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-5">
            <div class="flex items-center">
                <div>
                    <div class="space-y-2">
                        <p class="text-sm font-light">hotmoon.com</p>
                        <h1 class="text-black font-semibold text-4xl md:text-5xl">
                            Find freelancing
                            <span class="text-primary"> Hustlers </span>
                        </h1>
                    </div>
                    <ul class="mt-10 space-y-3">
                        <li class="flex justify-start items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="16" viewBox="0 0 25 16"
                                fill="none">
                                <mask id="mask0_14_133" style="mask-type: luminance" maskUnits="userSpaceOnUse" x="0"
                                    y="0" width="25" height="16">
                                    <path d="M1 9.06399L5.18607 13.2501L16.4361 2" stroke="white" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6.75586 9.06399L10.9419 13.2501L22.192 2" stroke="black" stroke-width="4"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6.75586 9.06399L10.9419 13.2501L22.192 2" stroke="white" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </mask>
                                <g mask="url(#mask0_14_133)">
                                    <path d="M24.0234 -5.06398H-1.09302V20.0524H24.0234V-5.06398Z" fill="#0BA1E5" />
                                </g>
                            </svg>
                            <p>Hook up with freelancers who've mastered the biz, all seasoned and ready to roll.</p>
                        </li>
                        <li class="flex justify-start items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="16" viewBox="0 0 25 16"
                                fill="none">
                                <mask id="mask0_14_133" style="mask-type: luminance" maskUnits="userSpaceOnUse" x="0"
                                    y="0" width="25" height="16">
                                    <path d="M1 9.06399L5.18607 13.2501L16.4361 2" stroke="white" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6.75586 9.06399L10.9419 13.2501L22.192 2" stroke="black" stroke-width="4"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6.75586 9.06399L10.9419 13.2501L22.192 2" stroke="white" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </mask>
                                <g mask="url(#mask0_14_133)">
                                    <path d="M24.0234 -5.06398H-1.09302V20.0524H24.0234V-5.06398Z" fill="#0BA1E5" />
                                </g>
                            </svg>
                            <p>
                                Pick your freelancer champ based on your budget and what you're aiming for—direct and hassle-free.
                            </p>
                        </li>
                        <li class="flex justify-start items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="16" viewBox="0 0 25 16"
                                fill="none">
                                <mask id="mask0_14_133" style="mask-type: luminance" maskUnits="userSpaceOnUse" x="0"
                                    y="0" width="25" height="16">
                                    <path d="M1 9.06399L5.18607 13.2501L16.4361 2" stroke="white" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6.75586 9.06399L10.9419 13.2501L22.192 2" stroke="black" stroke-width="4"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6.75586 9.06399L10.9419 13.2501L22.192 2" stroke="white" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </mask>
                                <g mask="url(#mask0_14_133)">
                                    <path d="M24.0234 -5.06398H-1.09302V20.0524H24.0234V-5.06398Z" fill="#0BA1E5" />
                                </g>
                            </svg>
                            <p>
                                Discuss, Share & give feedback all within HOTBLEEP Seller
                                Dashboard.
                            </p>
                        </li>
                        <li class="flex justify-start items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="16" viewBox="0 0 25 16"
                                fill="none">
                                <mask id="mask0_14_133" style="mask-type: luminance" maskUnits="userSpaceOnUse" x="0"
                                    y="0" width="25" height="16">
                                    <path d="M1 9.06399L5.18607 13.2501L16.4361 2" stroke="white" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6.75586 9.06399L10.9419 13.2501L22.192 2" stroke="black" stroke-width="4"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M6.75586 9.06399L10.9419 13.2501L22.192 2" stroke="white" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </mask>
                                <g mask="url(#mask0_14_133)">
                                    <path d="M24.0234 -5.06398H-1.09302V20.0524H24.0234V-5.06398Z" fill="#0BA1E5" />
                                </g>
                            </svg>
                            <p>
                                Swap ideas, and fine-tune your plans, all while kicking back in the Seller Dashboard. Why mention it twice? Because it's so slick, it deserves a double shout-out.
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="flex justify-center lg:justify-end">
                <img class="max-w-[560px] w-full" src="{{ asset('new-images/new-image-2.png') }}" alt="" />
            </div>
        </div>
    </div>
</section>

<section class="mt-10 md:mt-20">
    <livewire:home-page.store-services />

</section>

<section class="mt-10 md:mt-20">

    <div class="container xl:max-w-screen-2xl mx-auto px-4">
        <div class="rounded-[40px] w-full bg-[#15A5E6] bg-opacity-20 py-20 px-10">
            <div class="sm:text-center">
                <h1 class="text-black font-semibold text-3xl sm:text-4xl md:text-5xl">
                    A Whole World of <span class="text-primary">Freelance </span>
                    <br class="hidden md:block" />
                    <span class="text-primary"> Talent </span> at Your Fingertips
                </h1>
            </div>

            <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-4 gap-4 max-w-6xl mx-auto">
                <div class="bg-white rounded-xl shadow-lg py-8 px-5">
                    <div class="flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="44"
                            height="44" viewBox="0 0 44 44" fill="none">
                            <rect width="44" height="44" fill="url(#pattern0)" />
                            <defs>
                                <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image0_17_317" transform="scale(0.0238095)" />
                                </pattern>
                                <image id="image0_17_317" width="42" height="42"
                                    xlink:href="data:image/png;base64,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" />
                            </defs>
                        </svg>
                    </div>
                    <div class="mt-4 text-center">
                        <h1 class="text-primary font-bold text-lg">
                            Boost Your Income<br />

                        </h1>
                        <p class="mt-2">Shine by moonlighting and turn your skills into extra cash.</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-lg py-8 px-5">
                    <div class="flex justify-center items-center">
                        <img src="./new-images/hands-svg.svg" alt="" />
                    </div>
                    <div class="mt-4 text-center">
                        <h1 class="text-primary font-bold text-lg">
                            Save time
                        </h1>
                        <p class="mt-2">
                            Get an expert for your needs and elevate your project without breaking the bank.
                        </p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-lg py-8 px-5">
                    <div class="flex justify-center items-center">
                        <img src="./new-images/247.svg" alt="" />
                    </div>
                    <div class="mt-4 text-center">
                        <h1 class="text-primary font-bold text-lg">
                            Boost Your Income
                        </h1>
                        <p class="mt-2">
                            Shine by moonlighting and turn your skills into extra cash.
                        </p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-lg py-8 px-5">
                    <div class="flex justify-center items-center">
                        <img src="./new-images/dollar-hand.svg" alt="" />
                    </div>
                    <div class="mt-4 text-center">
                        <h1 class="text-primary font-bold text-lg">
                            High Quality ,<br />
                            Swift Results
                        </h1>
                        <p class="mt-2">Snag the ideal freelancer to jumpstart your project today.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mt-10 md:mt-20">
    <livewire:home-page.videoad-services />

</section>

<section class="mt-10 md:mt-20">
    <div class="container xl:max-w-screen-2xl mx-auto px-4">
        <div class="flex justify-between items-center gap-20">
            <div class="hidden lg:block xl:w-auto w-full">
                <img class="" src="{{ asset('new-images/new-image-3.png') }}" alt="" />
            </div>
            <div class="md:max-w-4xl">
                <div class="lg:mt-10">
                    <div class="bg-black rounded-[40px] py-10 md:py-20 px-6 md:px-12">
                        <div class="">
                            <div class="text-white">
                                <h1 class="text-3xl md:text-5xl font-semibold">
                                    Join the theHotBleep Affiliate Program
                                </h1>
                                <p class="tex-xl font-medium mt-6">
                                    Join the theHotBleep Affiliate Program
                                    Unlock a world where spreading the word pays off. Become an affiliate and get in on the action—where sharing leads to earning. Why just watch when you can play and profit?
                                </p>
                                <a
 href="{{ route('home.search_gigs') }}"><button type="button"    class="align-middle select-none font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none py-3 px-6 rounded-lg bg-[#0BA1E5] text-white shadow-md shadow-[#0BA1E5]/10 hover:shadow-lg hover:shadow-[#0BA1E5]/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none mt-16"
                                    data-ripple-light="true">
                                    Join Affiliate Program</button>
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mt-10 md:mt-20">
    <div class="container xl:max-w-screen-2xl mx-auto px-4 relative">
        <div class="space-y-2">
            <h1 class="text-black font-semibold text-3xl md:text-5xl">
                Professional <span class="text-primary"> Vetted & Expert</span>  Freelancers
            </h1>
            <p class="text-sm font-light">
                THEHOTBLEEP boasts a diverse selection of proficient freelancers
                prepared to handle your project with utmost professionalism.
            </p>
        </div>
        <div class="mt-10">
            <div class="swiper myClientsReview">
                <div class="swiper-wrapper py-20">
                    <div class="swiper-slide">
                        <div
                            class="border border-[#EEEEEE] bg-[#EBEDEF] bg-opacity-55 rounded-lg px-6 pt-20 pb-6 relative">
                            <div class="absolute -top-20 w-36 h-36 rounded-full bg-white left-1/2 -translate-x-1/2 p-2">
                                <div class="bg-[#0BA1E5] w-full h-full rounded-full p-2">
                                    <img src="./new-images/doctor-1.png" class="w-full h-full rounded-full" alt="doctor" />
                                </div>
                            </div>

                            <div class="">
                                <h1 class="text-lg font-medium text-center">
                                    Daniel
                                    <span class="text-base font-light">Reviews</span> Dr.James
                                </h1>
                                <div
                                    class="bg-[#0BA1E5] rounded-full px-2 py-1 flex justify-start items-center gap-1 mx-auto w-24 mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                </div>
                                <p class="mt-3 line-clamp-5 font-light">
                                    “I thought this was the best survey site out there over
                                    the last two weeks four different surveys I completed all
                                    over 100 points refuse to bring me back to thei...”
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div
                            class="border border-[#EEEEEE] bg-[#EBEDEF] bg-opacity-55 rounded-lg px-6 pt-20 pb-6 relative">
                            <div class="absolute -top-20 w-36 h-36 rounded-full bg-white left-1/2 -translate-x-1/2 p-2">
                                <div class="bg-[#0BA1E5] w-full h-full rounded-full p-2">
                                    <img src="./new-images/doctor-2.png" class="w-full h-full rounded-full" alt="doctor" />
                                </div>
                            </div>

                            <div class="">
                                <h1 class="text-lg font-medium text-center">
                                    Daniel
                                    <span class="text-base font-light">Reviews</span> Dr.James
                                </h1>
                                <div
                                    class="bg-[#0BA1E5] rounded-full px-2 py-1 flex justify-start items-center gap-1 mx-auto w-24 mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                </div>
                                <p class="mt-3 line-clamp-5 font-light">
                                    “I thought this was the best survey site out there over
                                    the last two weeks four different surveys I completed all
                                    over 100 points refuse to bring me back to thei...”
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div
                            class="border border-[#EEEEEE] bg-[#EBEDEF] bg-opacity-55 rounded-lg px-6 pt-20 pb-6 relative">
                            <div class="absolute -top-20 w-36 h-36 rounded-full bg-white left-1/2 -translate-x-1/2 p-2">
                                <div class="bg-[#0BA1E5] w-full h-full rounded-full p-2">
                                    <img src="./new-images/doctor-3.png" class="w-full h-full rounded-full" alt="doctor" />
                                </div>
                            </div>

                            <div class="">
                                <h1 class="text-lg font-medium text-center">
                                    Daniel
                                    <span class="text-base font-light">Reviews</span> Dr.James
                                </h1>
                                <div
                                    class="bg-[#0BA1E5] rounded-full px-2 py-1 flex justify-start items-center gap-1 mx-auto w-24 mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                </div>
                                <p class="mt-3 line-clamp-5 font-light">
                                    “I thought this was the best survey site out there over
                                    the last two weeks four different surveys I completed all
                                    over 100 points refuse to bring me back to thei...”
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div
                            class="border border-[#EEEEEE] bg-[#EBEDEF] bg-opacity-55 rounded-lg px-6 pt-20 pb-6 relative">
                            <div class="absolute -top-20 w-36 h-36 rounded-full bg-white left-1/2 -translate-x-1/2 p-2">
                                <div class="bg-[#0BA1E5] w-full h-full rounded-full p-2">
                                    <img src="./new-images/doctor-4.png" class="w-full h-full rounded-full" alt="doctor" />
                                </div>
                            </div>

                            <div class="">
                                <h1 class="text-lg font-medium text-center">
                                    Daniel
                                    <span class="text-base font-light">Reviews</span> Dr.James
                                </h1>
                                <div
                                    class="bg-[#0BA1E5] rounded-full px-2 py-1 flex justify-start items-center gap-1 mx-auto w-24 mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                </div>
                                <p class="mt-3 line-clamp-5 font-light">
                                    “I thought this was the best survey site out there over
                                    the last two weeks four different surveys I completed all
                                    over 100 points refuse to bring me back to thei...”
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div
                            class="border border-[#EEEEEE] bg-[#EBEDEF] bg-opacity-55 rounded-lg px-6 pt-20 pb-6 relative">
                            <div class="absolute -top-20 w-36 h-36 rounded-full bg-white left-1/2 -translate-x-1/2 p-2">
                                <div class="bg-[#0BA1E5] w-full h-full rounded-full p-2">
                                    <img src="./new-images/doctor-4.png" class="w-full h-full rounded-full" alt="doctor" />
                                </div>
                            </div>

                            <div class="">
                                <h1 class="text-lg font-medium text-center">
                                    Daniel
                                    <span class="text-base font-light">Reviews</span> Dr.James
                                </h1>
                                <div
                                    class="bg-[#0BA1E5] rounded-full px-2 py-1 flex justify-start items-center gap-1 mx-auto w-24 mt-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                        fill="none">
                                        <path
                                            d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                            fill="white" />
                                    </svg>
                                </div>
                                <p class="mt-3 line-clamp-5 font-light">
                                    “I thought this was the best survey site out there over
                                    the last two weeks four different surveys I completed all
                                    over 100 points refuse to bring me back to thei...”
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>

<section class="bg-black py-20 mt-20 relative overflow-hidden">
    <!-- <img src="./new-images/48-PhotoRoom 1.png" class="absolute top-1/2 -translate-y-1/2 right-5 w-44" alt=""> -->
    <div class="container xl:max-w-screen-2xl mx-auto px-4 relative">
        <img src="./new-images/box-group.png" class="absolute top-0 left-0 w-72" alt="" />
        <div class="flex justify-between items-start md:items-center gap-5 flex-col md:flex-row relative">
            <div class="text-white">
                <h1 class="text-4xl font-semibold">
                    Get top-notch services from skilled providers
                </h1>
                <p class="font-light text-sm mt-3">
                    THEHOTBLEEP boasts a diverse selection of proficient freelancers
                    prepared to handle your project with utmost professionalism.
                </p>
                <div class="mt-12 relative">
                    <form method="GET" action="{{ route('home.search_gigs') }}">

                                <input
                                wire:model.debounce.300ms="search"
                                x-on:keydown.arrow-down.stop.prevent="highlightNext()"
                                x-on:keydown.arrow-up.stop.prevent="highlightPrevious()"
                                x-on:keydown.enter.stop.prevent="$dispatch('value-selected', {
                                    id: $refs.results.children[highlightedIndex].getAttribute('data-result-id'),
                                    name: $refs.results.children[highlightedIndex].getAttribute('data-result-name')
                                })"
                                name="query"
                                autocomplete="off"
                                class="bg-transparent border border-white text-white rounded-lg focus:ring-white focus:border-white block w-full p-2.5 placeholder:text-white" placeholder="Try “Medical Store”"
                                >
                                <div class="absolute right-1 top-1/2 -translate-y-1/2">
                                <button type="submit"
                                class="align-middle select-none font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-12 h-9 rounded-md bg-white text-black shadow-md shadow-white/10 hover:shadow-lg hover:shadow-white/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none flex justify-center items-center"
                                type="button" data-ripple-dark="true">
                                <i class="fa-regular fa-magnifying-glass"></i>
                            </button>
                                </div>
                </form>

                </div>
            </div>
            <div class=" justify-end items-center hidden md:flex">
                <img src="{{ asset('new-images/48-PhotoRoom 1.png') }}" alt="" />
            </div>
        </div>
    </div>
</section>
</x-app-layout>
