<x-AdminPanel.card-wrapper>
    <div class="flex flex-wrap -mx-3">
        <!-- card1 -->
        <x-AdminPanel.card title="Total Revenue" :value="'$' . $financialTransactions" class="ni-money-coins"></x-AdminPanel.card>

        <!-- card2 -->
        <x-AdminPanel.card title="Total Commission" :value="'$' . $totalCommission" class="ni-world"></x-AdminPanel.card>

        <!-- card3 -->
        <x-AdminPanel.card title="Estimated Revenue" :value="'$' . $estimatedRevenue" class="ni-paper-diploma"></x-AdminPanel.card>

        <!-- card4 -->
        <x-AdminPanel.card title="Refunded Transactions" :value="'$' . $refundedTransactions" class="ni-cart"></x-AdminPanel.card>
    </div>

    <div class="flex flex-wrap mt-6 -mx-0">
        <div
            class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                <h6>Orders table</h6>
            </div>
            <div class="flex items-center md:ml-auto md:pr-4">
                <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft px-1">
                    <select wire:model="filterStatus"
                        class="pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                        <option value="">All</option>
                        @foreach (App\Enums\OrderStatus::cases() as $orderStatus)
                            <option value="{{ $orderStatus->value }}">{{ $orderStatus->value }}</option>
                        @endforeach
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
                                        <button type="button">Order#</button>
                                        {{-- <x-sort-icon field="name" :sortField="$sortField" :sortAsc="$sortAsc" /> --}}
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    <div class="flex items-center">
                                        <button type="button">Service</button>
                                        {{-- <x-sort-icon field="email" :sortField="$sortField" :sortAsc="$sortAsc" /> --}}
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    <div class="flex items-center">
                                        <button type="button">Date</button>
                                        {{-- <x-sort-icon field="total_orders" :sortField="$sortField" :sortAsc="$sortAsc" /> --}}
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    <div class="flex items-center">
                                        <button type="button">Total</button>
                                        {{-- <x-sort-icon field="total_reviews" :sortField="$sortField" :sortAsc="$sortAsc" /> --}}
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    <div class="flex items-center">
                                        <button type="button">Status</button>
                                        {{-- <x-sort-icon field="total_reviews" :sortField="$sortField" :sortAsc="$sortAsc" /> --}}
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    <div class="flex items-center">
                                        <button type="button">Earning</button>
                                        {{-- <x-sort-icon field="created_at" :sortField="$sortField" :sortAsc="$sortAsc" /> --}}
                                    </div>
                                </th>
                            </tr>
                        </x-AdminPanel.table.thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <x-AdminPanel.table.cell>
                                        <div class="flex px-2 py-1">
                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 leading-normal text-sm">{{ $order->id }}</h6>
                                            </div>
                                        </div>
                                    </x-AdminPanel.table.cell>

                                    <x-AdminPanel.table.cell>
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $order->gig_title }}</h6>
                                        </div>
                                    </x-AdminPanel.table.cell>

                                    <x-AdminPanel.table.cell>
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">
                                                {{ $order->created_at->format('M d, Y') }}</h6>
                                        </div>
                                    </x-AdminPanel.table.cell>

                                    <x-AdminPanel.table.cell>
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">${{ $order->amount }}</h6>
                                        </div>
                                    </x-AdminPanel.table.cell>

                                    <x-AdminPanel.table.cell>
                                        <div class="flex px-2 py-1">
                                            <div class="flex flex-col justify-center">
                                                <h6
                                                    class="mb-0 bg-{{ $order->statusColor() }}-500 px-4 py-1 rounded-full leading-normal text-sm">
                                                    {{ $order->status }}</h6>
                                            </div>
                                        </div>
                                    </x-AdminPanel.table.cell>

                                    <x-AdminPanel.table.cell>
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">
                                                ${{ $order->total }}
                                            </h6>
                                        </div>
                                    </x-AdminPanel.table.cell>
                                </tr>
                            @empty
                                <td class="py-4 px-6 text-center" colspan="6">
                                    No Record Found
                                </td>
                            @endforelse

                        </tbody>
                    </x-AdminPanel.table>
                </div>
                <div class="px-3 py-2">
                    {{ $orders->links('vendor.livewire.custom-pagination') }}
                </div>
            </div>
        </div>
    </div>
</x-AdminPanel.card-wrapper>
