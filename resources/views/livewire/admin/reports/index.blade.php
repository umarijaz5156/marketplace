<div class="mx-8">
    <div>
        @if (session('success'))
            <x-alerts.success :success="session('success')" />
        @endif

        @if (session('error'))
            <x-alerts.error :error="session('error')" />
        @endif
    </div>

    <div
        class=" relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">

        <div class="flex justify-between">
            <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                <h6>Reports table</h6>
            </div>
            <select wire:model="selectedFilter" id="statuses"
                class=" w-[158px] bg-white border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-blue-500 focus:border-blue-500 block p-[12px]  drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500"
                style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                <option value="0" selected>All</option>
                @foreach ($filters as $filter)
                    <option value="{{ $filter->value }}">{{ $filter->value }}</option>
                @endforeach
            </select>
        </div>
        <div class="p-0 overflow-x-auto">
            <x-AdminPanel.table>
                <x-AdminPanel.table.thead>
                    <tr>
                        <th
                            class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-sm border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                <button type="button">Content</button>
                            </div>
                        </th>
                        <th
                            class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-sm  border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                <button type="button">Reported By</button>
                            </div>
                        </th>
                        <th
                            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-sm  border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                <button type="button">Reported User</button>
                            </div>
                        </th>
                        <th
                            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-sm  border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                <button type="button">Reported On</button>
                            </div>
                        </th>
                        <th
                            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-sm  border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                <button type="button">Description</button>
                            </div>
                        </th>
                    </tr>
                </x-AdminPanel.table.thead>
                <tbody>
                    @forelse ($reports as $report)
                        <tr>
                            <x-AdminPanel.table.cell>
                                <div class="flex flex-row items-center px-2 py-1">
                                    @if ($report->content_type == App\Enums\ReportType::Chat->value)
                                        <a class=""
                                            href="{{ route('manager.messages', ['id' => $report->content_id]) }}">
                                            <h6 class="hover:text-blue-400 mb-0 leading-normal text-sm">
                                                {{ $report->content_type }} #{{ $report->content_id }}</h6>
                                        </a>
                                    @elseif($report->content_type == App\Enums\ReportType::Seller->value)
                                        <a
                                            href="{{ route('view_profile', ['name' => $this->getSellerName($report->content_id)]) }}">
                                            <h6 class="hover:text-blue-400 mb-0 leading-normal text-sm">
                                                {{ $report->content_type }} #{{ $report->content_id }}</h6>
                                        </a>
                                    @elseif($report->content_type == App\Enums\ReportType::Gig->value)
                                        <a
                                            href="{{ route('gig_details', ['slug' => $this->getGigTitle($report->content_id)]) }}">
                                            <h6 class="hover:text-blue-400 mb-0 leading-normal text-sm">
                                                {{ $report->content_type }} #{{ $report->content_id }}</h6>
                                        </a>
                                    @else
                                        <h6 class="mb-0 leading-normal text-sm">{{ $report->content_type }}
                                            #{{ $report->content_id }}</h6>
                                    @endif
                                </div>
                            </x-AdminPanel.table.cell>
                            <x-AdminPanel.table.cell>
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 leading-normal text-sm">User #{{ $report->reporter_id }}
                                        </h6>
                                    </div>
                                </div>
                            </x-AdminPanel.table.cell>
                            <x-AdminPanel.table.cell>
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 leading-normal text-sm">User #{{ $report->content_owner }}
                                        </h6>
                                    </div>
                                </div>
                            </x-AdminPanel.table.cell>
                            <x-AdminPanel.table.cell>
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 leading-normal text-sm">
                                            {{ $report->created_at->format('M, d Y') }}
                                        </h6>
                                    </div>
                                </div>
                            </x-AdminPanel.table.cell>
                            <x-AdminPanel.table.cell>
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <button wire:click="showReportDetails('{{ $report->message }}')"
                                            class=" bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z" />
                                            </svg>

                                            <span>Details</span>
                                        </button>
                                    </div>
                                </div>
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
        {{ $reports->links('vendor.livewire.custom-pagination') }}
    </div>
    <x-jet-dialog-modal wire:model="openModal">
        <x-slot name="title">
            Report Details
        </x-slot>

        <x-slot name="content">
            <p
                class="mt-2 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white">
                {{ $details }}</p>
        </x-slot>


        <x-slot name="footer">

        </x-slot>

    </x-jet-dialog-modal>
</div>
