<div>
    <div>
        <div class="container lg:max-w-[960px] xl:max-w-[1140px] 2xl:max-w-[1420px] w-full mx-auto px-[15px] mt-[100px]">
            <div>
                <div class="flex justify-between items-center flex-wrap py-4 border-b border-[#EFEFEF]">
                    <h1 class="text-2xl font-normal relative">{{ $totalReviews }} Results</h1>

                </div>
            </div>
            <div class="grid lg:grid-cols-1 xl:grid-cols-1 py-[40px] border-b border-[#EFEFEF]">
                <div>
                    <div class="flex lg:justify-between justify-start items-center mb-[30px]">
                        <p>5 Stars</p>
                        <div class="w-[67%] bg-[#EBE9E6] rounded-full h-2.5 drk:bg-gray-700 ml-[16px]">
                            <div class="bg-[#FFB33E] h-2.5 rounded-full" style="width: {{ $fiveStars['average'] }}%">
                            </div>
                        </div>
                        <p class=" ml-[16px]">({{ $fiveStars['count'] }})</p>
                    </div>
                    <div class="flex lg:justify-between justify-start items-center mb-[30px]">
                        <p>4 Stars</p>
                        <div class="w-[67%] bg-[#EBE9E6] rounded-full h-2.5 drk:bg-gray-700  ml-[16px]">
                            <div class="bg-[#FFB33E] h-2.5 rounded-full" style="width: {{ $fourStars['average'] }}%">
                            </div>
                        </div>
                        <p class=" ml-[16px]">({{ $fourStars['count'] }})</p>
                    </div>
                    <div class="flex lg:justify-between justify-start items-center mb-[30px]">
                        <p>3 Stars</p>
                        <div class="w-[67%] bg-[#EBE9E6] rounded-full h-2.5 drk:bg-gray-700  ml-[16px]">
                            <div class="bg-[#FFB33E] h-2.5 rounded-full"
                                style="width: {{ $threeStars['average'] }}%"></div>
                        </div>
                        <p class=" ml-[16px]">({{ $threeStars['count'] }})</p>
                    </div>
                    <div class="flex lg:justify-between justify-start items-center mb-[30px]">
                        <p>2 Stars</p>
                        <div class="w-[67%] bg-[#EBE9E6] rounded-full h-2.5 drk:bg-gray-700  ml-[16px]">
                            <div class="bg-[#FFB33E] h-2.5 rounded-full" style="width: {{ $twoStars['average'] }}%">
                            </div>
                        </div>
                        <p class=" ml-[16px]">({{ $twoStars['count'] }})</p>
                    </div>
                    <div class="flex lg:justify-between justify-start items-center mb-[30px]">
                        <p>1 Stars</p>
                        <div class="w-[67%] bg-[#EBE9E6] rounded-full h-2.5 drk:bg-gray-700  ml-[16px]">
                            <div class="bg-[#FFB33E] h-2.5 rounded-full" style="width: {{ $oneStar['average'] }}%">
                            </div>
                        </div>
                        <p class=" ml-[16px]">({{ $oneStar['count'] }})</p>
                    </div>
                </div>

            </div>

            {{-- reviews section --}}
            {{-- <div class="pt-[40px] border-b border-[#EFEFEF]">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-28">
                    @foreach ($reviews as $review)
                        <article class="mb-[40px]">
                            <div class="flex justify-between items-center mb">
                                <div class="flex items-center mb-4 space-x-4">

                                    @if ($this->getProfilePath($review->from_user_id) !== null)
                                        <img class="rounded-full  w-10 h-10"
                                        src="{{ asset('/storage/' . $this->getProfilePath($review->from_user_id)) }}"
                                            alt="">
                                    @else
                                       <img class="w-10 h-10 rounded-full"
                                        src="https://ui-avatars.com/api/?name={{ $this->getUserName($review->from_user_id) }}"
                                        alt="">
                                    @endif

                                    <div class="space-y-1 font-medium drk:text-white">
                                        <p>{{ $this->getUserName($review->from_user_id) }} <time
                                                datetime="2014-08-16 19:00"
                                                class="block text-sm text-gray-500 drk:text-gray-400">{{ $review->created_at->diffForHumans() }}</time>
                                        </p>

                                    </div>
                                </div>
                                <div class="flex gap-x-10">
                                    <div class="flex items-center">
                                      <svg aria-hidden="true" class="w-5 h-5 {{$review->rating > 0 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500'}} " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>First star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                      <svg aria-hidden="true" class="w-5 h-5 {{$review->rating > 1 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500'}}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Second star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                      <svg aria-hidden="true" class="w-5 h-5 {{$review->rating > 2 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500'}}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Third star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                      <svg aria-hidden="true" class="w-5 h-5 {{$review->rating > 3 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500'}}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fourth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                      <svg aria-hidden="true" class="w-5 h-5 {{$review->rating > 4 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500'}}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fifth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    </div>

                                  </div>

                            </div>
                            <p class="mb-2 font-light text-gray-500 drk:text-gray-400">{{ $review->review }}</p>
                        </article>
                    @endforeach

                </div>
            </div>
            @if ($totalReviews > 4)
                <div class="mt-5" x-data="{ showMore: @entangle('showMoreLink') }">
                    <a wire:click="loadMoreReviews({{ $totalReviews }})" x-show="showMore"
                        class="cursor-pointer text-[#2646C4] text-[17px] underline">See All Reviews ></a>
                    <a wire:click="loadLessReviews()" x-show="!showMore"
                        class="cursor-pointer text-[#2646C4] text-[17px] underline">Show less Reviews ></a>
                </div>
            @endif --}}
        </div>
    </div>
</div>
