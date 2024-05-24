<div class="mx-8">
    <div class="my-2">
        @if (session('success'))
            <x-alerts.success :success="session('success')" />
        @endif
        @if(session('error'))
            <x-alerts.error :error="session('error')" />
        @endif
    <x-message-area-notification />
    </div>
    <a href="{{ route('admin.gig') }}"
        class="px-4 py-3 mb-4 ml-2 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-purple-700 xl-max:to-pink-500 xl-max:text-white xl-max:border-0 hover:scale-102 hover:shadow-soft-xs active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 border-fuchsia-500 bg-none text-fuchsia-500 hover:border-fuchsia-500"
        type="button">
        Add Service
    </a>

    <div
        class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
            <h6>Services table</h6>
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
            {{-- <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft px-1">
                <select wire:model="limit"
                    class="pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                    <option value="">All</option>
                    <option value="5">Top 5</option>
                    <option value="10">Top 10</option>
                    <option value="20">Top 20</option>
                </select>
            </div> --}}
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
                                class="px-3 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('gig_title')" type="button">Service Title</button>
                                    <x-sort-icon field="gig_title" :sortField="$sortField" :sortAsc="$sortAsc" />
                                </div>
                            </th>
                            <th
                                class="px-3 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('seller_name')" type="button">Seller Name</button>
                                    <x-sort-icon field="seller_name" :sortField="$sortField" :sortAsc="$sortAsc" />
                                </div>
                            </th>
                            <th
                                class="px-3 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('order_count')" type="button">Total Orders</button>
                                    <x-sort-icon field="order_count" :sortField="$sortField" :sortAsc="$sortAsc" />
                                </div>
                            </th>
                            <th
                                class="px-3 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('order_cancelled')" type="button">Cancelled Orders</button>
                                    <x-sort-icon field="order_cancelled" :sortField="$sortField" :sortAsc="$sortAsc" />
                                </div>
                            </th>
                            <th
                                class="px-3 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('order_completed')" type="button">Completed Orders</button>
                                    <x-sort-icon field="order_completed" :sortField="$sortField" :sortAsc="$sortAsc" />
                                </div>
                            </th>
                            <th
                                class="px-3 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('reviews_count')" type="button">Total Reviews</button>
                                    <x-sort-icon field="reviews_count" :sortField="$sortField" :sortAsc="$sortAsc" />
                                </div>
                            </th>
                            <th
                                class="px-3 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('reviews_average')" type="button">Average
                                        Rating</button>
                                    <x-sort-icon field="reviews_average" :sortField="$sortField" :sortAsc="$sortAsc" />
                                </div>
                            </th>
                            <th
                                class="px-3 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('money_earned')" type="button">Earning</button>
                                    <x-sort-icon field="money_earned" :sortField="$sortField" :sortAsc="$sortAsc" />
                                </div>
                            </th>
                            <th
                                class="px-3 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                <div class="flex items-center">
                                    <button wire:click="sortBy('created_at')" type="button">Date</button>
                                    <x-sort-icon field="created_at" :sortField="$sortField" :sortAsc="$sortAsc" />
                                </div>
                            </th>
                            <th
                                class="px-3 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Status
                            </th>
                            <th
                                class="px-3 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Reviews
                            </th>
                            <th colspan="2"
                                class="px-3 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                Action
                            </th>
                        </tr>
                    </x-AdminPanel.table.thead>
                    <tbody>
                        @forelse ($gigs as $gig)
                            <tr wire:key="row-{{ $gig->gig_id }}">
                                <x-AdminPanel.table.cell :wire:key="'gig_title-'.$gig->gig_id">
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <a href="{{ route('gig_details', ['slug' => $gig->slug]) }}"
                                                class="font-semibold leading-tight text-xs text-slate-400">
                                                <h6 class="mb-0 leading-normal text-sm">{{ $gig->gig_title }}
                                                </h6>
                                            </a>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>

                                <x-AdminPanel.table.cell :wire:key="'s_name-'.$gig->gig_id">
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $gig->seller_name }}
                                            </h6>
                                        </div>
                                    </div>
                                </x-AdminPanel.table.cell>

                                <x-AdminPanel.table.cell :wire:key="'orders_count-'.$gig->gig_id">
                                    <p class="mb-0 font-semibold leading-tight text-xs">
                                        {{ $gig->order_count }}</p>
                                </x-AdminPanel.table.cell>

                                <x-AdminPanel.table.cell :wire:key="'orders_cancelled-'.$gig->gig_id">
                                    <p class="mb-0 font-semibold leading-tight text-xs">
                                        {{ $gig->order_cancelled }}</p>
                                </x-AdminPanel.table.cell>

                                <x-AdminPanel.table.cell :wire:key="'orders_completed-'.$gig->gig_id">
                                    <p class="mb-0 font-semibold leading-tight text-xs">
                                        {{ $gig->order_completed }}</p>
                                </x-AdminPanel.table.cell>

                                <x-AdminPanel.table.cell :wire:key="'rev_count-'.$gig->gig_id">
                                    <p class="mb-0 font-semibold leading-tight text-xs">
                                        {{ $gig->reviews_count }}</p>
                                </x-AdminPanel.table.cell>

                                <x-AdminPanel.table.cell :wire:key="'rev_avg-'.$gig->gig_id">
                                    <p class="mb-0 font-semibold leading-tight text-xs">
                                        {{ $gig->reviews_average }}</p>
                                </x-AdminPanel.table.cell>

                                <x-AdminPanel.table.cell :wire:key="'earned-'.$gig->gig_id">
                                    <p class="mb-0 font-semibold leading-tight text-xs">
                                        ${{ $gig->money_earned }}</p>
                                </x-AdminPanel.table.cell>

                                <x-AdminPanel.table.cell :wire:key="'created-'.$gig->gig_id">
                                    <p class="mb-0 font-semibold leading-tight text-xs">
                                        {{ $gig->created_at }}
                                    </p>
                                </x-AdminPanel.table.cell>

                                <x-AdminPanel.table.cell :wire:key="'action-'.$gig->gig_id">
                                    <button
                                        wire:click="changeStatus({{ $gig->gig_id }}, {{ $gig->is_approved }})"
                                        class="{{ $gig->is_approved == 1 ? 'bg-green-500' : 'bg-red-500' }} text-white text-xs py-2 px-4 rounded-full"
                                        :wire:key="'approve-'.$gig->gig_id"
                                    >
                                        {{ $gig->is_approved == 1 ? 'Approved' : 'Not Approved' }}
                                    </button>
                                </x-AdminPanel.table.cell>

                                <x-AdminPanel.table.cell :wire:key="'review-'.$gig->gig_id">
                                    <button
                                    wire:click="openReviewModal({{ $gig->gig_id }})"
                                    class="bg-green-500 text-white text-xs py-2 px-4 rounded-full"
                                    :wire:key="'review-'.$gig->gig_id"
                                >
                                    Add Review
                                </button>
                                </x-AdminPanel.table.cell>

                                {{-- <x-AdminPanel.table.cell :wire:key="'delete-'.$gig->gig_id">
                                    <button wire:click="deleteGig({{ $gig->gig_id }})"
                                        class="bg-red-500 text-white text-xs py-2 px-4 rounded-full"
                                    >
                                        Delete
                                    </button>
                                </x-AdminPanel.table.cell> --}}

                                <x-AdminPanel.table.cell :wire:key="'edit-'.$gig->gig_id">
                                    <a href="{{ route('admin.edit-gig', ['id' => $gig->gig_id]) }}" class="px-4 py-1 text-sm text-blue-600 bg-blue-200 rounded-full">
                                        Edit
                                    </a>
                                </x-AdminPanel.table.cell>

                            </tr>
                        @empty
                            <tr>
                                <td class="py-4 px-6 text-center" colspan="11">
                                    No Record Found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </x-AdminPanel.table>
            </div>
        </div>
        <div class="px-3 py-2">
            {{ $gigs->links("vendor.livewire.custom-pagination") }}
        </div>
    </div>
    {{-- Delete Confirmation Modal --}}
    <x-Modals.delete-confirm-modal message="You are going to delete service" />

    {{-- Confirm Status Change Modal --}}
    <x-Modals.change-status-modal message="You are going to {{ $statusChangeInfo['statusValue'] ? 'approve' : 'disapprove' }} service" />

    <x-jet-dialog-modal wire:model="openReviewModal">
        <x-slot name="title">
            Add Review
        </x-slot>

        <x-slot name="content">
            <div class="col-span-6 sm:col-span-4">
                <div class="flex justify-between">
                    <x-jet-label for="review"  class="text-lg" value="{{ __('Review From') }}" />
                    <p wire:click="$set('selectedUser', {{ auth()->user()->id }})" class="text-sm text-blue-500 text-underline cursor-pointer hover:text-blue-600">Select Yourself ?</p>
                </div>
                <x-AdminPanel.form.select class="my-2" wire:model="selectedUser">
                    <option value="" selected>Select a user</option>
                    @foreach ($users as $user)

                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach

                </x-AdminPanel.form.select>
            </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="review"  class="text-lg" value="{{ __('Review') }}" />
                    <textarea required wire:model.defer="comment" name="comment" class="block w-full px-4 py-3 border-2 rounded-lg focus:border-blue-200 focus:outline-none" placeholder="Review.."></textarea>

                </div>
                <div class="col-span-6 sm:col-span-4 mt-4 mb-4">
                    <x-jet-label for="review"  class="text-lg" value="{{ __('Date') }}" />
                    <input  max="<?= date('Y-m-d'); ?>" wire:model.defer="date" name="date" type="date" class="block w-full px-4 py-2 border-2 rounded-lg focus:border-blue-200 focus:outline-none" />

                </div>

                <div class="col-span-6 sm:col-span-4 mt-4 mb-4">

                     <x-jet-label for="rating" class="text-lg" value="{{ __('Rating') }}" />

                    <div class="flex space-x-1 rating">
                        <div>
                            <label for="star1">

                                <input class="opacity-0" wire:model="rating" type="radio" id="star1" name="rating" value="1"/>
                                <svg class="cursor-pointer block w-8 h-8 @if($rating >= 1 )  text-yellow-400 @else text-gray-300 drk:text-gray-500 @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            </label>
                        </div>
                        <div>
                            <label for="star2">
                                <input class="opacity-0"  wire:model="rating" type="radio" id="star2" name="rating" value="2" />
                                <svg class="cursor-pointer block w-8 h-8 @if($rating >= 2 )  text-yellow-400 @else text-gray-300  @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                            </label>
                        </div>

                        <label for="star3">
                            <input class="opacity-0"    wire:model="rating" type="radio" id="star3" name="rating" value="3" />
                            <svg class="cursor-pointer block w-8 h-8 @if($rating >= 3 )  text-yellow-400 @else text-gray-300 drk:text-gray-500 @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        </label>
                        <label for="star4">
                            <input class="opacity-0"   wire:model="rating" type="radio" id="star4" name="rating" value="4" />
                            <svg class="cursor-pointer block w-8 h-8 @if($rating >= 4 ) text-yellow-400 @else text-gray-300 drk:text-gray-500 @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        </label>
                        <label for="star5">
                            <input class="opacity-0"    wire:model="rating" type="radio" id="star5" name="rating" value="5" />
                            <svg class="cursor-pointer block w-8 h-8 @if($rating >= 5 )  text-yellow-400 @else text-gray-300 drk:text-gray-500 @endif " fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                        </label>
                    </div>

                </div>
        </x-slot>


        <x-slot name="footer">
            <button type="button" wire:click="addReview"
                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-green-600 drk:hover:bg-green-700 drk:focus:ring-green-800">Submit</button>
            <button type="button" wire:click="toggleModal"
                class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 drk:bg-gray-800 drk:text-white drk:border-gray-600 drk:hover:bg-gray-700 drk:hover:border-gray-600 drk:focus:ring-gray-700">Cancel</button>
        </x-slot>

    </x-jet-dialog-modal>
</div>
