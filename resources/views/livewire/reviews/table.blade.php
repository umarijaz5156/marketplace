<div>

<div class="flex-auto p-4">
    <div class="p-0 overflow-x-auto">
        <x-AdminPanel.table class="bg-white">
            <x-AdminPanel.table.thead>
                <tr>
                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                        ID
                    </th>

                    <th
                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                        <button  type="button">Review By</button>
                    </th>
                    <th
                        class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                        <button  type="button">Service ID</button>
                    </th>
                     <th
                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                        <button  type="button">Rating</button>
                    </th>
                    <th
                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                        <button  type="button">Added At</button>
                    </th>
                    <th
                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                        <button  type="button">Status</button>
                    </th>

                </tr>
            </x-AdminPanel.table.thead>
            <tbody>
                @foreach ($reviews as $review)
                        <tr>
                            <x-AdminPanel.table.cell>
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 leading-normal text-sm" >{{$review->id}}
                                        </h6>
                                    </div>
                                </div>
                            </x-AdminPanel.table.cell>
                            <x-AdminPanel.table.cell>
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 leading-normal text-sm">{{ $review->sentByUser->name }}
                                        </h6>
                                    </div>
                                </div>
                            </x-AdminPanel.table.cell>
                            <x-AdminPanel.table.cell>
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 leading-normal text-sm">{{ $review->gig_id }}
                                        </h6>
                                    </div>
                                </div>
                            </x-AdminPanel.table.cell>
                            <x-AdminPanel.table.cell>
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 leading-normal text-sm">{{ $review->rating }}
                                        </h6>
                                    </div>
                                </div>
                            </x-AdminPanel.table.cell>
                            <x-AdminPanel.table.cell>
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 leading-normal text-sm">{{ $review->created_at }}
                                        </h6>
                                    </div>
                                </div>
                            </x-AdminPanel.table.cell>
                            <x-AdminPanel.table.cell>
                                <button  type="button">
                                    <span class="flex rounded-full {{ $review->is_approved ? 'bg-indigo-500' : 'bg-red-500'}} text-white uppercase px-2 py-1 text-xs font-bold mr-3">
                                        @if ($review->is_approved)
                                            (__'Approved')
                                        @else
                                            Not Approved
                                        @endif
                                    </span>
                                </button>

                            </x-AdminPanel.table.cell>
                        </tr>

                @endforeach
                {{ $reviews->links()}}
            </tbody>
        </x-AdminPanel.table>
    </div>
</div>
</div>


