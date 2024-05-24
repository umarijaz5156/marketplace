<div class="px-8">
    <div>
        @if (session('success'))
            <x-alerts.success :success="session('success')" />
        @endif

        @if (session('error'))
            <x-alerts.error :error="session('error')" />
        @endif
    </div>

    <div class="flex-auto px-0 pt-0 pb-2">
        <div class="p-0 overflow-x-auto">
            <x-AdminPanel.table>
                <x-AdminPanel.table.thead>
                    <tr>
                        <th
                            class="px-3 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                <button type="button">Service</button>
                            </div>
                        </th>
                        <th
                            class="px-3 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                <button type="button">Seller</button>
                            </div>
                        </th>
                        <th
                            class="px-3 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                <button type="button">Buyer</button>
                            </div>
                        </th>
                        <th
                            class="px-3 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                <button type="button">Amount</button>
                            </div>
                        </th>
                        <th
                            class="px-3 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                <button type="button">Delivery Date</button>
                            </div>
                        </th>
                        <th
                            class="px-3 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                <button type="button">Status</button>
                            </div>
                        </th>
                        <th
                            class="px-3 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                <button type="button">Order Detail</button>
                            </div>
                        </th>
                    </tr>
                </x-AdminPanel.table.thead>
                <tbody>
                    @forelse ($orders as $order)
                        {{--
                            Admin can see all orders
                            Ticket manager can see only orders that are assigned to him
                        --}}
                        @cannot('view', App\Models\Ticket\Ticket::class)
                            @cannot('view', $order)
                                @continue;
                            @endcannot
                        @endcannot

                        <tr>
                            <x-AdminPanel.table.cell>
                                <div class="flex flex-row items-center px-2 py-1">
                                    @if($order->orderType == 'normal')
                                    <div>
                                        <img src="{{ asset('/gigs/images/' . $order->gig_image) }}"
                                            class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-14 w-14 rounded-xl"
                                            alt="user1" />
                                    </div>
                                    <h6 class="mb-0 leading-normal text-sm">{{ $order->gig_title }}</h6>
                                    @else
                                    <p class="mb-0 leading-normal text-sm"> {{  \Illuminate\Support\Str::limit($order->offerTitle,  40, $end='...' ) }}</p>
                                    @endif
                                </div>
                            </x-AdminPanel.table.cell>
                            <x-AdminPanel.table.cell>
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 leading-normal text-sm">{{ $order->seller_name }}
                                        </h6>
                                    </div>
                                </div>
                            </x-AdminPanel.table.cell>
                            <x-AdminPanel.table.cell>
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 leading-normal text-sm">{{ $order->buyer_name }}
                                        </h6>
                                    </div>
                                </div>
                            </x-AdminPanel.table.cell>
                            <x-AdminPanel.table.cell>
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 leading-normal text-sm">${{ $order->amount }}
                                        </h6>
                                    </div>
                                </div>
                            </x-AdminPanel.table.cell>
                            <x-AdminPanel.table.cell>
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 leading-normal text-sm">{{ $order->delivery_time }}
                                        </h6>
                                    </div>
                                </div>
                            </x-AdminPanel.table.cell>
                            <x-AdminPanel.table.cell>
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="bg-{{ $order->statusColor() }}-500 rounded-full px-4 text-white mb-0 leading-normal text-sm">{{ $order->status }}</h6>
                                    </div>
                                </div>
                            </x-AdminPanel.table.cell>

                            <x-AdminPanel.table.cell>
                                <div class="flex">
                                    <div class="flex flex-col justify-center">
                                        <a href="{{ route('admin.order_details', ['order' => $order->id]) }}"
                                            class="bg-green-500 text-white py-1 px-4 rounded-full">View
                                            details
                                        </a>
                                        </h6>
                                    </div>
                                </div>
                            </x-AdminPanel.table.cell>
                        </tr>

                    @empty
                        <tr>
                            <td class="py-4 px-6 text-center" colspan="7">
                                No Record Found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </x-AdminPanel.table>
        </div>
        <div class="px-3 py-2">
            {{ $orders->links('vendor.livewire.custom-pagination') }}
        </div>
    </div>

</div>
