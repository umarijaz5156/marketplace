<div  x-data="{ showAdvance: @entangle('showAdvance') }">
<div class="w-full lg:max-w-lg mx-auto border border-[#E2EAED] bg-white sticky top-32 rounded-lg"
    x-data="{ active: 1 }">
    <div class="flex justify-start items-center bg-[#EBF2FF] rounded-lg">
        <button class="px-4 py-2 font-bold w-full h-[60px] uppercase animate-[press_0.2s_linear] rounded-lg"
            @click="active = 1" x-bind:class="active == 1 ?
                'bg-primary text-white' :
                'bg-gray-100 text-black hover:text-[#0096D8]'">
            Basic
        </button>
        <button  x-show="showAdvance" class="px-4 py-2 font-bold w-full h-[60px] uppercase animate-[press_0.2s_linear] rounded-lg"
            @click="active = 2" x-bind:class="active == 2 ?
                'bg-primary text-white ' :
                'bg-gray-100 text-black hover:text-[#0096D8]'">
            STANDARD
        </button>
        <button x-show="showAdvance" class="px-4 py-2 font-bold w-full h-[60px] uppercase animate-[press_0.2s_linear] rounded-lg"
            @click="active = 3" x-bind:class="active == 3 ?
                'bg-primary text-white ' :
                'bg-gray-100 text-black hover:text-[#0096D8]'">
            PREMIUM
        </button>
    </div>
    <div class="relative overflow-auto rounded p-6 transition-all duration-300 ease-in space-y-11 animate-[show-transition_0.5s_ease-in-out] block"
        x-bind:class="active == 1 ? 'animate-[show-transition_0.5s_ease-in-out] block' : 'max-h-0 opacity-0 hidden'"
        x-show="active == 1"
        x-data="{ price: @entangle('basicPrice') }">
        <div class="flex justify-between items-center gap-5">
            <h2 class="uppercase text-base font-semibold">{{ $basicPackage->package_name }}</h2>
            <p class="font-medium text-xl text-primary">
                US$<span>{{ $basicPackage->price }}</span>
            </p>
        </div>
        <div class="">
            <p class="text-base font-medium text-[#263238]">
               {{ $basicPackage->package_description }}
            </p>
        </div>
        <div class="">
            <ul class="text-base text-[#263238] font-medium space-y-4 p-0">
                <li>
                    <div class="font-semibold text-base text-[#263238] flex justify-start items-center gap-3">
                        <i class="fa-regular fa-clock"></i>
                        <p>{{ $basicPackage->delivery_days }} Day Delivery</p>
                    </div>
                </li>
                @foreach ($basicPackage->services as $service)
                <li>
                    <div class="font-semibold text-base text-[#263238] flex justify-start items-center gap-3">
                        <i class="fa-regular fa-arrow-right-long"></i>
                        <p>{{$service->name}}</p>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="items-center gap-6">
            @if(auth()->check())
            @can('create', App\Models\Order::class)
                @if(!$isOwner)
                    @if($gig->seller->stripe_onboarded)
                        <livewire:orders.create-order :gig="$gig" :price="$basicPrice" :package="$basicPackage">
                    @else
                        <p class="text-red-500 my-5 text-sm">Cannot place order! this seller has payment issues</p>
                    @endif
                @endif
            @endcan
            @cannot('create', App\Models\Order::class)
                <p class="text-red-500 my-5 text-sm">Cannot place order you are banned</p>
            @endcannot

        @else
        <a href="{{ route('login') }}">
        <button type="button"  class="w-full mb-4 text-white bg-[#0096D8] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-3 sm:px-8 py-3 drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800 text-sm sm:text-lg">Order Now</button>
        </a>
        @endif
            {{-- <a href="#">
                <button type="button"
                    class="w-full mb-4 text-white bg-[#0096D8] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-3 sm:px-8 py-3 drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800 text-sm sm:text-lg">
                    Order Now
                </button>
            </a> --}}
        </div>
    </div>
    @if (isset($standardPackage) && isset($premiumPackage))
    <div x-show="showAdvance" x-data="{price: @entangle('standardPrice')}"  class="relative overflow-auto rounded p-6 transition-all duration-300 ease-in space-y-11 animate-[show-transition_0.5s_ease-in-out] block"
        x-bind:class="active == 2 ? 'animate-[show-transition_0.5s_ease-in-out] block' : 'max-h-0 opacity-0 hidden'"
       >
        <div class="flex justify-between items-center gap-5">
            <h2 class="uppercase text-base font-semibold">{{$standardPackage->package_name}}</h2>
            <p class="font-medium text-xl text-primary">
                US$<span>{{$standardPackage->price}}</span>
            </p>
        </div>
        <div class="">
            <p class="text-base font-medium text-[#263238]">
                {{$standardPackage->package_description}}
            </p>
        </div>
        <div class="">
            <ul class="text-base text-[#263238] font-medium space-y-4 p-0">
                <li>
                    <div class="font-semibold text-base text-[#263238] flex justify-start items-center gap-3">
                        <i class="fa-regular fa-clock"></i>
                        <p>{{ $standardPackage->delivery_days }} Day Delivery</p>
                    </div>
                </li>
                @foreach ($standardPackage->services as $service)
                <li>
                    <p{{ $service->name }}</p>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="items-center gap-6">
            @if(auth()->check())
            @can('create', App\Models\Order::class)
                @if(!$isOwner)
                @if($gig->seller->stripe_onboarded)
                     <livewire:orders.create-order :gig="$gig" :price="$standardPrice" :package="$standardPackage">
            @else
            <p class="text-red-500 my-5 text-sm">Cannot place order! this seller has payment issues</p>
            @endif

                @endif
            @endcan
            @cannot('create', App\Models\Order::class)
                <p class="text-red-500 my-5 text-sm">Cannot place order you are banned</p>
            @endcannot
         @else
             <a href="{{ route('login') }}">
             <button type="button"  class="w-full mb-4 text-white bg-[#0096D8] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-3 sm:px-8 py-3 drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800 text-sm sm:text-lg"}}">Order Now</button>
         </a>
             @endif
        </div>
    </div>
    <div x-show="showAdvance" x-data="{price: @entangle('premiumPrice')}" class="relative overflow-auto rounded p-6 transition-all duration-300 ease-in space-y-11 animate-[show-transition_0.5s_ease-in-out] block"
        x-bind:class="active == 3 ? 'animate-[show-transition_0.5s_ease-in-out] block' : 'max-h-0 opacity-0 hidden'"
        x-show="active == 3">
        <div class="flex justify-between items-center gap-5">
            <h2 class="uppercase text-base font-semibold">{{$premiumPackage->package_name}}</h2>
            <p class="font-medium text-xl text-primary">
                US$<span>{{$premiumPackage->price}}</span>
            </p>
        </div>
        <div class="">
            <p class="text-base font-medium text-[#263238]">
                {{$premiumPackage->package_description}}
            </p>
        </div>
        <div class="">
            <ul class="text-base text-[#263238] font-medium space-y-4 p-0">
                <li>
                    <div class="font-semibold text-base text-[#263238] flex justify-start items-center gap-3">
                        <i class="fa-regular fa-clock"></i>
                        <p>{{ $premiumPackage->delivery_days }} Day Delivery</p>
                    </div>
                </li>
                @foreach ($premiumPackage->services as $service)
                <li>
                    <p> {{$service->name}}</p>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="items-center gap-6">
            @if(auth()->check())
                       @can('create', App\Models\Order::class)
                           @if(!$isOwner)
                           @if($gig->seller->stripe_onboarded)
                               <livewire:orders.create-order :gig="$gig" :price="$premiumPrice" :package="$premiumPackage">
                            @else
                            <p class="text-red-500 my-5 text-sm">Cannot place order! this seller has payment issues</p>
                            @endif
                           @endif
                       @endcan
                       @cannot('create', App\Models\Order::class)
                           <p class="text-red-500 my-5 text-sm">Cannot place order you are banned</p>
                       @endcannot
                    @else
                        <a href="{{ route('login') }}">
                        <button type="button"  class="w-full mb-4 text-white bg-[#0096D8] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-3 sm:px-8 py-3 drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800 text-sm sm:text-lg"}}">Order Now</button>
                    </a>
                        @endif
        </div>
    </div>
    @endif

</div>
<div class="flex items-center justify-end mt-4">
    <livewire:forms.create-report :content="$gig" contentType="{{App\Enums\ReportType::Gig->value}}"/>
   </div>
</div>
