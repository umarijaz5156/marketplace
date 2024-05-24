<div class="mx-8">
    <div class="my-2">
        @if (session('success'))
            <x-alerts.success :success="session('success')" />
        @endif
    </div>
    <div
        class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
            <h6>Users table</h6>
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
                <select wire:model = "sortField" wire:change="filterBy($event.target.value)"
                    class="pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                    <option value="">Sort By</option>
                    <option value="total_orders">Most Orders</option>
                    <option value="total_reviews">Top Rating</option>
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
                                    <button wire:click="sortBy('name')" type="button">User Name</button>
                                    <x-sort-icon
                                        field="name"
                                        :sortField="$sortField"
                                        :sortAsc="$sortAsc"
                                    />
                                </div>
                            </th>
                            <th
                                class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('email')" type="button">User Email</button>
                                    <x-sort-icon
                                        field="email"
                                        :sortField="$sortField"
                                        :sortAsc="$sortAsc"
                                    />
                                </div>
                            </th>
                            <th
                                class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('total_orders')" type="button">Total Orders</button>
                                    <x-sort-icon
                                        field="total_orders"
                                        :sortField="$sortField"
                                        :sortAsc="$sortAsc"
                                    />
                                </div>
                            </th>
                            <th
                                class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('total_reviews')" type="button">Total Reviews</button>
                                    <x-sort-icon
                                        field="total_reviews"
                                        :sortField="$sortField"
                                        :sortAsc="$sortAsc"
                                    />
                                </div>
                            </th>
                            <th
                                class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Verified
                            </th>
                            <th
                                class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('created_at')" type="button">Date</button>
                                    <x-sort-icon
                                        field="created_at"
                                        :sortField="$sortField"
                                        :sortAsc="$sortAsc"
                                    />
                                </div>
                            </th>
                            <th colspan="3" class="px-6 py-3 pl-2 font-bold uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70 text-center">
                                Action
                            </th>
                        </tr>
                    </x-AdminPanel.table.thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $user->name }}</h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <p class="mb-0 font-semibold leading-tight text-xs">{{ $user->email }}</p>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <p class="mb-0 font-semibold leading-tight text-xs">{{ $user->total_orders }}</p>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <p class="mb-0 font-semibold leading-tight text-xs">{{ $user->total_reviews }}</p>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                    <p class="{{isset($user->email_verified_at) ? 'bg-green-500' : 'bg-red-500'}} text-white rounded-full px-2 py-1 mb-0 font-semibold leading-tight text-xs">
                                        {{isset($user->email_verified_at) ? 'Yes' : 'No'}}
                                    </p>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <p class="mb-0 font-semibold leading-tight text-xs">{{ $user->created_at }}</p>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell class="text-center">
                                    {{-- Make or Unmake Admin Button --}}
                                    <button wire:click="makeAdminModalFun({{ $user->id }},{{ $user->is_admin }})"
                                        class="text-{{ $user->is_admin ? 'lime' : 'red' }}-500 text-sm hover:text-{{ $user->is_admin ? 'lime' : 'red' }}-600 hover:underline font-semibold"
                                    >
                                        {{ $user->is_admin ? 'Admin' : 'Make Admin' }}
                                    </button>

                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell class="text-center">
                                    {{-- Make or Unmake Ticket Manager Button --}}
                                    <button wire:click="makeTicketManagerModalFun({{ $user->id }},{{ $user->is_ticket_manager }})"
                                        class="text-{{ $user->is_ticket_manager ? 'lime' : 'red' }}-500 hover:{{ $user->is_ticket_manager ? 'lime' : 'red' }}-600 text-sm hover:underline font-semibold"
                                    >
                                        {{ $user->is_ticket_manager ? 'Ticket Manager' : 'Make Ticket Manager' }}
                                    </button>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell :wire:key="$user->id">
                                    {{-- <button wire:click="deleteUser({{ $user->id }})"
                                        class="bg-red-500 text-white text-xs py-2 px-4 rounded-full"
                                    >
                                        Delete
                                    </button> --}}

                                    @if($user->is_banned)
                                    <button wire:click="unbanUserModal({{ $user->id }})"
                                        class="bg-orange-500 text-white text-xs py-2 px-4 rounded-full"
                                    >
                                        Unban
                                    </button>
                                    @else
                                    <button wire:click="banUserModal({{ $user->id }})"
                                        class="bg-orange-500 text-white text-xs py-2 px-4 rounded-full"
                                    >
                                        Ban
                                    </button>
                                    @endif
                                </x-AdminPanel.table.cell>
                            </tr>
                        @empty
                            <tr>
                                <td class="py-4 px-6 text-center" colspan="6">
                                    No Record Found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </x-AdminPanel.table>
            </div>
        </div>
        <div class="px-3 py-2">
            {{ $users->links() }}
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <x-Modals.delete-confirm-modal message="You are going to delete user" />

    {{-- ban user modal --}}
    <x-jet-dialog-modal wire:model="banModal">
        <x-slot name="title">
            Ban User

            <button
                wire:click="toggleModal"
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
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 drk:text-gray-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 drk:text-gray-400">Are you sure you want to Ban this user?</h3>
                <button wire:click.prevent="banUser()" type="button"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Yes, I'm sure
                </button>
                <button wire:click="toggleModal" wire:loading.attr="disabled" type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 drk:bg-gray-700 drk:text-gray-300 drk:border-gray-500 drk:hover:text-white drk:hover:bg-gray-600 drk:focus:ring-gray-600">No,
                    cancel</button>
            </div>
        </x-slot>

        <x-slot name="footer">
        </x-slot>
    </x-jet-dialog-modal>

     {{-- un ban user modal --}}
     <x-jet-dialog-modal wire:model="unbanModal">
        <x-slot name="title">
            Unban User

            <button
                wire:click="toggleModal2"
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
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 drk:text-gray-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 drk:text-gray-400">Are you sure you want to Unban this user?</h3>
                <button wire:click.prevent="unbanUser()" type="button"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Yes, I'm sure
                </button>
                <button wire:click="toggleModal2" wire:loading.attr="disabled" type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 drk:bg-gray-700 drk:text-gray-300 drk:border-gray-500 drk:hover:text-white drk:hover:bg-gray-600 drk:focus:ring-gray-600">No,
                    cancel</button>
            </div>
        </x-slot>

        <x-slot name="footer">
        </x-slot>
    </x-jet-dialog-modal>

    {{-- make unmake admin modal --}}
    <x-jet-dialog-modal wire:model="makeAdminModal">
        <x-slot name="title">
            Are you sure?

            <button
                wire:click="closeModal('makeAdminModal')"
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
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 drk:text-gray-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 drk:text-gray-400">
                    You are going to {{ $makeAdminStatus ? 'unmake' : 'make' }} this user as an admin?
                </h3>
                <button wire:click.prevent="makeAdmin()" type="button"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Yes, I'm sure
                </button>
                <button wire:click="closeModal('makeAdminModal')" wire:loading.attr="disabled" type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 drk:bg-gray-700 drk:text-gray-300 drk:border-gray-500 drk:hover:text-white drk:hover:bg-gray-600 drk:focus:ring-gray-600">No,
                    cancel</button>
            </div>
        </x-slot>

        <x-slot name="footer">
        </x-slot>
    </x-jet-dialog-modal>

    {{-- make unmake admin modal --}}
    <x-jet-dialog-modal wire:model="makeTicketManagerModal">
        <x-slot name="title">
            Are you sure?

            <button
                wire:click="closeModal('makeTicketManagerModal')"
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
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 drk:text-gray-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                    You are going to {{ $makeTicketManagerStatus ? 'unmake' : 'make' }} this user as an ticket manager?
                </h3>
                <button wire:click.prevent="makeTicketManager()" type="button"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Yes, I'm sure
                </button>
                <button wire:click="closeModal('makeTicketManagerModal')" wire:loading.attr="disabled" type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 drk:bg-gray-700 drk:text-gray-300 drk:border-gray-500 drk:hover:text-white drk:hover:bg-gray-600 drk:focus:ring-gray-600">No,
                    cancel</button>
            </div>
        </x-slot>

        <x-slot name="footer">
        </x-slot>
    </x-jet-dialog-modal>
</div>
