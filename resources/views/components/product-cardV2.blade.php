<div
    class="border group border-[#E2EAED] bg-[#F4FCFF] rounded-[10px] overflow-hidden w-full mx-auto inline-block hover:shadow-lg">
    @php

        $path = isset($gig->image_path) ? asset('/gigs/images/' . $gig->image_path) : 'images/ps-card2.jpg';
    @endphp
    <div class="p-6">
        <a href="{{ route('gig_details', ['slug' => $gig->slug]) }}" class="rounded-[10px]">
            <img src="{{ $path }}" class="w-full h-[235px] object-cover" alt="" />
        </a>

  <div class="">
    <div class="my-4 space-y-1">
      <p class="text-[#898989] text-base">
        Popular Professional
      </p>
      <a href="{{route('gig_details', ['slug' => $gig->slug])}}"
        class="block h-[56px] text-ellipsis overflow-hidden ... text-[#263238] text-lg font-medium group-hover:text-[#0096D8]">
        {{ $gig->gig_title }}...
      </a>
    </div>
    <div class="flex justify-between items-center">
      <div class="flex items-center">
        <svg aria-hidden="true" class="w-5 h-5 text-[#FFC700]" fill="currentColor" viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg">
          <title>First star</title>
          <path
            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
          </path>
        </svg>
        <p class="ml-2 text-base font-medium text-[#263238] drk:text-gray-400">
            {{
                number_format(round($gig->average_rating, 1), 1) }} <span class="text-[#898989] ml-1">{{ $gig->total_reviews  }} reviews</span>
        </p>
      </div>
    </div>
  </div>
</div>
<div class="flex justify-between items-center gap-3 border-t border-[#B9B6B6] py-2 px-6">
  <div class="flex justify-start items-center gap-4">
    <div class="relative">
        @if (isset($gig->seller_image) && !empty($gig->seller_image))
                            <img class="w-10 h-10 rounded-full" src="{{ asset('/storage/'.$gig->seller_image) }}" alt="">
                            <span
                                class="bottom-0 left-7 absolute  w-3.5 h-3.5 {{\App\Models\User::find($gig->user_id)->isOnline()  ? 'bg-green-400' : 'bg-gray-400'}} border-2 border-white drk:border-gray-800 rounded-full"></span>
                            @else
                            <img class="rounded-full min-w-[40px] h-[40px] object-cover"
                                src="https://ui-avatars.com/api/?name={{$gig->seller_name}}" alt="">
                            <span
                                class="bottom-0 left-7 absolute  w-3.5 h-3.5 {{\App\Models\User::find($gig->user_id)->isOnline()  ? 'bg-green-400' : 'bg-gray-400'}} border-2 border-white drk:border-gray-800 rounded-full"></span>
                            @endif
    </div>
    <a href="{{ route('view_profile', ['name' => $gig->seller_name]) }}">
      <div class="font-medium">
        <h1 class="text-base font-medium">{{ $gig->seller_name }}</h1>
      </div>
    </a>
  </div>
  <div>
    <h5 class="text-xs sm:text-sm text-[#898989] font-medium">
      Starting at
      <span class="text-black font-bold text-xs sm:text-lg">US${{ $gig->starting_at  }}</span>
    </h5>
  </div>
</div>
</div>
