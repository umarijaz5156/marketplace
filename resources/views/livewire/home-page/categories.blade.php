<div>

  <!-- Explore Market -->
  <section class="my-20 sm:my-40">
    <div class="container 2xl:max-w-screen-2xl mx-auto px-4 h-full">
        <div data-aos="fade-up" class="my-5">
        <h1 class="text-4xl sm:text-5xl sm:leading-[70px] font-semibold text-[#263238]">Explore The  <span class="text-[#0096D8]"> Marketplace</span></h1>
        </div>
        <div class="flex justify-center  relative">
            <button style="top:50%" class="slideNext-btn absolute top-[50%]  right-0 lg:right-14">
                <i class="fa-regular text-2xl fa-chevron-right"></i></button>
                <button style="top:50%" class="slidePrev-btn absolute top-[50%]  left-0 lg:left-12">
                    <i class="fa-regular text-2xl fa-chevron-left"></i></button>
        <!-- Slider main container -->
        <div class="swiper testimonial-swiper2 flex w-10/12">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper relative ">
                <!-- Slides -->
                @foreach ($categories as $parent)

                    <div class="swiper-slide ">
                         <a href="{{ route('category_details', ['catId' => $parent->id]) }}">

                            <div class="relative bg-gray-200 rounded-lg overflow-hidden shadow-lg group cursor-pointer">
                                <img class="w-full h-[300px] object-cover" src="{{asset('storage/images/categories/'.$parent->detail->icon)}}" alt="your-image-description">
                                <div class="absolute top-0 left-0 w-full h-full bg-black opacity-0 hover:opacity-60 transition duration-500 ease-in-out">
                                  <div class="p-4 -translate-y-10 group-hover:translate-y-0 transition duration-500 ease-in-out">
                                    <h3 class="text-white text-lg font-bold mb-2">{{ $parent->name }}</h3>
                                    <p class="text-gray-300 text-sm">{{$parent->description}}</p>
                                  </div>
                                </div>
                                <div class="absolute bottom-1 left-2 group-hover:opacity-0 transition duration-500 ease-in-out">
                                    <h3 class="text-white text-lg font-bold mb-2">{{ $parent->name }}</h3>
                                </div>
                            </div>
                         </a>

                    </div>
                 @endforeach
            </div>
        </div>
    </div>
    </div>
</section>
<!-- Explore Market -->
</div>

