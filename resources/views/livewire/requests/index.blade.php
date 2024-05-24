<section class="" x-data="{ active: @entangle('active') }">
    <div class="bg-[#F4FCFF]">
        <div class="container 2xl:max-w-screen-xl mx-auto px-4 h-full pt-14 lg:min-h-[20vh] relative">
            <div class="flex justify-between">
                <div>
                    <h1 class="text-[#263238] text-5xl font-bold">Manage Requests</h1>
                    <p class="text-[#6A6A6A] text-lg font-medium mt-3">Current requests for your business</p>
                </div>
                <div>
                    <button wire:click="showModal" type="button"
                        class="bg-green-300 hover:bg-green-500 hover:text-white rounded px-6 py-3 text-green-700 font-medium text-sm">
                        Create Request
                    </button>
                </div>
            </div>


            <div class="h-full">
                <div class="mt-14">
                    <div class="max-w-2xl w-full">
                        <div class=" flex justify-start items-center gap-6 sm:gap-0 flex-wrap sm:flex-nowrap">

                            <button class="px-4 py-1 hover:text-[#0096D8] font-semibold w-max h-[50px]"
                                @click="active = 0"
                                wire:click="changeStatus('active', 0)"
                                x-bind:class="active == 0 ?
                                        'text-[#0096D8] animate-[press_0.2s_linear] border-b-2 border-[#0096D8]' : ' '">
                                Active
                            </button>

                            <button class="px-4 py-1 hover:text-[#0096D8] font-semibold w-max h-[50px]"
                            @click="active = 1"
                            wire:click="changeStatus('inactive', 1)"
                            x-bind:class="active == 1 ?
                                    'text-[#0096D8] animate-[press_0.2s_linear] border-b-2 border-[#0096D8]' : ' '">
                           In Active
                        </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container 2xl:max-w-screen-xl  mx-auto px-4 h-full mt-14">
        @if (session('success'))
        <x-alerts.success :success="session('success')" />
        @endif

        @if (session('error'))
        <x-alerts.error :error="session('error')" />
        @endif
        <div class="relative overflow-auto rounded p-6 transition-all duration-300 ease-in space-y-11" {{--
            x-bind:class="active == {{$active}} ? 'animate-[show-transition_0.5s_ease-in-out] block' : 'max-h-0 opacity-0 hidden'"
            --}}>
            <div>
                <div class="overflow-x-auto relative">
                    <table class="lg:w-full text-sm text-left text-gray-500 drk:text-gray-400">
                        <thead
                            class="text-sm border-b border-[#E2EAED] text-[#6A6A6A] uppercase drk:bg-gray-700 drk:text-gray-400 ">
                            <tr>
                                <th scope="col" class="py-3 px-6">
                                    Requirement

                                </th>
                                <th scope="col" class="py-3 px-6">
                                    <div class="flex items-center">
                                        <button wire:click="sortBy('created_at')" type="button">Date</button>

                                        <x-sort-icon field="created_at" :sortField="$sortField"
                                            :sortAsc="$sortAsc" />
                                    </div>

                                </th>
                                <th scope="col" class="py-3 px-6">
                                    <div class="flex items-center">
                                        <button type="button">Budget</button>
                                    </div>

                                </th>
                                <th scope="col" class="py-3 px-6">
                                    <div class="flex items-center">
                                        <button wire:click="sortBy('duration')" type="button">Duration</button>

                                        <x-sort-icon field="created_at" :sortField="$sortField"
                                            :sortAsc="$sortAsc" />
                                    </div>

                                </th>

                                <th scope="col" class="py-3 px-6">
                                    Status
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Bids
                                </th>
                                <th scope="col" class="py-3 px-6">

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($requests) > 0)
                            @foreach ($requests as $request)

                            <tr class=" border-b border-[#E2EAED]  drk:bg-gray-800 drk:border-gray-700">
                                <th class="max-w-[40px] py-4 px-6 font-medium text-gray-900  drk:text-white">
                                    <a href="{{ route('requests.details', $request->id) }}" title="{{ $request->requirements }}" class="cursor-pointer max-h-[20px]  text-[#263238] font-semibold text-sm text-ellipsis overflow-hidden">
                                           {{  \Illuminate\Support\Str::limit( $request->requirements ,  40, $end='...' ) }}
                                    </h4>

                                </th>

                                <td class="py-4 px-6">
                                    <h4 class="text-[#263238] font-semibold text-sm">
                                        {{ $request->created_at->format('M, d Y') }}
                                    </h4>
                                </td>
                                <td class="py-4 px-6">
                                    <h4 class="text-[#263238] font-semibold text-sm">
                                        ${{ $request->min_budget}} - ${{ $request->max_budget }}
                                    </h4>
                                </td>
                                <td class="py-4 px-6">
                                    <h4 class="text-[#263238] font-semibold text-sm">
                                        {{ $request->duration}} Days
                                    </h4>
                                </td>


                                <td class="py-4 px-6 ">

                                    <span class="{{ $request->status == 'active'
                            ? 'bg-green-200 text-green-600'
                            : 'bg-red-200 text-red-600' }}
                                font-semibold text-sm px-6 py-2 rounded">{{ $request->status }}</span>
                                </td>
                                <td class="py-4 px-6">
                                    <a href="{{ route('request.proposals', $request->id) }}" class="underline hover:text-blue-600 hover:text-lg">{{ $request->proposals?->count() }}</a>
                                </td>
                                <td class="py-4 px-6">
                                    <button wire:click='openEditModal({{ $request->id }})' type="button"
                                        class="bg-[#0096D8] text-white text-sm rounded-full w-9 h-9 flex justify-center items-center">
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            {{ $requests->links('vendor.livewire.custom-pagination') }}
                            @else
                            <td colspan="6"
                                class="text-[14px] text-center text-gray-400 font-medium py-4 px-6 rounded-tr-[18px] rounded-br-[18px]">
                                No Record Found
                            </td>

                            @endif


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <x-jet-dialog-modal maxWidth="2xl" wire:model="openModal">
        <x-slot name="title">
            Create New Request
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <div class="mt-[35px] sm:mt-9">
                    <label for="Categories" class="text-lg">Categories<span style="color:#ff0000">*</span></label>
                </div>
                <div class="grid sm:grid-cols-2 gap-x-10">
                    {{-- main categories --}}
                    <div class="mb-[30px] sm:mb-0">


                        <select wire:model.lazy="currentMainCategory" name="categories[]" id="main_select"
                            class="block py-2.5 px-0 w-full text-[16px] text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none drk:text-gray-400 drk:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                            <option value="">Select a Category</option>
                            @foreach ($mainCategories as $main)
                            <option {{ $main->id == $currentMainCategory ? 'selected' : '' }} value="{{ $main->id}}">
                                {{ $main->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('currentMainCategory')<x-form-error>{{$message}}</x-form-error>@enderror
                    </div>

                    <div>
                        <select wire:model.lazy="currentSubCategory" name="categories[]" id="sub_select"
                            class="block py-2.5 px-0 w-full text-[16px] text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none drk:text-gray-400 drk:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                            <option value="">Select a subcategory</option>
                            @foreach ($subCategories as $subCategory)
                            <option value="{{$subCategory->id}}">
                                {{$subCategory->name}}
                            </option>
                            @endforeach
                        </select>
                        @error('currentSubCategory')<x-form-error>{{$message}}</x-form-error>@enderror
                    </div>

                </div>
            </div>

            <div class="mb-4">
                <label for="Categories" class="text-lg">Budget <span class='text-base'>(USD)</span><span style="color:#ff0000">*</span></label>
                <div class="grid grid-cols-2 gap-10">
                    <div>

                        <input type="number" id="min_budget" wire:model.defer='minBudget'
                            aria-describedby="helper-text-explanation"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="min budget" required>
                        @error('minBudget')<x-form-error>{{$message}}</x-form-error>@enderror
                    </div>
                    <div>

                        <input type="number" id="max_budget" wire:model.defer='maxBudget'
                            aria-describedby="helper-text-explanation"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="max budget" required>
                        @error('maxBudget')<x-form-error>{{$message}}</x-form-error>@enderror
                    </div>

                </div>
            </div>
            <div class="mb-4">
                <label for="duration" class="text-lg">Duration  <span class='text-base'>(Days)<span style="color:#ff0000">*</span></label>
                <input type="number" id="duration" wire:model.defer='duration'
                aria-describedby="helper-text-explanation"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Duration in days" required>

                @error('duration')<x-form-error>{{$message}}</x-form-error>@enderror
            </div>

            <div class="mb-4">
                <div class="mt-[35px] sm:mt-9">
                    <label for="requirements" class="text-lg">Requirements<span style="color:#ff0000">*</span></label>

                @error('minBudget')<x-form-error>{{$message}}</x-form-error>@enderror
                </div>
                <textarea wire:model.defer='requirements' id="requirements" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>

                    @error('requirements')<x-form-error>{{$message}}</x-form-error>@enderror
            </div>


        </x-slot>


        <x-slot name="footer">

            <button type="button" wire:click="submit"
                class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800">
                Create Request</button>

        </x-slot>

    </x-jet-dialog-modal>

    <x-jet-dialog-modal maxWidth="2xl" wire:model="editModal">
        <x-slot name="title">
            <div class="flex justify-between">
                <p>Edit Request</p>
                <div>
                    {{-- <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label> --}}
                    <select id="status" wire:model='status' class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                      <option value="active">Active</option>
                      <option value="inactive">In Active</option>

                    </select>
                </div>
            </div>

        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <div class="mt-[35px] sm:mt-9">
                    <label for="Categories" class="text-lg">Categories<span style="color:#ff0000">*</span></label>
                </div>
                <div class="grid sm:grid-cols-2 gap-x-10">

                    <div class="mb-[30px] sm:mb-0">


                        <select disabled wire:model="currentMainCategory" name="categories[]" id="main_select"
                            class="block py-2.5 px-0 w-full text-[16px] text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none drk:text-gray-400 drk:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                            <option value="">Select a Category</option>
                            @foreach ($mainCategories as $main)
                            <option {{ $main->id == $currentMainCategory ? 'selected' : '' }} value="{{ $main->id}}">
                                {{ $main->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('currentMainCategory')<x-form-error>{{$message}}</x-form-error>@enderror
                    </div>

                    <div>
                        <select disabled wire:model="currentSubCategory" name="categories[]" id="sub_select"
                            class="block py-2.5 px-0 w-full text-[16px] text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none drk:text-gray-400 drk:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                            <option value="">Select a subcategory</option>
                            @foreach ($subCategories as $subCategory)
                            <option {{ $subCategory->id == $currentSubCategory ? 'selected' : '' }}  value="{{$subCategory->id}}">
                                {{$subCategory->name}}
                            </option>
                            @endforeach
                        </select>
                        @error('currentSubCategory')<x-form-error>{{$message}}</x-form-error>@enderror
                    </div>

                </div>
            </div>

            <div class="mb-4">
                <label for="Categories" class="text-lg">Budget <span class='text-base'>(USD)</span><span style="color:#ff0000">*</span></label>
                <div class="grid grid-cols-2 gap-10">
                    <div>

                        <input type="number" id="min_budget" wire:model='minBudget'
                            aria-describedby="helper-text-explanation"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="min budget" required>
                        @error('minBudget')<x-form-error>{{$message}}</x-form-error>@enderror
                    </div>
                    <div>

                        <input type="number" id="max_budget" wire:model='maxBudget'
                            aria-describedby="helper-text-explanation"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="max budget" required>
                        @error('maxBudget')<x-form-error>{{$message}}</x-form-error>@enderror
                    </div>

                </div>
            </div>

            <div class="mb-4">
                <label for="duration" class="text-lg">Duration  <span class='text-base'>(Days)<span style="color:#ff0000">*</span></label>
                <input type="number" id="duration" wire:model.defer='duration'
                aria-describedby="helper-text-explanation"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Duration in days" required>

                @error('duration')<x-form-error>{{$message}}</x-form-error>@enderror
            </div>


            <div class="mb-4">
                <div class="mt-[35px] sm:mt-9">
                    <label for="Categories" class="text-lg">Requirements<span style="color:#ff0000">*</span></label>
                </div>
                <textarea disabled wire:model.defer='requirements' id="requirements" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>

                    @error('requirements')<x-form-error>{{$message}}</x-form-error>@enderror
            </div>


        </x-slot>


        <x-slot name="footer">

            <button type="button" wire:click="update"
                class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800">
                Update Request</button>

        </x-slot>

    </x-jet-dialog-modal>
</section>
