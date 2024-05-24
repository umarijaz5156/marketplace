
    <section class="">
        <div class="bg-[#F4FCFF]">
            <div class="container 2xl:max-w-screen-xl mx-auto px-4 h-full pt-14 lg:min-h-[20vh] relative">
                <div class="flex justify-between">
                    <div>
                        <h1 class="text-[#263238] text-5xl font-bold">Request #{{ $request->id }}</h1>
                        <p class="text-[#6A6A6A] text-lg font-medium mt-3"></p>
                    </div>

                </div>

            </div>
        </div>
        <div class="container 2xl:max-w-screen-xl  mx-auto px-4 h-full mt-14">


            <!-- Author card -->
            <div
                class="relative w-full  my-8 md:my-16 flex flex-col items-start space-y-4 sm:flex-row sm:space-y-0 sm:space-x-6 px-4 py-8 border-2 border-dashed border-gray-400 dark:border-gray-400 shadow-lg rounded-lg">


                <span class="absolute font-medium top-0 right-0 rounded-br-lg rounded-tl-lg px-2 py-1 bg-primary-100 dark:bg-gray-900 dark:text-gray-300  ">
                    <div class="mx-auto flex  w-full max-w-md flex-row justify-end gap-10">

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48">
                                <path
                                    d="M12 40q-3.3 0-5.65-2.35Q4 35.3 4 32V16q0-3.3 2.35-5.65Q8.7 8 12 8h24q3.3 0 5.65 2.35Q44 12.7 44 16v16q0 3.3-2.35 5.65Q39.3 40 36 40Zm0-23.5h24q1.45 0 2.725.45Q40 17.4 41 18.25V16q0-2.1-1.45-3.55Q38.1 11 36 11H12q-2.1 0-3.55 1.45Q7 13.9 7 16v2.25q1-.85 2.275-1.3Q10.55 16.5 12 16.5Zm-4.85 6.8L31 29.05q.35.1.725.025.375-.075.625-.325l8-6.7q-.65-1.15-1.8-1.85-1.15-.7-2.55-.7H12q-1.75 0-3.1 1.075T7.15 23.3Z" />
                            </svg>
                           ${{ $request->min_budget }}-{{ $request->max_budget }}
                        </div>

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48">
                                <path
                                    d="M24 23.95q-3.3 0-5.4-2.1-2.1-2.1-2.1-5.4 0-3.3 2.1-5.4 2.1-2.1 5.4-2.1 3.3 0 5.4 2.1 2.1 2.1 2.1 5.4 0 3.3-2.1 5.4-2.1 2.1-5.4 2.1ZM8 40v-4.7q0-1.9.95-3.25T11.4 30q3.35-1.5 6.425-2.25Q20.9 27 24 27q3.1 0 6.15.775 3.05.775 6.4 2.225 1.55.7 2.5 2.05.95 1.35.95 3.25V40Zm3-3h26v-1.7q0-.8-.475-1.525-.475-.725-1.175-1.075-3.2-1.55-5.85-2.125Q26.85 30 24 30t-5.55.575q-2.7.575-5.85 2.125-.7.35-1.15 1.075Q11 34.5 11 35.3Zm13-16.05q1.95 0 3.225-1.275Q28.5 18.4 28.5 16.45q0-1.95-1.275-3.225Q25.95 11.95 24 11.95q-1.95 0-3.225 1.275Q19.5 14.5 19.5 16.45q0 1.95 1.275 3.225Q22.05 20.95 24 20.95Zm0-4.5ZM24 37Z" />
                            </svg>
                            {{ $request->proposals?->count() }} Bids
                        </div>
                    </div>
                </span>

                <div class="w-full flex justify-center sm:justify-start sm:w-auto">
                    @if (!isset($request->user?->profile_photo_path))
                    <img class="object-cover w-20 h-20 mt-3 mr-3 rounded-full"
                        src="https://ui-avatars.com/api/?name={{ $request->user?->name }}" alt="">
                    @else
                    <img class="object-cover w-20 h-20 mt-3 mr-3 rounded-full "
                        src="{{ asset('/storage/' . $request->user?->profile_photo_path) }}" alt="">
                    @endif
                    {{-- <img class="object-cover w-20 h-20 mt-3 mr-3 rounded-full"
                        src="https://lh3.googleusercontent.com/a/AEdFTp70cvwI5eevfcr4LonOEX5gB2rzx7JnudOcnYbS1qU=s96-c">
                    --}}
                </div>

                <div class="w-full flex flex-col items-center sm:items-start">

                    <p class="font-display mb-2 text-2xl font-semibold dark:text-gray-200" itemprop="author">
                        {{ $request->user?->name }}
                    </p>

                    <div class="mb-4 md:text-lg text-gray-600">
                        <p>{{ $request->requirements }}</p>
                    </div>

                </div>
                @if($this->canBid())
                <span  class="absolute font-medium bottom-0 right-0 rounded-br-lg rounded-tl-lg  bg-primary-100 dark:bg-gray-900 dark:text-gray-300  ">
                    <button wire:click='bid()' type="button" class="bg-green-300 hover:bg-green-500 hover:text-white rounded px-6 py-3 text-green-700 font-medium text-sm">Place Bid</button>
                </span>
            @endif

            </div>
        </div>
    </section>

