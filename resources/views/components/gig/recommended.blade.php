@props(['gigs'])

<div>
    <div class="container lg:max-w-[960px] xl:max-w-[1140px] 2xl:max-w-[1420px] w-full mx-auto px-[15px] mt-[100px]">
        <div>
            <h1 class="text-center text-[30px] text-[#1f1f1f] font-bold">
                Recommended <span class="font-[400]"> For You </span>
            </h1>
        </div>
        <div class="popular-services-slider mt-[40px]">
            @foreach ($gigs as $gig)
                <div class="mr-4">
                    <x-product-card :gig="$gig" />
                </div>
            @endforeach
        </div>
    </div>
</div>
