<table class="mt-8 w-full text-left rtl:text-right">
    <thead class="text-lg text-gray-700 uppercase bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-3">Packages</th>
          <th scope="col" class="px-6 py-3">US${{ $basicPackage->price }}</th>
          <th scope="col" class="px-6 py-3">US${{ $standardPackage->price}}</th>
          <th scope="col" class="px-6 py-3">US${{ $premiumPackage->price }}</th>
        </tr>
      </thead>
    <tbody>
        <tr   class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                {{-- Package --}}
            </th>
            {{-- basic --}}
            <td class="py-4 px-6 border-l border-[#E2EAED]">
                <div class="space-y-6 max-w-[250px]">
                    {{-- <span class="font-bold">US${{ $basicPackage->price }}</span> --}}
                    <h2 class="font-bold">{{ $basicPackage->package_name }}</h2>
                    <p>{{ $basicPackage->package_description }}</< /p>
                </div>
            </td>
            <td class="py-4 px-6 border-l border-[#E2EAED]">
                <div class="space-y-6 max-w-[250px]">
                    {{-- <span class="font-bold">US${{ $standardPackage->price}}</span> --}}
                    <h2 class="font-bold">{{ $standardPackage->package_name }}</h2>
                    <p>{{ $standardPackage->package_description }}</p>
                </div>
            </td>
            <td class="py-4 px-6 border-l border-[#E2EAED]">
                <div class="space-y-6 max-w-[250px]">
                    {{-- <span class="font-bold">US${{ $premiumPackage->price }}</span> --}}
                    <h2 class="font-bold">{{ $premiumPackage->package_name }}</h2>
                    <p>{{ $premiumPackage->package_description }}</p>
                </div>
            </td>
        </tr>
        <tr  class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 dark:border-gray-700">
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                Delivery Time
            </th>
            <td class="py-4 px-6 border-l border-[#E2EAED]">
                <p>{{ $basicPackage->delivery_days }} {{ $basicPackage->delivery_days > 1 ? 'Days' : 'Day' }}
                </p>
            </td>
            <td class="py-4 px-6 border-l border-[#E2EAED]">
                <p>{{ $standardPackage->delivery_days }} {{ $standardPackage->delivery_days > 1 ? 'Days' : 'Day'
                    }}</p>
            </td>
            <td class="py-4 px-6 border-l border-[#E2EAED]">
                <p>{{ $premiumPackage->delivery_days }} {{ $premiumPackage->delivery_days > 1 ? 'Days' : 'Day'
                    }}</p>
            </td>
        </tr>
        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800">
            <th scope="row"
            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap flex justify-start items-center gap-2">
                Total
            </th>
            <td class="px-6 py-4">
                <div class="text-center">
                    <span class="font-bold">US${{ $basicPackage->price }}</span>
                    @if(auth()->check())
                    @can('create', App\Models\Order::class)
                    @if(!$isOwner)
                    @if($gig->seller->stripe_onboarded)
                    <livewire:orders.create-order :gig="$gig" title="Select"
                        class="w-full mt-3 text-white bg-[#0096D8] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-3 sm:px-8 py-3 drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800 text-sm sm:text-lg"
                        :price="$basicPackage->price" :package="$basicPackage">
                    @else
                        <p class="text-red-500 my-5 text-sm">Cannot place order! this seller has payment issues</p>
                    @endif

                        @endif
                        @endcan
                        @cannot('create', App\Models\Order::class)
                        <p class="text-red-500 my-5 text-sm">Cannot place order</p>
                        @endcannot
                        @endif
                </div>
            </td>
            <td class="px-6 py-4">
                <div class="text-center">
                    <span class="font-bold">US${{ $standardPackage->price }}</span>
                    @if(auth()->check())
                    @can('create', App\Models\Order::class)
                    @if(!$isOwner)
                    @if($gig->seller->stripe_onboarded)
                    <livewire:orders.create-order :gig="$gig" title="Select"
                        class="w-full mt-3 text-white bg-[#0096D8] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-3 sm:px-8 py-3 drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800 text-sm sm:text-lg"
                        :price="$standardPackage->price" :package="$standardPackage">
                        @else
                        <p class="text-red-500 my-5 text-sm">Cannot place order! this seller has payment issues</p>
                        @endif
                        @endif
                        @endcan
                        @cannot('create', App\Models\Order::class)
                        <p class="text-red-500 my-5 text-sm">Cannot place order</p>
                        @endcannot
                        @endif
                </div>
            </td>
            <td class="px-6 py-4">
                <div class="text-center">
                    <span class="font-bold">US${{ $premiumPackage->price }}</span>
                    @if(auth()->check())
                    @can('create', App\Models\Order::class)
                    @if(!$isOwner)
                    @if($gig->seller->stripe_onboarded)
                    <livewire:orders.create-order :gig="$gig" title="Select"
                        class="w-full mt-3 text-white bg-[#0096D8] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg px-3 sm:px-8 py-3 drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800 text-sm sm:text-lg"
                        :price="$premiumPackage->price" :package="$premiumPackage">
                    @else
                    <p class="text-red-500 my-5 text-sm">Cannot place order! this seller has payment issues</p>
                    @endif
                        @endif
                        @endcan
                        @cannot('create', App\Models\Order::class)
                        <p class="text-red-500 my-5 text-sm">Cannot place order</p>
                        @endcannot
                        @endif

                </div>
            </td>
        </tr>
    </tbody>
</table>
