<div class="container xl:max-w-screen-2xl mx-auto px-4">
    <div class="space-y-2">
        <h1 class="text-black font-semibold text-4xl md:text-5xl">
            Ecommerce Store Services
        </h1>
        <p class="text-sm font-light">
            Most Popular & Top Selling Services will be provided
        </p>
    </div>
    <div class="mt-10">
        <div class="swiper mySpecialServices">
            <div class="swiper-wrapper pb-20">
                @foreach ($gigs as $gig)
                <div class="swiper-slide">

                    <x-product-card :gig="$gig" />

                </div>

                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>
