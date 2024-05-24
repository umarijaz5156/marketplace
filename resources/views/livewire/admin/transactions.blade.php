<div class="mx-8">

      <x-AdminPanel.card-wrapper>
        <!-- row 1 -->
        <div class="flex flex-wrap -mx-3">
            <!-- card1 -->
            <x-AdminPanel.card title="Available Balance" :value="'$' .number_format($availableBalance, 2)" class="ni-paper-diploma" />

            <!-- card2 -->
            <x-AdminPanel.card title="Pending" :value="'$' .number_format($pendingBalance, 2)" class="ni-money-coins" />

        </div>
    </x-AdminPanel.card-wrapper>
    <div
        class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
            <h6>All Transactions</h6>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2">
            <div class="p-0 overflow-x-auto">
                <x-AdminPanel.table>
                    <x-AdminPanel.table.thead>
                        <tr>
                            <th
                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    Order #
                                </div>
                            </th>
                            <th
                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    Seller #
                                </div>
                            </th>
                            <th
                                class="px-3 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Withdraw Type
                            </th>
                            <th
                                class="px-3 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Email
                            </th>
                            <th
                                class="px-3 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    Amount
                                </div>
                            </th>

                            <th
                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Payout Status
                            </th>
                        </tr>
                    </x-AdminPanel.table.thead>
                    <tbody>
                        @forelse ($payouts as $payout)
                            <tr wire:key="{{ $payout->id }}">
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <a class="hover:text-blue-800" href="{{route('admin.order_details', ['order' => $payout->order_id])}}"><h6 class="mb-0 leading-normal text-sm">{{ $payout->order_id }}</h6>
                                            </a>
                                            </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $payout->seller_id }}</h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $payout->withdraw_type }}</h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $payout->email }}</h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">
                                                {{ $payout->amount }}</h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>

                                <x-AdminPanel.table.cell >
                                    {{-- {{ App\Enums\PayoutStatus::from($payout->payout_status)}} --}}

                                    <button
                                        wire:click="changeStatus({{ $payout->payout_id }}, {{$payout->payout_status}})"
                                       >
                                       <span class="
                                       {{$payout->payout_status== App\Enums\PayoutStatus::Pending->value ? 'bg-purple-200 text-purple-600' :
                                           ($payout->payout_status== App\Enums\PayoutStatus::Paid->value ? 'bg-green-200 text-green-600' :
                                           ($payout->payout_status== App\Enums\PayoutStatus::Refunded->value ? 'bg-red-200 text-red-600' :
                                       ''
                                           ) )

                                       }}
                        px-6 py-1 rounded font-semibold text-sm">{{$payout->payout_status == 1 ? 'Pending' : (
                           $payout->payout_status == 2 ? 'Paid' : (
                               $payout->payout_status == 3 ? 'Refunded' : ''
                           )
                        )}}</span></small></h3>
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
            {{ $payouts->links('vendor.livewire.custom-pagination') }}
        </div>
    </div>

    {{-- change statu modal --}}
    <x-jet-dialog-modal maxWidth="custom" wire:model="openModal">
        <x-slot name="title">
           Change Payout Status

            <button
                wire:click="$toggle('openModal')"
                type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center drk:hover:bg-gray-800 drk:hover:text-white"
            >
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </x-slot>

        <x-slot name="content">
           @if (session()->has('message'))
           <div x-data="{ show:true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="animate-bounce text-center text-green-500">
               {{ session('message') }}
           </div>
            @endif
            <x-AdminPanel.form.select wire:model="selectedStatus">
                @foreach (\App\Enums\PayoutStatus::cases() as $value)

                <option value="{{$value->value}}">{{$value->name}}</option>
                @endforeach

            </x-AdminPanel.form.select>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('openModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-3" wire:click="saveStatus"  wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>


</div>
