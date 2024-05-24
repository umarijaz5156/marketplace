<div class="swiper-slide">
    <div
        class="border border-[#E5E5E5] bg-white rounded-[10px] overflow-hidden w-full mx-auto inline-block">
        @php

            $path = isset($gig->image_path) ? asset('/gigs/images/' . $gig->image_path) : 'images/ps-card2.jpg';
        @endphp
        <div class="">
            <a href="{{ route('gig_details', ['slug' => $gig->slug]) }}">
                <div class="h-[213px] sm:h-[285px] xl:h-[226px] w-full bg-cover bg-center bg-no-repeat"
                    style="background-image: url('{{ $path }}')"></div>
            </a>

            <div class="px-5 py-6">
                <div class="flex justify-between items-center gap-3">
                   

                    <div class="flex justify-start items-center gap-4">
                        @if (isset($gig->seller_image) && !empty($gig->seller_image))
                            <div class="relative">
                                <img class="w-10 h-10 rounded-full" src="{{ asset('/storage/'.$gig->seller_image) }}" alt="" />
                            </div>

                        @else
                        <div class="relative">
                            <img class="w-10 h-10 rounded-full"  src="https://ui-avatars.com/api/?name={{$gig->seller_name}}"  alt="" />
                        </div>
                        @endif
                        <a href="{{ route('view_profile', ['name' => $gig->seller_name]) }}">
                            <div class="font-medium">
                                <h1 class="text-[#AAA]">
                                    {{-- Ad by --}}
                                    <span class="font-semibold text-secondry">
                                        {{ $gig->seller_name }}</span>
                                </h1>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="mt-6 mb-9">
                    <h1 class="text-secondry font-bold mb-1">
                        Popular Service
                    </h1>
                    <a href="{{route('gig_details', ['slug' => $gig->slug])}}"
                        class="block h-[56px] text-ellipsis overflow-hidden ... text-navydark text-lg font-extrabold">
                        {{ $gig->gig_title }}...
                    </a>
                </div>
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <svg aria-hidden="true" class="w-5 h-5 text-[#FFC700]" fill="currentColor"
                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <title>First star</title>
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                            </path>
                        </svg>
                        <p class="ml-2 font-bold text-navydark">
                            {{
                                number_format(round($gig->average_rating, 1), 1) }}
                            <span class="text-[#aaa] ml-1 font-medium">({{ $gig->total_reviews  }} )</span>
                        </p>
                    </div>
                    <div>
                        <h5 class="text-[#aaa]">
                            Starting at:
                            <span class="text-secondry font-semibold">${{ $gig->starting_at  }}</span>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
