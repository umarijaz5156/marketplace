<x-AdminPanel.card-wrapper>

    <div class="flex flex-wrap -mx-3">
        <!-- card1 -->
        <x-AdminPanel.card title="Total Affiliates" :value="count($affiliates)" class="ni-world">
        </x-AdminPanel.card>

        <!-- card2 -->
        <x-AdminPanel.card title="Total Commission" :value="'$'.$affiliates->sum('total_commission')"
            class="ni-money-coins"></x-AdminPanel.card>

        {{--
        <!-- card3 -->
        <x-AdminPanel.card title="Estimated Revenue" :value="'$'" class="ni-paper-diploma"></x-AdminPanel.card>

        <!-- card4 -->
        <x-AdminPanel.card title="Refunded Transactions" :value="'$'" class="ni-cart"></x-AdminPanel.card> --}}
    </div>
    <div class="my-2">
        @if (session('success'))
        <x-alerts.success :success="session('success')" />
        @endif
    </div>
    <div class="flex flex-wrap mt-6 -mx-0">
        <div
            class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex justify-between">
                <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                    <h6>Affiliates table</h6>
                </div>
                <div class="mt-2 mr-2">
                    <x-AdminPanel.button wire:click="$toggle('openPaymentModal')"  class="h-10"
                 > Pay All </x-AdminPanel.button>
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
                                        <button wire:click="sortBy('id')" type="button">#</button>

                                        {{-- <x-sort-icon field="id" :sortField="$sortField" :sortAsc="$sortAsc" /> --}}
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    <div class="flex items-center">
                                        <button wire:click="sortBy('email')" type="button">Name</button>
                                        {{--
                                        <x-sort-icon field="email" :sortField="$sortField" :sortAsc="$sortAsc" /> --}}
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    <div class="flex items-center">
                                        <button wire:click="sortBy('email')" type="button">Email</button>
                                        {{--
                                        <x-sort-icon field="total_orders" :sortField="$sortField" :sortAsc="$sortAsc" />
                                        --}}
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    <div class="flex items-center">
                                        <button wire:click="sortBy('created_at')" type="button">Joined Date</button>
                                        {{--
                                        <x-sort-icon field="total_reviews" :sortField="$sortField"
                                            :sortAsc="$sortAsc" /> --}}
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    <div class="flex items-center">
                                        <button wire:click="sortBy('total_users')" type="button">Users</button>
                                        {{--
                                        <x-sort-icon field="total_reviews" :sortField="$sortField"
                                            :sortAsc="$sortAsc" /> --}}
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    <div class="flex items-center">
                                        <button wire:click="sortBy('total_commission')" type="button">Total
                                            Commission</button>
                                        {{--
                                        <x-sort-icon field="total_reviews" :sortField="$sortField"
                                            :sortAsc="$sortAsc" /> --}}
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    <div class="flex items-center">
                                        Status

                                    </div>
                                </th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    <div class="flex items-center">
                                        Payment
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    <div class="flex items-center">
                                        Action

                                    </div>
                                </th>
                            </tr>
                        </x-AdminPanel.table.thead>
                        <tbody>
                            @forelse ($affiliates as $affiliate)
                            <tr>

                                <x-AdminPanel.table.cell>
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $affiliate->id }}</h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>

                                <x-AdminPanel.table.cell>
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 leading-normal text-sm">{{ $affiliate->name }}</h6>
                                    </div>
                                </x-AdminPanel.table.cell>

                                <x-AdminPanel.table.cell>
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 leading-normal text-sm">
                                            {{ $affiliate->email }}</h6>
                                    </div>
                                </x-AdminPanel.table.cell>

                                <x-AdminPanel.table.cell>
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 leading-normal text-sm">{{ $affiliate->created_at->format('D M
                                            Y') }}</h6>
                                    </div>
                                </x-AdminPanel.table.cell>

                                <x-AdminPanel.table.cell>
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            {{ $affiliate->total_users ?? 0 }}
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>

                                <x-AdminPanel.table.cell>
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            ${{ $affiliate->total_commission ?? 0.00}}
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <p
                                                class="{{$affiliate->is_affiliate ? 'bg-green-500' : 'bg-red-500'}} text-white rounded-full px-2 py-1 mb-0 font-semibold leading-tight text-xs">
                                                {{$affiliate->is_affiliate ? 'Active' : 'InActive'}}
                                            </p>
                                        </div>
                                    </div>

                                </x-AdminPanel.table.cell>

                                <x-AdminPanel.table.cell>
                                    <div class="flex px-2 py-1">
                                        <div class=" flex flex-col justify-center">
                                            <button
                                                {{ $affiliate->pending_commission == null ? 'disabled' : '' }}
                                                {{-- wire:click='openPaymentModal({{ $affiliate->id }})' --}}

                                                class=" {{ $this->checkStatus($affiliate->id) > 0 ? 'bg-red-500' :
                                                'bg-green-500'}} text-white rounded-full px-2 py-1 mb-0 font-semibold
                                                leading-tight text-xs">
                                                {{$this->checkStatus($affiliate->id) > 0 ? 'Pending' : 'Paid'}}
                                            </button>
                                        </div>
                                    </div>

                                </x-AdminPanel.table.cell>

                                <x-AdminPanel.table.cell>
                                    <div class="flex  justify-start gap-2">

                                        @if($affiliate->is_affiliate)
                                        <div wire:click='openBanModal({{ $affiliate->id }})' title="ban"
                                            class="cursor-pointer mb-0 leading-normal">
                                            <i class=" text-red-400 hover:text-red-600 text-md fa-solid fa-ban"></i>
                                        </div>
                                        @else
                                        <div wire:click='openUnBanModal({{ $affiliate->id }})' title="unBan"
                                            class="cursor-pointer mb-0 leading-normal">
                                            <i
                                                class=" text-orange-400 hover:text-orange-600 text-md fa-regular fa-circle-check"></i>
                                        </div>
                                        @endif
                                        <div wire:click='openUsersModal({{ $affiliate->id }})'
                                            class="cursor-pointer mb-0 leading-normal">
                                            <i class="text-green-400 hover:text-green-600 text-md fa-solid fa-eye"></i>
                                        </div>
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
                    {{ $affiliates->links("vendor.livewire.custom-pagination") }}
                </div>
            </div>
        </div>
    </div>

    <x-jet-dialog-modal wire:model="banUserModal">
        <x-slot name="title">
            Ban User

            <button wire:click="closeBanModal" type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center drk:hover:bg-gray-800 drk:hover:text-white">
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
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 drk:text-gray-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 drk:text-gray-400">Are you sure you want to Ban this
                    affiliate?</h3>
                <button wire:click.prevent="banUser()" type="button"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Yes, I'm sure
                </button>
                <button wire:click="closeBanModal" wire:loading.attr="disabled" type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 drk:bg-gray-700 drk:text-gray-300 drk:border-gray-500 drk:hover:text-white drk:hover:bg-gray-600 drk:focus:ring-gray-600">No,
                    cancel</button>
            </div>
        </x-slot>

        <x-slot name="footer">
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal wire:model="unbanUserModal">
        <x-slot name="title">
            UnBan Affiliate

            <button wire:click="closeUnBanModal" type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center drk:hover:bg-gray-800 drk:hover:text-white">
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
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 drk:text-gray-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 drk:text-gray-400">Are you sure you want to unBan
                    this affiliate?</h3>
                <button wire:click.prevent="unBanUser" type="button"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Yes, I'm sure
                </button>
                <button wire:click="closeUnBanModal" wire:loading.attr="disabled" type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 drk:bg-gray-700 drk:text-gray-300 drk:border-gray-500 drk:hover:text-white drk:hover:bg-gray-600 drk:focus:ring-gray-600">No,
                    cancel</button>
            </div>
        </x-slot>

        <x-slot name="footer">
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal maxWidth='6xl' wire:model="openUsersModal">
        <x-slot name="title">
            Joined Users

            <button wire:click="closeUsersModal" type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center drk:hover:bg-gray-800 drk:hover:text-white">
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
            @if($openUsersModal)
            <x-AdminPanel.table>
                <x-AdminPanel.table.thead>
                    <tr>
                        <th
                            class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                #

                            </div>
                        </th>
                        <th
                            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                Name

                            </div>
                        </th>
                        <th
                            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                Email

                            </div>
                        </th>
                        <th
                            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                Joined Date

                            </div>
                        </th>

                        <th
                            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                Commission

                            </div>
                        </th>
                        <th
                            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                Status

                            </div>
                        </th>
                        <th
                            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                Action

                            </div>
                        </th>
                    </tr>
                </x-AdminPanel.table.thead>
                <tbody>

                    @forelse ($users as $user)

                    <tr>
                        <x-AdminPanel.table.cell>
                            <div class="flex px-2 py-1">
                                <div class="flex flex-col justify-center">
                                    <h6 class="mb-0 leading-normal text-sm">{{ $user->id }}</h6>
                                </div>
                            </div>
                        </x-AdminPanel.table.cell>

                        <x-AdminPanel.table.cell>
                            <div class="flex flex-col justify-center">
                                <h6 class="mb-0 leading-normal text-sm">{{ $user->user->name }}</h6>
                            </div>
                        </x-AdminPanel.table.cell>

                        <x-AdminPanel.table.cell>
                            <div class="flex flex-col justify-center">
                                <h6 class="mb-0 leading-normal text-sm">
                                    {{ $user->user->email }}</h6>
                            </div>
                        </x-AdminPanel.table.cell>

                        <x-AdminPanel.table.cell>
                            <div class="flex flex-col justify-center">
                                <h6 class="mb-0 leading-normal text-sm">{{ $user->created_at->format('D M
                                    Y') }}</h6>
                            </div>
                        </x-AdminPanel.table.cell>

                        <x-AdminPanel.table.cell>
                            <div class="flex px-2 py-1">
                                <div class="flex flex-col justify-center">
                                    ${{ $user->commission ?? 0 }}
                                </div>
                            </div>
                        </x-AdminPanel.table.cell>

                        <x-AdminPanel.table.cell>
                            <div class="flex px-2 py-1">
                                <div class="flex flex-col justify-center">
                                    <p
                                        class="{{$this->checkStatus($user->id, 'commission') > 0 ? 'bg-red-500' : 'bg-green-500'}} text-white rounded-full px-2 py-1 mb-0 font-semibold leading-tight text-xs">
                                        {{$this->checkStatus($user->id, 'commission') > 0 ? 'UnPaid' : 'Paid'}}

                                    </p>
                                </div>
                            </div>
                        </x-AdminPanel.table.cell>
                        <x-AdminPanel.table.cell>

                        <div wire:click='showHistory({{ $user->id }})'
                            class="cursor-pointer mb-0 leading-normal">
                            <i class="text-green-400 hover:text-green-600 text-md fa-solid fa-eye"></i>
                        </div>
                        </x-AdminPanel.table.cell>


                    </tr>
                    @empty
                    <td class="py-4 px-6 text-center" colspan="7">
                        No Record Found
                    </td>
                    @endforelse


                </tbody>
            </x-AdminPanel.table>
            <div class="px-3 py-2">
                {{ $users->links("vendor.livewire.custom-pagination") }}
            </div>
            @endif
        </x-slot>

        <x-slot name="footer">
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal zIndex='z-[999]' wire:model="openPaymentModal">
        <x-slot name="title">
            Change Status

            <button wire:click="closePaymentModal" type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center drk:hover:bg-gray-800 drk:hover:text-white">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </x-slot>

        <x-slot  name="content">
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 drk:text-gray-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 drk:text-gray-400">Are you sure you want to change
                    status to paid?</h3>
                <button wire:click.prevent="payUser" type="button"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Yes, I'm sure
                </button>
                <button wire:click="closePaymentModal" wire:loading.attr="disabled" type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 drk:bg-gray-700 drk:text-gray-300 drk:border-gray-500 drk:hover:text-white drk:hover:bg-gray-600 drk:focus:ring-gray-600">No,
                    cancel</button>
            </div>
        </x-slot>

        <x-slot name="footer">
        </x-slot>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal maxWidth='6xl' wire:model="showCommissionModal">
        <x-slot name="title">
            Affiliate Commission

            <button wire:click="closeHistoryModal" type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center drk:hover:bg-gray-800 drk:hover:text-white">
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
            @if($showCommissionModal)


            <div class="max-h-[600px] overflow-y-auto">
            <x-AdminPanel.table class="">
                <x-AdminPanel.table.thead>
                    <tr>
                        <th
                            class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                order #

                            </div>
                        </th>
                        <th
                            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                Commission Earned

                            </div>
                        </th>

                        <th
                            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                Date

                            </div>
                        </th>

                        <th
                            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                Status

                            </div>
                        </th>
                    </tr>
                </x-AdminPanel.table.thead>
                <tbody>

                    @forelse ($affiliateCommissions as $commission)

                    <tr>
                        <x-AdminPanel.table.cell>
                            <div class="flex px-2 py-1">
                                <div class="flex flex-col justify-center">
                                    <h6 class="mb-0 leading-normal text-sm">{{ $commission->order_id }}</h6>
                                </div>
                            </div>
                        </x-AdminPanel.table.cell>

                        <x-AdminPanel.table.cell>
                            <div class="flex flex-col justify-center">
                                <h6 class="mb-0 leading-normal text-sm">${{ $commission->commission ?? 0}}</h6>
                            </div>
                        </x-AdminPanel.table.cell>


                        <x-AdminPanel.table.cell>
                            <div class="flex flex-col justify-center">
                                <h6 class="mb-0 leading-normal text-sm">{{ $commission->created_at->format('D M
                                    Y') }}</h6>
                            </div>
                        </x-AdminPanel.table.cell>


                        <x-AdminPanel.table.cell>
                            <div class="flex px-2 py-1">

                                <div class="cursor-pointer  flex flex-col justify-center">
                                    <button {{$commission->status == 'Paid' ? 'disabled' : ''}}
                                     wire:click='openPaymentModal({{ $commission->id }})'
                                        class="{{$commission->status == 'Paid' ? 'bg-green-500' : 'bg-red-500'}} text-white rounded-full px-2 py-1 mb-0 font-semibold leading-tight text-xs">
                                        {{$commission->status == 'Paid' ? 'Paid' : 'UnPaid'}}
                                    </button>
                                </div>
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

            @endif
        </x-slot>

        <x-slot name="footer">
        </x-slot>
    </x-jet-dialog-modal>
</x-AdminPanel.card-wrapper>
