<div class="mx-8">
    <div
        class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
            <h6>Sellers table</h6>
        </div>
        <div class="flex items-center md:ml-auto md:pr-4">
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft">
                <span
                    class="text-sm ease-soft leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                    <i class="fas fa-search"></i>
                </span>
                <input wire:model="search" type="search"
                    class="pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                    placeholder="Type here..." />
            </div>
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft px-1">
                <select wire:change="filterBy($event.target.value)"
                    class="pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                    <option value="">Sort By</option>
                    <option value="stat.money_earned">Top Gross</option>
                    <option value="stat.total_orders">Most Orders</option>
                </select>
            </div>
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft px-1">
                <select wire:model="limit"
                    class="pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                    <option value="">All</option>
                    <option value="5">Top 5</option>
                    <option value="10">Top 10</option>
                    <option value="20">Top 20</option>
                </select>
            </div>
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft px-1">
                <select wire:model="filterDate"
                    class="pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                    <option value="">All Time</option>
                    <option value="1">Last Day</option>
                    <option value="2">Last Week</option>
                    <option value="3">Last Month</option>
                    <option value="4">Last Year</option>
                </select>
            </div>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <x-AdminPanel.table>
                    <x-AdminPanel.table.thead>
                        <tr>
                            <th
                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('sellers.seller_name')" type="button">Name</button>
                                    <x-sort-icon
                                        field="sellers.seller_name"
                                        :sortField="$sortField"
                                        :sortAsc="$sortAsc"
                                    />
                                </div>
                            </th>
                            <th
                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('users.email')" type="button">Email</button>
                                    <x-sort-icon
                                        field="users.email"
                                        :sortField="$sortField"
                                        :sortAsc="$sortAsc"
                                    />
                                </div>
                            </th>
                            <th
                                class="px-3 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('sellers.gigs_count')" type="button">Services Count</button>
                                    <x-sort-icon
                                        field="sellers.gigs_count"
                                        :sortField="$sortField"
                                        :sortAsc="$sortAsc"
                                    />
                                </div>
                            </th>
                            <th
                                class="px-3 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('stat.total_orders')" type="button">Total Orders</button>
                                    <x-sort-icon
                                        field="stat.total_orders"
                                        :sortField="$sortField"
                                        :sortAsc="$sortAsc"
                                    />
                                </div>
                            </th>
                            <th
                                class="px-3 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('stat.orders_completed')" type="button">Completed Orders</button>
                                    <x-sort-icon
                                        field="stat.orders_completed"
                                        :sortField="$sortField"
                                        :sortAsc="$sortAsc"
                                    />
                                </div>
                            </th>
                            <th
                                class="px-3 py-3 font-bold text-left align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    Payment Configured

                                </div>
                            </th>
                            <th
                                class="px-3 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('stat.total_reviews')" type="button">Total Reviews</button>
                                    <x-sort-icon
                                        field="stat.total_reviews"
                                        :sortField="$sortField"
                                        :sortAsc="$sortAsc"
                                    />
                                </div>
                            </th>
                            <th
                                class="px-3 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('stat.reviews_average')" type="button">Reviews Average</button>
                                    <x-sort-icon
                                        field="stat.reviews_average"
                                        :sortField="$sortField"
                                        :sortAsc="$sortAsc"
                                    />
                                </div>
                            </th>
                            <th
                                class="px-3 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('stat.money_earned')" type="button">Money Earned</button>
                                    <x-sort-icon
                                        field="stat.money_earned"
                                        :sortField="$sortField"
                                        :sortAsc="$sortAsc"
                                    />
                                </div>
                            </th>
                            <th
                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('sellers.created_at')" type="button">Date</button>
                                    <x-sort-icon
                                        field="sellers.created_at"
                                        :sortField="$sortField"
                                        :sortAsc="$sortAsc"
                                    />
                                </div>
                            </th>
                            <th
                            class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Verification Status
                            </th>
                            <th
                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Status
                            </th>
                            <th
                            class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Qualification
                        </th>
                        </tr>
                    </x-AdminPanel.table.thead>
                    <tbody>
                        @forelse ($sellers as $seller)
                            <tr wire:key="{{ $seller->id }}">
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $seller->seller_name }}</h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $seller->email }}</h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $seller->gigs_count }}</h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $seller->total_orders }}</h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">
                                                {{ $seller->orders_completed }}</h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="{{$seller->stripe_onboarded ? 'bg-green-500' : 'bg-red-500'}}  text-white rounded-full p-1 mb-0 leading-normal text-sm">
                                                {{$seller->stripe_onboarded ? 'Yes' : 'No'}}</h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">
                                                {{ $seller->total_reviews }}</h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">
                                                {{ $seller->reviews_average }}</h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">
                                                ${{ $seller->money_earned }}</h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $seller->created_at->format('M, d Y') }}</h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell >
                                    <button
                                    wire:click="openVerficationStatus({{ $seller->id }})"
                                        class="{{ $seller->verification_status == 'passed' ? 'bg-green-500' : ($seller->verification_status == 'pending' ? 'bg-yellow-300' :
                                        ($seller->verification_status == 'failed' ? 'bg-red-500' : 'bg-transparent')) }} text-white text-xs py-2 px-4 rounded-full">
                                        {{ strtoupper($seller->verification_status) }}
                                    </button>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell >
                                    <button
                                        wire:click="changeStatus({{ $seller->id }}, {{ $seller->is_approved }})"
                                        class="{{ $seller->is_approved == 1 ? 'bg-green-500' : 'bg-red-500' }} text-white text-xs py-2 px-4 rounded-full">
                                        {{ $seller->is_approved == 1 ? 'Approved' : 'Pending Approval' }}
                                    </button>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell >
                                    <button
                                        wire:click="showQualification({{ $seller->id }})"
                                        class="bg-green-500 text-white text-xs py-2 px-4 rounded-full">
                                       View
                                    </button>
                                </x-AdminPanel.table.cell>
                            </tr>
                        @empty
                            <tr>
                                <td class="py-4 px-6 text-center" colspan="10">
                                    No Record Found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </x-AdminPanel.table>
            </div>
        </div>
        <div class="px-3 py-2">
            {{ $sellers->links('vendor.livewire.custom-pagination') }}
        </div>
    </div>

    {{-- Confirm Status Change Modal --}}
    <x-Modals.change-status-modal message="You are going to {{ $statusChangeInfo['statusValue'] ? 'approve' : 'disapprove' }} seller" />

    <x-Modals.modal modalId="showQualification" title="Qualification">
        @slot('content')
        <div class="!overflow-x-auto ">
        <x-AdminPanel.table  >
            <x-AdminPanel.table.thead>
                <tr>
                    <th class="px-3 py-3 font-bold text-left align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                        <div class="flex items-center">
                            Title
                        </div>
                    </th>
                    <th class="px-3 py-3 font-bold text-left align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                        <div class="flex items-center">
                            Institute
                        </div>
                    </th>
                </tr>
            </x-AdminPanel.table.thead>
            <tbody >
                @foreach ($qualifications as $qual)
                <tr >
                    <x-AdminPanel.table.cell>
                        <div class="flex px-2 py-1">
                            <div class="flex flex-col justify-center">

                                <h6 class="mb-0 leading-normal text-sm">{{ $qual->title }}</h6>
                            </div>
                        </div>
                    </x-AdminPanel.table.cell>

                    <x-AdminPanel.table.cell>
                        <div class="flex px-2 py-1">
                            <div class="flex flex-col justify-center">
                                <h6 class="mb-0 leading-normal text-sm">{{ $qual->institute }}</h6>
                            </div>
                        </div>
                    </x-AdminPanel.table.cell>
                </tr>
                @endforeach

            </tbody>
        </x-AdminPanel.table>
        </div>
        @endslot
    </x-Modals.modal>
@if($verificationModal)
    <x-Modals.modal modalId="verificationModal" title="{{ $verificationStatus['title'] }}">
        @slot('content')
        <div class="">
{{ $verificationStatus['description'] }}
        </div>
        @endslot
    </x-Modals.modal>
    @endif
</div>
