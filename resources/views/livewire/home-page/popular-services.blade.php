
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

