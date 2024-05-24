@props(['gig'])

<div>
    <div
        class=" bg-white rounded-3xl border border-gray-200 shadow-md drk:bg-gray-800 drk:border-gray-700 group mb-4 w-[85%] sm:w-[95%]">
        <div class="p-3">
            <a href="{{ route('gig_details', ['slug' => $gig->slug]) }}">
                <img class="rounded-3xl mx-auto w-full h-[240px]" src="{{ asset('/gigs/images/' . $gig->image_path) }}"
                    alt="" />
            </a>
        </div>
        <div class="px-6 py-4">
            <div class="border-b border-[rgba(0,0,0,.125)] pb-2">
                <a href="{{ route('gig_details', ['slug' => $gig->slug]) }}" title="{{ $gig->gig_title }}">
                    <h3 class="text-[#1f1f1f] text-[17px] mb-3">
                        @if (strlen(trim($gig->gig_title)) > 40)
                            {{ substr($gig->gig_title, 0, 40) . '...' }}
                        @else
                            {{ $gig->gig_title }}
                        @endif
                    </h3>
                </a>
                <div class="flex justify-between items-center mb-2">
                    <h4>Starting At</h4>
                    <div class="flex justify-start items-center">
                        <i class="fa fa-star text-[#ffb33e]" aria-hidden="true"><span>
                                {{ number_format(round($gig->average_rating, 1), 1) }} </span></i>
                        <p class="text-[#979797] text-[17px]">({{ $gig->total_reviews }})</p>
                    </div>
                </div>
                <div>
                    <p class="text-[#2646c4] text-[16px]">$<span
                            class="text-[25px] font-bold">{{ $gig->starting_at }}</span></p>
                </div>
            </div>
            <div class="flex justify-between items-center">
                <div class="flex justify-start items-center mt-3">
                    <div
                        class="relative after:content-[''] after:absolute after:bottom-[17%] after:z-[1] after:rounded-full after:h-[10px] after:w-[10px] after:bg-green-700  after:right-[-4%] after:border after:border-white">
                            @if (isset($gig->seller_image) && !empty($gig->seller_image))
                                <img class="rounded-full min-w-[40px] h-[40px] object-cover" src="{{ asset('/storage/'.$gig->seller_image) }}" alt="">
                            @else
                                <img class="rounded-full min-w-[40px] h-[40px] object-cover" src="https://ui-avatars.com/api/?name={{$gig->seller_name}}" alt="">
                            @endif
                    </div>
                    <div class="ml-2">
                        <a href="{{ route('view_profile', ['name' => $gig->seller_name]) }}">
                            <h4>{{ $gig->seller_name }}</h4>
                        </a>
                        <p>Seller</p>
                    </div>
                </div>
                <div>
                    <i class="fa-regular fa-heart text-[20px] text-[#aeaeae] cursor-pointer group-hover:text-[red]"></i>
                </div>
            </div>
        </div>
    </div>
</div>
