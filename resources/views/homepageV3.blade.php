<x-app-layout>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");
        * {
            font-family: "Poppins", sans-serif;
        }

    </style>
    <x-HomePage.hero-sectionV3 :popularCategories="$popularCategories" />

    <livewire:home-page-v2.popular-services-v2 />

    <!-- freelance marketplace -->
    <section class="my-10 md:my-20">
        <div class="container xl:max-w-screen-2xl mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-5">
                <div class="flex justify-start items-center">
                    <div class="">
                        <div class="space-y-3">
                            <p class="text-secondry font-bold" data-aos="zoom-in">
                                TheHotbleep.com
                            </p>
                            <h1 class="text-navydark text-4xl font-bold leading-tight" data-aos="zoom-in"
                            data-aos-delay="200">
                            A <span class="text-secondry"> Freelance Marketplace</span> <br>
                            Designed For Talented <br>
                            Medical Freelancers
                        </h1>
                    </div>
                    <ul class="space-y-4 mt-10">
                        <li class="pl-8 text-navydark relative" data-aos="zoom-in" data-aos-delay="300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22"
                            fill="none" class="absolute top-1 left-0">
                            <path
                            d="M21 10.0857V11.0057C20.9988 13.1621 20.3005 15.2604 19.0093 16.9875C17.7182 18.7147 15.9033 19.9782 13.8354 20.5896C11.7674 21.201 9.55726 21.1276 7.53447 20.3803C5.51168 19.633 3.78465 18.2518 2.61096 16.4428C1.43727 14.6338 0.879791 12.4938 1.02168 10.342C1.16356 8.19029 1.99721 6.14205 3.39828 4.5028C4.79935 2.86354 6.69279 1.72111 8.79619 1.24587C10.8996 0.770634 13.1003 0.988061 15.07 1.86572M21 3.00572L11 13.0157L8.00001 10.0157"
                            stroke="#4594D3" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        </svg>
                        Connect to freelancers with proven business experience.
                    </li>
                    <li class="pl-8 text-navydark relative" data-aos="zoom-in" data-aos-delay="400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22"
                        fill="none" class="absolute top-1 left-0">
                        <path
                        d="M21 10.0857V11.0057C20.9988 13.1621 20.3005 15.2604 19.0093 16.9875C17.7182 18.7147 15.9033 19.9782 13.8354 20.5896C11.7674 21.201 9.55726 21.1276 7.53447 20.3803C5.51168 19.633 3.78465 18.2518 2.61096 16.4428C1.43727 14.6338 0.879791 12.4938 1.02168 10.342C1.16356 8.19029 1.99721 6.14205 3.39828 4.5028C4.79935 2.86354 6.69279 1.72111 8.79619 1.24587C10.8996 0.770634 13.1003 0.988061 15.07 1.86572M21 3.00572L11 13.0157L8.00001 10.0157"
                        stroke="#4594D3" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    </svg>
                    Hire a freelancer directly depending upon your budget & needs.
                </li>
                <li class="pl-8 text-navydark relative" data-aos="zoom-in" data-aos-delay="500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22"
                    fill="none" class="absolute top-1 left-0">
                    <path
                    d="M21 10.0857V11.0057C20.9988 13.1621 20.3005 15.2604 19.0093 16.9875C17.7182 18.7147 15.9033 19.9782 13.8354 20.5896C11.7674 21.201 9.55726 21.1276 7.53447 20.3803C5.51168 19.633 3.78465 18.2518 2.61096 16.4428C1.43727 14.6338 0.879791 12.4938 1.02168 10.342C1.16356 8.19029 1.99721 6.14205 3.39828 4.5028C4.79935 2.86354 6.69279 1.72111 8.79619 1.24587C10.8996 0.770634 13.1003 0.988061 15.07 1.86572M21 3.00572L11 13.0157L8.00001 10.0157"
                    stroke="#4594D3" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" />
                </svg>
                Discuss, Share & give feedback all within Hotbleep Seller Dashboard.
            </li>
            <li class="pl-8 text-navydark relative" data-aos="zoom-in" data-aos-delay="600">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22"
                fill="none" class="absolute top-1 left-0">
                <path
                d="M21 10.0857V11.0057C20.9988 13.1621 20.3005 15.2604 19.0093 16.9875C17.7182 18.7147 15.9033 19.9782 13.8354 20.5896C11.7674 21.201 9.55726 21.1276 7.53447 20.3803C5.51168 19.633 3.78465 18.2518 2.61096 16.4428C1.43727 14.6338 0.879791 12.4938 1.02168 10.342C1.16356 8.19029 1.99721 6.14205 3.39828 4.5028C4.79935 2.86354 6.69279 1.72111 8.79619 1.24587C10.8996 0.770634 13.1003 0.988061 15.07 1.86572M21 3.00572L11 13.0157L8.00001 10.0157"
                stroke="#4594D3" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
            </svg>
            Powerful Escrow System, We hold funds & you pay only after delivers Quality Services.
        </li>
    </ul>
</div>
</div>
<div>
    <img data-aos="zoom-in" src="./images/list-group-img.png" alt="Laptop-girl">
</div>
</div>
</div>
</section>
<!-- freelance marketplace -->

<livewire:home-page.store-services />

<!-- Freelance -->
<section class="my-10 md:my-32">
    <div class="container xl:max-w-screen-2xl mx-auto px-4 relative md:py-24 ">
        <div class="absolute top-0 left-0 right-0 xl:left-3 xl:right-3 md:w-[90%] lg:w-[95%] mx-auto bottom-0 h-full bg-[#EAEAEA] rounded-[120px] hidden md:block"
        style="transform: rotate(-4.387deg);" data-aos="zoom-in">
    </div>
    <div class="hidden md:block absolute top-0 left-0 right-0 xl:left-3 xl:right-3 md:w-[90%] lg:w-[95%] mx-auto bottom-0 h-full bg-secondry rounded-[120px]"
    data-aos="zoom-in" data-aos-delay="200" style="transform: rotate(2.004deg);">
</div>
<div class="relative md:bg-transparent bg-secondry rounded-2xl py-16 px-4" data-aos="zoom-out"
data-aos-delay="300">
<h1 class="text-4xl font-bold text-white relative text-center">
    A Whole World of <span class="text-navydark">Freelance <br class="sm:block hidden"> Talent</span> at
    Your
    Fingertips
</h1>
<div
class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 xl:gap-8 mt-16 w-full max-w-2xl lg:max-w-[900px] xl:max-w-[1000px] mx-auto relative">
<div class="bg-white rounded-[10px] pt-8 px-4 pb-10 text-center"
style="box-shadow: 0px 0px 10px rgba(3, 50, 70, 0.08);">
<img class="w-11 h-11 mx-auto" src="./images/tip-1 1.png" alt="">
<h1 class="text-lg font-bold text-secondry mt-5 mb-2">
    The Best for Medical Freelancers
</h1>
<p class="text-base text-[#455055]">
    Find Professional freelancers
    at low price.
</p>
</div>
<div class="bg-white rounded-[10px] pt-8 px-4 pb-10 text-center"
style="box-shadow: 0px 0px 10px rgba(3, 50, 70, 0.08);">
<img class="w-11 h-11 mx-auto" src="./images/tip-2 1.png" alt="">
<h1 class="text-lg font-bold text-secondry mt-5 mb-2">
    Quality Work
    Done Quickly
</h1>
<p class="text-base text-[#455055]">
    Find the right freelancer to
    begin working on your project
</p>
</div>
<div class="bg-white rounded-[10px] pt-8 px-4 pb-10 text-center"
style="box-shadow: 0px 0px 10px rgba(3, 50, 70, 0.08);">
<img class="w-11 h-11 mx-auto" src="./images/tip-3 1.png" alt="">
<h1 class="text-lg font-bold text-secondry mt-5 mb-2">
    Dispute &amp; <br> Refund
</h1>
<p class="text-base text-[#455055]">
    We offer free mediation and refund on disputes.
</p>
</div>
<div class="bg-white rounded-[10px] pt-8 px-4 pb-10 text-center"
style="box-shadow: 0px 0px 10px rgba(3, 50, 70, 0.08);">
<img class="w-11 h-11 mx-auto" src="./images/tip-4 1.png" alt="">
<h1 class="text-lg font-bold text-secondry mt-5 mb-2">
    Protected Payments, Every Time
</h1>
<p class="text-base text-[#455055]">
    Pay only once you get
    delivery by sellers.
</p>
</div>
</div>
</div>
</section>
<!-- Freelance -->

<livewire:home-page.videoad-services />

<section
class="my-20 relative after:content-[''] after:w-full after:absolute after:bg-secondry after:top-0 after:bottom-0 after:left-0 after:right-0">
<div class="container xl:max-w-screen-2xl mx-auto px-4 relative z-10">
    <img src="./images/girlimg 1.png" class="absolute hidden lg:block right-0 bottom-0 z-10" alt=""
    data-aos="zoom-in">

    <div class="grid lg:grid-cols-2 gap-5 py-20">
        <div class="space-y-4">
            <h1 class="text-3xl md:text-4xl font-bold text-white" data-aos="fade-up">
                Find The Developer To
                Launch Medical Store
            </h1>
            <p class="text-white" data-aos="fade-up" data-aos-delay="150">
                TheHotBleep has many expert freelancers ready to get the work done for you. We make sure your time
                and money is
                secure and you get value for the money. Our Quality Assurance team and Dispute managers are
                available round
                the clock to make your remote hiring successfull and fruitful.
            </p>
            <div>
                <a href="{{ route('category_details', ['catId' => 3]) }}">
                    <button data-aos="fade-up" data-aos-delay="250"
                    class="w-full sm:w-auto text-white bg-navydark hover:bg-blue-800 outline-none focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium xl:w-max px-3 sm:px-10 py-2 text-sm sm:text-bsae h-[58px] rounded-[10px]">
                    Try Our Medical Freelancers
                </button></a>
            </div>
        </div>
    </div>
</div>
</section>

<livewire:home-page-v2.freelance-reviews />

<section class="">
    <div class="container xl:max-w-screen-2xl mx-auto px-4 h-full relative" data-aos="fade-up">
        <div class="bg-[#EDF9FD] py-10 md:py-20 rounded-[20px] flex items-center relative overflow-hidden">
            <div data-aos="zoom-in" data-aos-delay="500"
            class="bg-[#D8F0FE] rounded-full  w-[925px] h-[925px] absolute top-[-520px] left-[-520px] rotate-[-29.454deg]">
        </div>
        <div data-aos="zoom-in" data-aos-delay="700"
        class="bg-[#D8F0FE] rounded-full w-[925px] h-[925px] absolute bottom-[-520px] right-[-520px] rotate-[-29.454deg]">
    </div>
    <div class="max-w-2xl w-full mx-auto px-4 md:px-0" data-aos="zoom-in" data-aos-delay="900">
        <div class="sm:text-center">
            <div class="relative">
                <h1 class="text-4xl font-bold text-navydark sm:leading-tight">
                    Get top-notch services from skilled providers
                </h1>
                <p class="text-navydark mt-4">
                    TheHotBleep boasts a diverse selection of proficient freelancers prepared to handle your project with utmost professionalism.                            </p>
                </div>
                <div class="my-6">
                    <form method="GET" action="{{ route('home.search_gigs') }}">
                        <div class="flex items-center flex-col sm:flex-row relative bg-white rounded-md">
                            <div class="relative flex-1 w-full sm:w-auto">
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
                                class="block w-full p-4 text-gray-900 border border-transparent rounded-md bg-transparent focus:ring-none outline-none focus:outline-none focus:border-navydark placeholder:text-[#C4B9B9] text-base placeholder:text-base" placeholder="Try “Medical Store”"
                                >

                                <button type="submit"
                                class="w-full sm:w-auto text-white bg-navydark hover:bg-blue-800 outline-none focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium xl:w-max px-3 sm:px-10 py-2 text-sm sm:text-bsae h-[58px] sm:absolute top-0 right-0 bottom-0 rounded-b-md sm:rounded-[0px_6px_6px_0px]">
                                Search Now
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</section>


</x-app-layout>
