<div class="container xl:max-w-screen-2xl mx-auto px-4">
    <div>
        <h1 class="text-black font-semibold text-4xl md:text-5xl">
            List of <span class="text-primary"> Best</span> <br />
            <span class="text-primary">Freelancers </span> at HotBleep 
        </h1>
    </div>
    <div class="freelance-slider mt-8 grid sm:grid-cols-2 xl:grid-cols-4 gap-5">
        @foreach ($freelancers as $freelancer)
        <div class="bg-[#F4F5F7] rounded-lg py-4 px-5 relative">
            <div class="absolute top-3 right-3">
                <button
                    class="align-middle select-none font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 h-10 flex justify-center items-center rounded-full bg-white text-white shadow-md shadow-[#F4F5F7]/10 hover:shadow-lg hover:shadow-[#F4F5F7]/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                    type="button" data-ripple-dark="true">
                    <i class="fa-regular fa-heart text-primary"></i>
                </button>
            </div>
            <div class="bg-[#0BA1E5] rounded-full p-2 w-36 h-36 mx-auto relative">
                <div
                    class="bg-white rounded-full w-6 h-6 flex justify-center items-center absolute top-6 right-0 shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20"
                        height="20" viewBox="0 0 20 20" fill="none">
                        <rect x="0.199951" y="0.400024" width="19.2" height="19.2" fill="url(#pattern0)" />
                        <defs>
                            <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_40_3413" transform="scale(0.0111111)" />
                            </pattern>
                            <image id="image0_40_3413" width="90" height="90"
                                xlink:href="data:image/png;base64,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" />
                        </defs>
                    </svg>
                </div>
                @if (isset($freelancer->profile_photo_path))
                <img class="w-full h-full rounded-full"
                    src="{{ asset('/storage/' . $freelancer->profile_photo_path) }}" alt="" />
                @else
                <img class="w-full h-full rounded-full"
                    src="{{ asset('/images/svg/profile.jpg') }}" alt="" />
                @endif

            </div>
            <div class="mt-4">
                <h1 class="text-lg font-medium text-center">{{$freelancer->seller_name}}</h1>
                <p class="text-sm font-light mt-5 text-ellipsis ... overflow-hidden h-[64px]">
                    {{ $freelancer->description }}
                </p>
                <a href="{{ route('view_profile', ['name' => $freelancer->seller_name]) }}">
                    <button
                        class="align-middle select-none font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none py-3 px-6 rounded-lg bg-white text-primary border border-primary shadow-md shadow-white/10 hover:shadow-lg hover:shadow-white/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none mt-4 w-full"
                        type="button" data-ripple-dark="true">
                        Check Service
                    </button>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
