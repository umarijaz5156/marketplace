<div class="mx-8">
    <div class="my-2">
        @if (session('success'))
            <x-alerts.success :success="session('success')" />
        @endif

        {{-- <livewire:message-notification /> --}}
        {{-- stripe error --}}
        <x-stripe.notification/>
        {{-- stripe success --}}
    </div>
    <div
        class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
            <h6>Ticket Management Table</h6>
        </div>

        <div class="flex items-center md:ml-auto md:pr-4">
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft px-1">
                <span
                    class="text-sm ease-soft leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                    <i class="fas fa-search"></i>
                </span>
                <input wire:model="search" type="search"
                    class="pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                    placeholder="Type here..." />
            </div>
            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft px-1">
                <select wire:model="statusFilter"
                    class="pl-2 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                    <option value="">All</option>
                    @foreach (App\Enums\TicketStatus::cases() as $ticketType)
                        <option value="{{ $ticketType->value }}">{{ $ticketType->value }}</option>
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
                                    <button type="button">Ticket Id</button>
                                </div>
                            </th>
                            <th
                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button type="button">Ticket Manager</button>
                                </div>
                            </th>
                            <th
                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button type="button">Buyer</button>
                                </div>
                            </th>
                            <th
                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button type="button">Seller</button>
                                </div>
                            </th>
                            <th
                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button type="button">Order Id</button>
                                </div>
                            </th>
                            <th
                                class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button type="button">Date</button>
                                </div>
                            </th>
                            <th
                                class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button type="button">Order Chat</button>
                                </div>
                            </th>
                            <th
                                class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button type="button">Ticket Chat</button>
                                </div>
                            </th>
                            <th
                                class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button type="button">Status</button>
                                </div>
                            </th>
                        </tr>
                    </x-AdminPanel.table.thead>
                    <tbody>
                        @forelse ($tickets as $ticket)
                            <tr wire:key="{{ $ticket->id }}">
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-6 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $ticket->id }}</h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-6 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $ticket->manager }}</h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-4 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $ticket->buyer }}</h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-4 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $ticket->seller }}</h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-4 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $ticket->order_id }}</h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <div class="flex px-0 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $ticket->created_at }}</h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>
                                 <x-AdminPanel.table.cell>
                                    <a href="{{ route('manager.messages', ['id' => $this->getChatId($ticket->order_id) ])}}">
                                        <img src="{{ asset('images/svg/chat.png') }}" alt="chat image">
                                    </a>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    <a href="{{ route('admin.ticket_chat', ['ticketId' => $ticket->id]) }}">
                                        <img src="{{ asset('images/svg/chat.png') }}" alt="chat image">
                                    </a>
                                </x-AdminPanel.table.cell>
                                <x-AdminPanel.table.cell>
                                    @if ($ticket->ticket_winner != '')
                                        <button wire:click="changeStatusId({{ $ticket->id }})"
                                            {{$ticket->ticket_winner != 'Pending' ? 'disabled' : ''}}
                                            class="{{ $ticket->ticket_winner == 'Pending' ? 'bg-red-500' : 'bg-green-500' }} text-white text-xs py-2 px-4 rounded-full">
                                            {{ $ticket->ticket_winner }}
                                        </button>
                                    @endif
                                </x-AdminPanel.table.cell>
                            </tr>
                        @empty
                            <tr>
                                <td class="py-4 px-4 text-center" colspan="9">
                                    No Record Found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </x-AdminPanel.table>
            </div>
            <div class="px-3 py-2">
                {{ $tickets->links("vendor.livewire.custom-pagination") }}
            </div>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    {{-- <x-Modals.delete-confirm-modal /> --}}

    {{-- Ticket Status Modal --}}
    <x-Modals.modal modalId="changeStatusModal" title="Are you sure?">

        @slot('content')
            <div class="p-6 text-center">
                <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 drk:text-gray-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 drk:text-gray-400">You are going to change ticket status</h3>
                <div class="my-6">
                    <label class="mb-1">Select Ticket Status</label>
                    <x-AdminPanel.form.select wire:model="status" >
                        <option value="" disabled>Select</option>
                        @foreach (App\Enums\TicketStatus::cases() as $ticketStatus)
                            <option @if ($ticketStatus->value == $status)
                                disabled
                            @endif value="{{ $ticketStatus->value }}">{{ $ticketStatus->value }}</option>
                        @endforeach
                    </x-AdminPanel.form.select>
                    @error('status')
                        <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <button wire:click.prevent="changeStatus()" type="button"
                    class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 drk:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Yes, I'm sure
                </button>
                <button wire:click="closeModal('changeStatusModal')" type="button"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 drk:bg-gray-700 drk:text-gray-300 drk:border-gray-500 drk:hover:text-white drk:hover:bg-gray-600 drk:focus:ring-gray-600">No,
                    cancel</button>
            </div>
        @endslot
    </x-Modals.modal>
@push('scripts')
@once
<script>
    document.addEventListener('order_completed',event => {

        fetch("/stripe/order/transfer/"+event.detail.id, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

            }) .then((response) => {
                if (!response.ok) {

                        $('#error').removeClass('hidden');
                        $('#error_message').text("Error occured while cancelling! Please try again");
                        setTimeout(function() {
                            $("#error").addClass('hidden');
                            $('#error_message').text("");
                            Livewire.emit('revertStatus');
                        }, 4000);

                    }
                    return response.text();

            }).then((data) => {

                        if(JSON.parse(data).transfered == true){
                            $('#success').removeClass('hidden');
                            $('#success_message').text("Completed Successfully");
                            setTimeout(function() {
                            $("#success").addClass('hidden');
                            $('#success_messsage').text("");
                        }, 4000);
                            } else{

                                $('#error').removeClass('hidden');
                                $('#error_message').text("Error occured while completing order! Please try again");
                                setTimeout(function() {
                                $("#error").addClass('hidden');
                                $('#error_message').text("");
                                  Livewire.emit('revertStatus');
                            }, 4000);

                            }


                        })

            .catch((error) =>{
                $('#error').removeClass('hidden');
                    $('#error_message').text(error);
                     setTimeout(function() {
                        $("#error").addClass('hidden');
                        $('#error_message').text("");
                         Livewire.emit('revertStatus');
                    }, 4000);

            });
    });

     document.addEventListener('order_refunded',event => {

        fetch("/stripe/order/refund/"+event.detail.id, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

            })
            .then((response) => {
                if (!response.ok) {
                        $('#error').removeClass('hidden');
                        $('#error_message').text("Error occured while cancelling! Please try again");
                        setTimeout(function() {
                            $("#error").addClass('hidden');
                            $('#error_message').text("");
                                 Livewire.emit('revertStatus');
                        }, 4000);
                    }

                    return response.text();

            })
            .then((data) => {
            if(JSON.parse(data).refunded== true){
                        $('#success').removeClass('hidden');
                        $('#success_message').text("Cancelled Successfully");
                        setTimeout(function() {
                            $("#success").addClass('hidden');
                            $('#success_messsage').text("");
                        }, 4000);

                    } else {

                        $('#error').removeClass('hidden');
                        $('#error_message').text("Error occured while cancelling! Please try again");
                        setTimeout(function() {
                            $("#error").addClass('hidden');
                            $('#error_message').text("");
                            Livewire.emit('revertStatus');
                        }, 4000);

                    }
                    })

            .catch((error) =>{

                $('#error').removeClass('hidden');
                    $('#error_message').text(error);
                     setTimeout(function() {
                        $("#error").addClass('hidden');
                        $('#error_message').text("");
                        Livewire.emit('revertStatus');
                    }, 4000);
            });
        });
</script>
@endonce

@endpush

</div>
