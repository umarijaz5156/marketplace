
<x-seller.dashboard-layout>


        <div>
            <div class="mt-[30px] mb-[46px] grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3  xl:grid-cols-4 ">
                {{-- stats card --}}
                    <livewire:seller.stats-card title="Total Income" :value="$totalIncome->total ?? 0" :show="true"/>
                    <livewire:seller.stats-card title="Orders Completed" :value="$totalIncome->orders_completed ?? 0" :show="false"/>
                    <livewire:seller.stats-card title="Earned in {{\Carbon\Carbon::now()->format('F')}}" :value="$currentMonthIncom->total ?? 0" :show="true"/>
                    <livewire:seller.stats-card title="Expected Income" :value="$expectedIncome->total ?? 0" :show="true"/>
                    {{-- <livewire:seller.stats-card/> --}}
                {{-- stats card --}}

            </div>

            {{-- <button  type="button"><a href="{{route('stripe.redirect', ['seller' => ])}}">Connect Stripe</a></button> --}}
        </div>
        <div>
            <div class="flex flex-wrap mt-6 -mx-3">
                {{-- graph --}}
                <livewire:seller.stats-graph />
                <div class="w-full max-w-full px-3 lg:w-4/12 lg:flex-none mt-[33px] lg:mt-0">
                    <div>
                        <livewire:seller.communication-card/>
                        <livewire:seller.refill-balance-card/>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3">
            <div class="md:col-span-2">
                <livewire:seller.orders.index />
            </div>
            <div class="md:col-span-1">
                <div class="mt-10 w-full md:max-w-md p-4 bg-white border rounded-lg shadow-md sm:p-8 drk:bg-gray-800 drk:border-gray-700">
                    <div class="flex items-center justify-between mb-4">
                        <h5 class="text-xl font-bold leading-none text-gray-900 drk:text-white">Notifications</h5>

                   </div>
                   <div class="flow-root">
                        <ul role="list" class="divide-y divide-gray-200 drk:divide-gray-700">
                             @forelse ($notifications as $notification)
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">

                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate drk:text-white">
                                            {{$notification->data['message']}}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate drk:text-gray-400">
                                            {{$notification->created_at->diffForHumans()}}
                                        </p>
                                    </div>

                                </div>
                            </li>
                               @empty
                                    <div class="pl-3 mt-4 w-full">

                                        <div class="text-center text-gray-500 text-sm mb-1.5 drk:text-gray-400">No new notification</div>

                                    </div>

                                @endforelse

                        </ul>
                   </div>
                </div>
            </div>
        </div>

    </div>

</x-seller.dashboard-layout>


