@props(['gig', 'link' => null])


{{-- from search page --}}
@if ($link != "yes")
<div>
    <div class="border border-[#EEEEEE] rounded-lg">
        <div class="bg-[#EEEEEE] p-1 rounded-lg">
            <div class="bg-primary p-1 rounded-lg">
                @php
                $ext = substr(strrchr($gig->image_path, '.'), 1);
                $path = isset($gig->image_path) ? asset('/gigs/images/'.$gig->image_path) : 'images/ps-card2.jpg';
                @endphp
                <a class="" href="{{route('gig_details', ['slug' => $gig->slug])}}">
                    @if($ext == 'mp4')
                    <div class="h-[213px] sm:h-[285px] xl:h-[213px] w-full bg-cover bg-center bg-no-repeat  rounded-lg">
                        <video src="{{asset('/gigs/images/'.$gig->image_path) }}"></video>
                    </div>
                    @else
                    <div class="h-[213px] sm:h-[285px] xl:h-[213px] w-full bg-cover bg-center bg-no-repeat relative py-5 px-4 overflow-hidden rounded-lg"
                        style="background-image: url('{{$path}}');">
                    </div>
                    @endif
                </a>
            </div>
        </div>
    </div>
    <div class="px-5 py-6">
        <div class="flex justify-between items-center gap-3">

            <div class="flex justify-start items-center gap-4">
                <a class="relative"  href="{{ route('view_profile', ['name' => $gig->seller_name]) }}">
                    @if (isset($gig->seller_image) && !empty($gig->seller_image))
                    <img class="w-10 h-10 rounded-full"
                    src="{{ asset('/storage/'.$gig->seller_image) }}"
                        alt="" />
                    @else
                    <img class="w-10 h-10 rounded-full"
                    src="https://ui-avatars.com/api/?name={{$gig->seller_name}}"
                    alt="" />
                    @endif
                </a>

                <a href="{{ route('view_profile', ['name' => $gig->seller_name]) }}">
                    <div class="font-medium">
                        <h1 class="">
                            <span class="text-secondry"> {{ $gig->seller_name }}</span>
                        </h1>
                    </div>
                </a>
            </div>
            <div class="flex items-center">
                <svg aria-hidden="true" class="w-5 h-5 text-[#FFC700]" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <title>First star</title>
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                    </path>
                </svg>
                <p class="ml-2 font-medium">
                    {{
                        number_format(round($gig->average_rating, 1), 1) }}
                    <span class="text-[#aaa] ml-1 font-medium">({{
                        $gig->total_reviews }})</span>
                </p>
            </div>
        </div>
        <div class="mt-6 mb-9">

            <a href="{{route('gig_details', ['slug' => $gig->slug])}}" class="line-clamp-3 font-medium">
                @if (strlen($gig->gig_title) > 50)
                {{ substr($gig->gig_title, 0, 50) . '...' }}
                @else
                {{ $gig->gig_title }}
                @endif
            </a>
        </div>
        <div class="flex justify-end items-center">
            <a href="{{route('gig_details', ['slug' => $gig->slug])}}"
                class="align-middle select-none font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                type="button" data-ripple-light="true">
                ${{ $gig->starting_at }}
            </a>
        </div>
    </div>
</div>
@else
    <div class="border border-[#EEEEEE] rounded-lg">
        <div class="bg-[#EEEEEE] p-1 rounded-lg">
            <div class="bg-primary p-1 rounded-lg">
                @php
                if(count($gig->gigImages) > 0 ){
                    $path = asset('/gigs/images/'.$gig->gigImages[0]?->image_path);     ;
                 $ext = substr(strrchr($gig->gigImages[0]->image_path, '.'), 1);
                } else{
                    $path =    'images/ps-card2.jpg';
                    $ext = '';
                }

                @endphp
                <a class="" href="{{route('gig_details', ['slug' => $gig->gigDetail->slug])}}">
                    @if($ext == 'mp4')
                    <div class="h-[213px] sm:h-[285px] xl:h-[213px] w-full bg-cover bg-center bg-no-repeat relative py-5 px-4 overflow-hidden rounded-lg">
                        <video src="{{asset('/gigs/images/'.$gig->mainImage->image_path) }}"></video>
                    </div>
                    @else
                    <div class="h-[213px] sm:h-[285px] xl:h-[213px] w-full bg-cover bg-center bg-no-repeat relative py-5 px-4 overflow-hidden rounded-lg"
                        style="background-image: url('{{$path}}');">
                    </div>
                    @endif
                </a>
            </div>
        </div>
    </div>
    <div class="px-5 py-6">
        <div class="flex justify-between items-center gap-3">

            <div class="flex justify-start items-center gap-4">
                <a class="relative"  href="{{ route('view_profile', ['name' => $gig->seller->seller_name]) }}">
                    @if (isset($gig->seller->user->profile_photo_path) &&
                    !empty($gig->seller->user->profile_photo_path))
                    <img class="w-10 h-10 rounded-full"
                    src="{{ asset('/storage/'.$gig->seller->user->profile_photo_path) }}"
                        alt="" />
                    @else
                    <img class="w-10 h-10 rounded-full"
                    src="https://ui-avatars.com/api/?name={{$gig->seller_name}}"
                    alt="" />
                    @endif
                </a>

                <a href="{{ route('view_profile', ['name' => $gig->seller->seller_name]) }}">
                    <div class="font-medium">
                        <h1 class="">
                            <span class="text-secondry"> {{ $gig->seller->seller_name }}</span>
                        </h1>
                    </div>
                </a>
            </div>
            <div class="flex items-center">
                <svg aria-hidden="true" class="w-5 h-5 text-[#FFC700]" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <title>First star</title>
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                    </path>
                </svg>
                <p class="ml-2 font-medium">
                    {{
                        number_format(round($gig->gigStat->reviews_average, 1), 1) }}
                    <span class="text-[#aaa] ml-1 font-medium">({{ $gig->gigStat->reviews_count }})</span>
                </p>
            </div>
        </div>
        <div class="mt-6 mb-9">

            <a href="{{route('gig_details', ['slug' => $gig->gigDetail->slug])}}" class="line-clamp-3 font-medium">
                @if (strlen($gig->gigDetail->gig_title) > 50)
                {{ substr($gig->gigDetail->gig_title, 0, 50) . '...' }}
                @else
                {{ $gig->gigDetail->gig_title }}
                @endif
            </a>
        </div>
        <div class="flex justify-end items-center">
            <a href="{{route('gig_details', ['slug' => $gig->gigDetail->slug])}}"
                class="align-middle select-none font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                type="button" data-ripple-light="true">
                ${{ $gig->gigPackages->min('price')}}
            </a>
        </div>
    </div>
@endif

