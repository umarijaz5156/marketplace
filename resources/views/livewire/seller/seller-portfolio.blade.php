
<div class="mt-10">
    <div class="space-y-2">
        <h1 class="text-black font-semibold text-4xl md:text-5xl">
            {{ $seller->seller_name }} <span class="font-[400]"> Portfolio </span>
        </h1>
    </div>
    <div class="mt-10 swiper sellerPortfolio">
        <div class="swiper-wrapper pb-20">
            @foreach ($portfolios as $portfolio)
            <div class="swiper-slide">
                <div class="border border-[#EEEEEE] rounded-lg">
                    <div class="bg-[#EEEEEE] p-1 rounded-lg">
                        <div class="bg-primary p-1 rounded-lg">

                            {{-- href="{{route('gig_details', ['slug' => $gig->gigDetail->slug])}}" --}}
                            <a class="" >
                                @if ($portfolio->mime_type == 'mp4' || $portfolio->mime_type == 'webm' || $portfolio->mime_type == 'ogg')
                                <div onclick="showModal('{{ asset('/storage/' . $portfolio->path) }}', 'video')" class="h-[213px] sm:h-[285px] xl:h-[213px] w-full bg-cover bg-center bg-no-repeat relative py-5 px-4 overflow-hidden rounded-lg"
                                    style="background-image: url({{ asset('/portfolio/mobile_images/' . $portfolio->thumbnail) }})">
                                @else
                                <div onclick="showModal('{{ asset('portfolio/original_images/' . $portfolio->path) }}', 'image')" class="h-[213px] sm:h-[285px] xl:h-[213px] w-full bg-cover bg-center bg-no-repeat relative py-5 px-4 overflow-hidden rounded-lg"
                                    style="background-image: url({{ asset('portfolio/original_images/' . $portfolio->path)  }})">
                                </div>
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
                <div class="px-5 py-6">


                    <div class="flex justify-end items-center">
                        <a href="{{route('gig_details', ['slug' => $portfolio->slug])}}"
                            class="align-middle select-none font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                            type="button" data-ripple-light="true">
                            Visit Service
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
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
</div>
