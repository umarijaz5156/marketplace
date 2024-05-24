<x-app-layout>

    {{-- <div
        class="container 2xl:max-w-screen-xl flex flex-wrap lg:flex-nowrap items-center justify-between mx-auto px-4">
        --}}
        <livewire:seller-profile-page :seller="$seller" />
        <section class="mt-10 md:mt-20">

        </section>

        <section class="mt-10 md:mt-20">
            <div class="container xl:max-w-screen-2xl mx-auto px-4">
                <div class="space-y-2">
                    <h1 class="text-black font-semibold text-4xl md:text-5xl">
                        {{ $seller->seller_name }} <span class="font-[400]"> Services </span>
                    </h1>
                </div>

                <div class="mt-10">
                    <div class="swiper mySpecialServices">
                        <div class="swiper-wrapper pb-20">
                            @foreach ($gigs as $gig)
                            <div class="swiper-slide">
                                <x-product-card :gig="$gig" link="yes" />
                            </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </section>
        {{-- portfolio --}}
         <livewire:seller.seller-portfolio :seller="$seller" />

        <section class="mt-10 md:mt-20">
            <div class="container xl:max-w-screen-2xl mx-auto px-4">
                <div class="space-y-2">
                    <h1 class="text-black font-semibold text-3xl md:text-5xl">
                        Professional&nbsp;<span class="text-primary">&nbsp;Vetted &amp;
                            Expert</span>&nbsp;&nbsp;Freelancers
                    </h1>
                    <p class="text-sm font-light">
                        THEHOTBLEEP boasts a diverse selection of proficient freelancers
                        prepared to handle your project with utmost professionalism.
                    </p>
                </div>
                {{-- popluar professional services --}}
                <livewire:home-page.popular-services>
            </div>


        </section>

        <livewire:seller.seller-reviews :seller="$seller" />

</x-app-layout>
