<div>
    <section class="mt-22 relative flex justify-center items-center">
        <div
          class="bg-cover bg-center bg-no-repeat w-full py-20"
          style="background-image: url({{ asset('new-images/shop-her0-bg.png') }})"
        >
          <div class="container xl:max-w-screen-2xl mx-auto px-4 relative mt-24">
            <div class="grid space-y-3 text-center">
              <h1 class="text-4xl font-semibold">About The Seller</h1>
              <div class="flex justify-center items-center gap-3">
                @if (!isset($seller->user->profile_photo_path))
                <img class="rounded-full w-20 h-20 flex-shrink-0 "
                    src="https://ui-avatars.com/api/?name={{ $seller->seller_name }}"
                    alt="">
                @else
                    <img class="rounded-full w-20 h-20 flex-shrink-0"
                        src="{{ asset('/storage/' . $user->profile_photo_path) }}" alt="">
                @endif


                <div>
                  <h1 class="text-[#263238] font-bold">{{ $seller->seller_name }}</h1>
                  <div class="flex justify-start items-center">
                    <div
                      class="bg-white rounded-full w-6 h-6 flex justify-center items-center shadow-xl"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="20"
                        height="20"
                        viewBox="0 0 20 20"
                        fill="none"
                      >
                        <rect
                          x="0.199951"
                          y="0.400024"
                          width="19.2"
                          height="19.2"
                          fill="url(#pattern0)"
                        ></rect>
                        <defs>
                          <pattern
                            id="pattern0"
                            patternContentUnits="objectBoundingBox"
                            width="1"
                            height="1"
                          >
                            <use
                              xlink:href="#image0_40_3413"
                              transform="scale(0.0111111)"
                            ></use>
                          </pattern>
                          <image
                            id="image0_40_3413"
                            width="90"
                            height="90"
                            xlink:href="data:image/png;base64,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"
                          ></image>
                        </defs>
                      </svg>
                    </div>
                    <p class="text-sm text-[#6A6A6A]">Verified seller</p>
                  </div>
                  <div class="flex justify-start items-center gap-2 mt-1">
                    <i class="fa-solid fa-star  {{ $sellerStats->reviews_average > 0 ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                    <i class="fa-solid fa-star  {{ $sellerStats->reviews_average > 1 ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                    <i class="fa-solid fa-star  {{ $sellerStats->reviews_average > 2 ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                    <i class="fa-solid fa-star  {{ $sellerStats->reviews_average > 3 ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                    <i class="fa-solid fa-star  {{ $sellerStats->reviews_average > 4 ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                    <p class="text-xs text-[#111827]">({{ $sellerStats->total_reviews }})</p>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </section>

      <section class="mt-10 md:mt-20">
        <div class="container xl:max-w-screen-xl mx-auto px-4">
          <div class="border border-[#E2EAED] rounded-lg p-5 xl:p-9">
            <div
              class="grid sm:grid-cols-2 gap-x-6 md:gap-x-36 gap-y-5 border-[#E2EAED] sm:w-max mx-auto"
            >
              <div>
                <p class="text-black font-semibold">From</p>
                <h1 class="text-[#263238]">{{ $country->name }}</h1>
              </div>
              <div>
                <p class="text-black font-semibold">Member Since</p>
                <h1 class="text-[#263238]"> {{ $seller->joined_on->format('M d, Y') }}</h1>
              </div>
              <div>
                <p class="text-black font-semibold">Avg. Response Time</p>
                <h1 class="text-[#263238]">1 Hour</h1>
              </div>
              @if (count(
                $seller->load([
                    'orders' => function ($query) {
                        $query->where('status', App\Enums\OrderStatus::Completed->value)->latest();
                    },
                ])->orders) > 0)
              <div>
                <p class="text-black font-semibold">Last Delivery</p>
                <h1 class="text-[#263238]"> {{ $seller->load(['orders' => function ($query) {$query->where('status', App\Enums\OrderStatus::Completed->value)->latest();}])->orders[0]->updated_at->diffForHumans() }}</h1>
              </div>
              @endif
            </div>
            <p class="text-[#263238] text-sm sm:text-center mt-6 sm:mt-20">
                {{ $sellerDetails->description }}
            </p>
          </div>
        </div>
      </section>

</div>
