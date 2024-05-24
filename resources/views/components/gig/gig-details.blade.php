{{-- title --}}
<section class="mt-22 relative flex justify-center items-center">
    <div class="bg-cover bg-center bg-no-repeat w-full py-20"
        style="background-image: url({{ asset('new-images/shop-her0-bg.png') }}">
        <div class="container xl:max-w-screen-2xl mx-auto px-4 relative mt-24">
            <div class="gridspace-y-3">
                <h1 class="text-4xl font-semibold">
                    {{ $gig->gigDetail->title }}
                </h1>
            </div>
        </div>
    </div>
</section>

<section class="mt-10 md:mt-20 relative py-10">
    <div class="absolute top-0 right-0 left-[40%] bottom-0 h-full bg-primary bg-opacity-20 rounded-tl-lg rounded-bl-lg">
    </div>
    <div class="container xl:max-w-screen-2xl mx-auto px-4 relative">
        <div class=" grid lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 flex items-center">
                @php
                if(count($gig->gigImages) > 0){

                    $image = $gig->gigImages[0];
                } else{
                    $image = new App\Models\Seller\GigImage;
                }
                @endphp
                @if ($image->mime_type == 'mp4' || $image->mime_type == 'webm' || $image->mime_type ==
                'ogg')
                <video class="rounded-lg w-full max-w-[821px] h-full xl:h-auto" controls>
                    <source src="{{ asset('/gigs/images/' . $image->image_path) }}"
                        type="video/{{ $image->mime_type }}">
                </video>
                @else
                <img class="rounded-lg w-full max-w-[821px] h-full xl:h-auto"
                    src="{{ asset('/gigs/images/' . $image->image_path) }}" />
                @endif
                {{-- <div class="swiper-wrapper">
                    @foreach ($gig->gigImages as $image)
                    <div class="swiper-slide">
                        @if ($image->mime_type == 'mp4' || $image->mime_type == 'webm' || $image->mime_type ==
                        'ogg')
                        <video class="rounded-lg w-full max-w-[821px] h-full xl:h-auto" controls>
                            <source src="{{ asset('/gigs/images/' . $image->image_path) }}"
                                type="video/{{ $image->mime_type }}">
                        </video>
                        @else
                        <img class="rounded-lg w-full max-w-[821px] h-full xl:h-auto"
                            src="{{ asset('/gigs/images/' . $image->image_path) }}" />
                        @endif
                    </div>
                    @endforeach
                </div>
                <div class="swiper-button-next after:hidden bg-white custom-product-slider-btn ">
                    <i class="fa-solid fa-chevron-right text-black"></i>
                </div>
                <div class="swiper-button-prev after:hidden bg-white custom-product-slider-btn">
                    <i class="fa-solid fa-chevron-left text-black"></i>
                </div> --}}
            </div>
            <div>
                <livewire:gigs.gig-packages :gig='$gig'>
            </div>
        </div>
    </div>
</section>





<section class="mt-10 md:mt-20 relative">
    <div class="container xl:max-w-screen-2xl mx-auto px-4 relative">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                {{-- description --}}
                <div class="mb-8">
                    {!! $gig->gigDetail->description !!}
                </div>

                {{-- portfolio --}}
                @if (count($gig->portfolio) > 0)
                <div class="mt-8 grid sm:grid-cols-2 xl:grid-cols-3 gap-5">

                    @foreach ($gig->portfolio as $portfolio)
                    <div class="relative bg-gradient-to-br from-[#0ba0e504] to-primary p-2 rounded-lg pl-3">
                        <div class="absolute top-0 left-0 bottom-0 h-full w-1.5 rounded-full bg-primary"></div>
                        <div class="bg-primary p-1 rounded-lg">
                            @if ($portfolio->mime_type == 'mp4' || $portfolio->mime_type == 'webm' || $portfolio->mime_type == 'ogg')
                            <div class="relative">
                                <div onclick="showModal('{{ asset('/storage/' . $portfolio->path) }}', 'video')"
                                    class="h-[200px] sm:h-[285px] xl:h-[213px] bg-cover bg-center bg-no-repeat relative py-5 px-4 overflow-hidden rounded-lg"
                                    style="background-image: url({{ asset('/portfolio/mobile_images/' . $portfolio->thumbnail) }})">


                                </div>
                            </div>
                            @else
                            <div onclick="showModal('{{ asset('portfolio/original_images/' . $portfolio->path) }}', 'image')"
                                class="h-[200px] sm:h-[285px] xl:h-[213px] bg-cover bg-center bg-no-repeat relative py-5 px-4 overflow-hidden rounded-lg"
                                style="background-image: url({{ asset('portfolio/original_images/' . $portfolio->path)  }})">


                            </div>

                            @endif

                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
                {{-- compare pricing --}}
                @if (isset($gig) && $gig->package_type->value == 1)

                <div class="mt-7">
                    <h1 class="text-black font-semibold text-4xl md:text-5xl">
                      Compare
                      <span class="text-primary">Packages</span>
                    </h1>

                    <livewire:gigs.pricing-plan :gig="$gig" />

                </div>
                @endif
            </div>

            {{-- seller profile --}}
            <div class="relative">

                <livewire:gigs.seller-profile :seller="$gig->seller" :gig="$gig" />
            </div>
        </div>
    </div>
</section>

















<div id="modal"
    class="hidden fixed top-0 left-0 z-[999] w-screen h-screen bg-black/70 flex justify-center items-center">

    <!-- The close button -->
    <a class="fixed z-90 top-0 right-8 text-white text-5xl font-bold" href="javascript:void(0)"
        onclick="closeModal()">&times;</a>

    <!-- A big image will be displayed here -->

    <video id='modal-video' class=" max-h-[600px] object-cover" controls></video>
    <div class="overflow-y-auto max-h-[90%]">
        <img id="modal-img" class="max-w-full mx-auto w-full" />

    </div>
</div>

<script>
    // Get the modal by id
    var modal = document.getElementById("modal");

    // Get the modal image tag
    var modalImg = document.getElementById("modal-img");

    var modalVideo = document.getElementById('modal-video');

    // this function is called when a small image is clicked
    function showModal(src, type) {
        modal.classList.remove('hidden');

        if (type == 'image') {
            modalVideo.classList.add('hidden');
            modalImg.classList.remove('hidden');
            modalImg.src = src;
        } else {
            modalVideo.classList.remove('hidden');
            modalImg.classList.add('hidden');
            modalVideo.src = src;
        }

    }

    // this function is called when the close button is clicked
    function closeModal() {
        modal.classList.add('hidden');
        pauseVideo();
    }

    function pauseVideo() {
        if (!modalVideo.paused) {
            modalVideo.pause();
        }
    }
</script>
