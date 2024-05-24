<div class="container relative max-w-[95%] xl:max-w-[90%] mx-auto mt-[25px] mb-[100px] md:mt-[130px] before:content-[''] before:absolute before:w-[100%] before:top-[65%] before:left=[3%] before:rounded-3xl before:bg-[#f4f5fc] before:h-[300px] before:-z-[1]">
    <h1 class="text-[42px] text-center font-bold">
      People Who Viewed This Service <br>
        <span class="font-[400]">Also Viewed</span>
    </h1>
    <div class="mt-12">
        <div class="popular-services-slider sm:px-9">
            @foreach ($alsoViewedGigs as $gig)
                <x-gig.also-viewed-product-card :gig="$gig" />
            @endforeach
        </div>
         <!-- previous next arrows -->
        <div class="text-center mt-14">
            <button  class="pp-prev slick-arrow "> <i class="fa fa-angle-left p-4 text-[30px] w-[64px] text-center m-[5px_2px] rounded-[50%] bg-white text-[#7c7e87] hover:bg-[#2d4dca] hover:text-[white] drop-shadow-[0px_2px_10px_rgba(45,77,202,0.11)]"  aria-hidden="true"></i></button>
            <button class="pp-next slick-arrow"> <i class="fa fa-angle-right p-4 text-[30px] w-[64px] text-center m-[5px_2px] rounded-[50%] bg-[#2d4dca] text-[white] hover:bg-[#3458e3] drop-shadow-[0px_2px_10px_rgba(45,77,202,0.11)]" aria-hidden="true"></i></button>
        </div>
    </div>
  </div>