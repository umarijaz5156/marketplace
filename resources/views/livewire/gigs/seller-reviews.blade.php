<div class="mt-6 relative">
    @if ($totalReviews > 0)
    <div class="flex justify-end items-center absolute top-0 right-0 z-10">
      <button
        class="px-2 py-1.5 text-xs font-medium text-center text-gray-900 align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20 flex justify-start items-center gap-2 reviewsPrev"
        type="button" data-ripple-dark="true">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="22" viewBox="0 0 39 22" fill="none">
          <path
            d="M10.8462 0.718406L0.0059561 11.091L10.8343 21.4749L12.6563 19.7314L4.93482 12.3269L38.573 12.3445L38.5744 9.8776L4.93648 9.86004L12.6662 2.46376L10.8462 0.718406Z"
            fill="black"></path>
        </svg>
      </button>
      <button
        class="px-2 py-1.5 font-medium text-center text-gray-900 align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20 reviewsNext"
        type="button" data-ripple-dark="true">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="22" viewBox="0 0 39 22" fill="none">
          <path
            d="M28.1693 0.72866L39.0095 11.1012L28.1812 21.4851L26.3592 19.7417L34.0807 12.3372L0.442513 12.3547L0.441097 9.88785L34.079 9.87029L26.3493 2.47402L28.1693 0.72866Z"
            fill="black"></path>
        </svg>
      </button>
    </div>
    <div class="swiper myReviews">
      <div class="swiper-wrapper">
        @foreach ($reviews as $review)
        <div class="swiper-slide">
          <div class="swiper-slide">
            <div class="flex items-start mb-4 space-x-4">
                @if (!isset($review->sentByUser->profile_photo_path))
                <img class="rounded-full max-w-[40px] w-full max-h-[40px] h-full flex-shrink-0"
                    src="https://ui-avatars.com/api/?name={{ $review->sentByUser->name }}"
                    alt="">
            @else
                <img class="rounded-full max-w-[40px] w-full h-[40px] flex-shrink-0 "
                    src="{{ asset('/storage/' . $review->sentByUser->profile_photo_path) }}" alt="">
            @endif


              <div class="space-y-1 font-medium drk:text-white sm:max-w-2xl">
                <p class="text-sm font-semibold text-[#263238]">
                    {{ $review->sentByUser->name }}
                </p>

                <div>
                  <div class="flex items-center mb-1">
                    <svg aria-hidden="true" class="w-5 h-5 {{ $review->rating > 0 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500' }}" fill="currentColor"
                      viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <title>First star</title>
                      <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                      </path>
                    </svg>
                    <svg aria-hidden="true" class="w-5 h-5 {{ $review->rating > 1 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500' }}" fill="currentColor"
                      viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <title>Second star</title>
                      <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                      </path>
                    </svg>
                    <svg aria-hidden="true" class="w-5 h-5 {{ $review->rating > 2 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500' }}" fill="currentColor"
                      viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <title>Third star</title>
                      <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                      </path>
                    </svg>
                    <svg aria-hidden="true" class="w-5 h-5 {{ $review->rating > 3 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500' }}" fill="currentColor"
                      viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <title>Fourth star</title>
                      <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                      </path>
                    </svg>
                    <svg aria-hidden="true" class="w-5 h-5 {{ $review->rating > 4 ? 'text-yellow-400' : 'text-gray-300 drk:text-gray-500' }}" fill="currentColor"
                      viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <title>Fifth star</title>
                      <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                      </path>
                    </svg>
                    <h3 class="ml-2 text-sm font-semibold text-gray-900 drk:text-white">
                        {{ $review->created_at->diffForHumans() }}
                    </h3>
                  </div>
                  <p class="mb-2 font-normal text-[#6A6A6A] text-sm">
                    {{ $review->review }}
                  </p>
                  <div class="flex justify-start items-center gap-2">
                    <button
                      class="px-2 py-1.5 text-xs border font-medium text-center text-gray-900 align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20"
                      type="button" data-ripple-dark="true">
                      Helpful?
                    </button>
                    <button
                      class="px-2 py-1.5 text-xs font-medium text-center text-gray-900 align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20 flex justify-start items-center gap-2"
                      type="button" data-ripple-dark="true">
                      <i class="fa-regular fa-thumbs-up text-[#699F4C]"></i>
                      Yes
                    </button>
                    <button
                      class="px-2 py-1.5 text-xs font-medium text-center text-gray-900 align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20 flex justify-start items-center gap-2"
                      type="button" data-ripple-dark="true">
                      <i class="fa-regular fa-thumbs-down"></i> No
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    @endif
  </div>
