<div>
    @if($totalReviews != 0)
    <div class="flex items-center gap-3 my-4">

        <h3 class="text-base font-bold text-[#263238] ">{{$totalReviews }} reviews for this Service</h3>
        <div class="flex items-center">
            <svg aria-hidden="true" class="w-5 h-5 {{$reviewAverage > 0 ? 'text-[#FFC700]' : 'text-gray-300'}}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>First star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
            <svg aria-hidden="true" class="w-5 h-5 {{$reviewAverage > 1 ? 'text-[#FFC700]' : 'text-gray-300'}}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Second star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
            <svg aria-hidden="true" class="w-5 h-5 {{$reviewAverage > 2 ? 'text-[#FFC700]' : 'text-gray-300'}}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Third star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
            <svg aria-hidden="true" class="w-5 h-5 {{$reviewAverage > 3 ? 'text-[#FFC700]' : 'text-gray-300'}}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fourth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
            <svg aria-hidden="true" class="w-5 h-5 {{$reviewAverage > 4 ? 'text-[#FFC700]' : 'text-gray-300'}}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fifth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
        </div>
        <p class=" text-sm font-medium text-gray-500 drk:text-gray-400">{{$reviewAverage}}</p>

    </div>
    <div class="flex justify-between items-start gap-6 flex-wrap xl:flex-nowrap">
        <div class="w-full space-y-3">
            <div class="flex lg:justify-between justify-start items-center sm:w-[466px] ">
              <p class="font-semibold text-sm text-[#0096D8]">5 Stars</p>
              <div class="w-[67%] bg-[#EBE9E6] rounded-full h-2.5 drk:bg-gray-700 ml-[16px]">
                <div class="bg-[#FFC700] h-2.5 rounded-full" style="width: {{ $fiveStars['average'] }}%"></div>
              </div>
              <p class=" ml-[16px]">({{ $fiveStars['count'] }})</p>
            </div>
            <div class="flex lg:justify-between justify-start items-center  sm:w-[466px] ">
              <p class="font-semibold text-sm text-[#0096D8]">4 Stars</p>
              <div class="w-[67%] bg-[#EBE9E6] rounded-full h-2.5 drk:bg-gray-700  ml-[16px]">
                <div class="bg-[#FFC700] h-2.5 rounded-full" style="width: {{ $fourStars['average'] }}%"></div>
              </div>
              <p  class=" ml-[16px]">({{ $fourStars['count'] }})</p>
            </div>
            <div class="flex lg:justify-between justify-start items-center  sm:w-[466px]">
              <p class="font-semibold text-sm text-[#0096D8]">3 Stars</p>
              <div class="w-[67%] bg-[#EBE9E6] rounded-full h-2.5 drk:bg-gray-700  ml-[16px]">
                <div class="bg-[#FFC700] h-2.5 rounded-full" style="width: {{ $threeStars['average'] }}%"></div>
              </div>
              <p  class=" ml-[16px]">({{ $threeStars['count'] }})</p>
            </div>
            <div class="flex lg:justify-between justify-start items-center  sm:w-[466px] ">
              <p class="font-semibold text-sm text-[#0096D8]">2 Stars</p>
              <div class="w-[67%] bg-[#EBE9E6] rounded-full h-2.5 drk:bg-gray-700  ml-[16px]">
                <div class="bg-[#FFC700] h-2.5 rounded-full" style="width: {{ $twoStars['average'] }}%"></div>
              </div>
              <p  class=" ml-[16px]">({{ $twoStars['count'] }})</p>
            </div>
            <div class="flex lg:justify-between justify-start items-center  sm:w-[466px] ">
              <p class="font-semibold text-sm text-[#0096D8]">1 Stars</p>
              <div class="w-[67%] bg-[#EBE9E6] rounded-full h-2.5 drk:bg-gray-700  ml-[16px]">
                <div class="bg-[#FFC700] h-2.5 rounded-full" style="width: {{ $oneStar['average'] }}%"></div>
              </div>
              <p  class=" ml-[16px]">({{ $oneStar['count'] }})</p>
            </div>
        </div>

    </div>
     <!-- Comments -->
     <div class="mt-4">
        {{-- <div class="flex justify-start items-center">
            <label for="countries" class="block text-base font-medium text-gray-900 drk:text-white">Short By</label>
            <select id="countries" class="bg-white w-max border-none text-gray-900 font-semibold text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block">
            <option selected>Most Relevant</option>
            <option value="US">Most Relevant</option>
            </select>
        </div> --}}
        <div class="space-y-6">
            @foreach ($reviews as $review)
                <div class=" border-t border-[#E2EAED] pt-6">
                    <article  wire:key="{{ $review->id }}">
                        <div class="flex items-start mb-4 space-x-4">
                            <img class="w-10 h-10 rounded-full" src="https://ui-avatars.com/api/?name={{ $this->getUserName($review->from_user_id) }}" alt="">
                            <div class="space-y-1 font-medium drk:text-white sm:max-w-2xl">
                                <p class="text-base font-semibold text-[#263238]">{{ $this->getUserName($review->from_user_id) }}</p>
                                {{-- <div class="flex justify-start items-center gap-2">
                                    <img class="w-6 h-4" src="./images/flag-1.png" alt="">
                                    <span>Argentina</span>
                                </div> --}}
                                <div>
                                    <div class="flex items-center mb-1">
                                        <svg aria-hidden="true" class="w-5 h-5 {{$review->rating > 0 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500'}} " fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>First star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg aria-hidden="true" class="w-5 h-5 {{$review->rating > 1 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500'}}"  fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Second star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg aria-hidden="true" class="w-5 h-5 {{$review->rating > 2 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500'}}"  fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Third star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg aria-hidden="true" class="w-5 h-5 {{$review->rating > 3 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500'}}"  fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fourth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <svg aria-hidden="true" class="w-5 h-5 {{$review->rating > 4 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500'}}"  fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Fifth star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                        <h3 class="ml-2 text-sm font-semibold text-gray-900 drk:text-white">{{$review->created_at->diffForHumans()}}</h3>
                                        <livewire:forms.create-report :content="$review" contentType="{{App\Enums\ReportType::Review->value}}" wire:key="'gig-review-report'.{{ $review->id }}"/>
                                    </div>
                                    <div class="flex gap-1">
                                    <p class="mb-2 font-normal text-[#6A6A6A] drk:text-gray-400">{{ $review->review }}</p>

                                    </div>
                                    {{-- <aside>
                                        <div class="flex items-center mt-3 space-x-3 gap-3 divide-gray-200 drk:divide-gray-600">
                                            <p class="text-gray-900 font-semibold bg-white border border-gray-300 focus:outline-none  focus:ring-4 focus:ring-gray-200 rounded-lg text-xs px-2 py-1.5 drk:bg-gray-800 drk:text-white drk:border-gray-600 drk:hover:bg-gray-700 drk:hover:border-gray-600 drk:focus:ring-gray-700">Helpful?</p>
                                            <div class="flex justify-start items-center gap-2">
                                                <button class="text-sm font-normal text-[#263238] hover:text-[#0096D8]"><i class="fa-light fa-thumbs-up mr-1"></i> Yes</button>
                                                <button class="text-sm font-normal text-[#263238] hover:text-[#0096D8]"><i class="fa-light fa-thumbs-down mr-1"></i> No</button>
                                            </div>
                                        </div>
                                    </aside> --}}
                                </div>



                            </div>
                        </div>
                    </article>
                </div>
            @endforeach
            @if ($totalReviews > 4)
                <div class="mt-5" x-data="{ showMore: @entangle('showMoreLink') }">
                    @if ($showMoreLink)
                    <a wire:click="loadMoreReviews({{ $totalReviews }})"
                    class="cursor-pointer text-[#2646C4] text-[17px] underline"> See More </a>
                    @else
                    <a wire:click="loadLessReviews()" x-show="!showMore"
                    class="cursor-pointer text-[#2646C4] text-[17px] underline">See Less </a>
                    @endif
                </div>
          @endif

    </div>
    <!-- Comments -->
    @else
        <p>No review yet.</p>
    @endif
</div>
