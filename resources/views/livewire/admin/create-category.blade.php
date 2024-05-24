<div class="mx-8">
    <div>
        @if (session('success'))
            <x-alerts.success :success="session('success')" />
        @endif

        @if (session('error'))
            <x-alerts.error :error="session('error')" />
        @endif
    </div>

    <div>
        <button wire:click="showModal('addNewCategory')"
            class="px-4 py-3 mb-2 ml-2 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-purple-700 xl-max:to-pink-500 xl-max:text-white xl-max:border-0 hover:scale-102 hover:shadow-soft-xs active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 border-fuchsia-500 bg-none text-fuchsia-500 hover:border-fuchsia-500"
            type="button">
            Add New Category
        </button>

        <div
            class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                <h6>Categories Table</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <x-AdminPanel.table>
                        <x-AdminPanel.table.thead>
                            <tr>
                                <th
                                    class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Category Title</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Category Description</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Action</th>

                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    View Sub-Categories
                                </th>



                            </tr>
                        </x-AdminPanel.table.thead>
                        <tbody>
                            {{-- Parent Foreach --}}
                            @forelse ($categories as $category)
                                <tr>
                                    <x-AdminPanel.table.cell>
                                        <div class="flex px-2 py-1">

                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 leading-normal text-sm">{{ $category->name }}</h6>
                                            </div>
                                        </div>
                                    </x-AdminPanel.table.cell>
                                    <x-AdminPanel.table.cell>
                                        <p class="mb-0 overflow-hidden w-[180px] font-semibold leading-tight text-xs">{{ $category->description }}
                                        </p>
                                    </x-AdminPanel.table.cell>
                                    <x-AdminPanel.table.cell>
                                        <button type="button" wire:click="deleteCategory({{ $category->id }})"
                                            class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Delete</button>

                                        <button type="button" wire:click="editCategory({{ $category->id }})"
                                            class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 drk:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Edit</button>
                                    </x-AdminPanel.table.cell>
                                    <x-AdminPanel.table.cell>
                                        <button
                                            wire:click="collapseSubChild({{ $category->id }}, {{ $showHideLevel2 }})"
                                            type="button"
                                            class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 drk:focus:ring-gray-800 drk:border-gray-700 drk:text-gray-400 hover:bg-gray-100 drk:hover:bg-gray-800">

                                            <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0"
                                                fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </x-AdminPanel.table.cell>

                                </tr>
                                <tr class="{{ $showHideLevel2 == $category->id ? '' : 'hidden' }}">
                                    <x-AdminPanel.table.cell class="bg-gray-300" colspan="4">
                                        <x-AdminPanel.table>
                                            <tbody>
                                                {{-- Child Foreach --}}
                                                @forelse ($category->childCategories as $child)
                                                    <tr>
                                                        <x-AdminPanel.table.cell>
                                                            <div class="flex px-2 py-1">

                                                                <div class="flex flex-col justify-center">
                                                                    <h6 class="mb-0 leading-normal text-sm">
                                                                        {{ $child->name }}</h6>
                                                                </div>
                                                            </div>
                                                        </x-AdminPanel.table.cell>
                                                        <x-AdminPanel.table.cell>
                                                            <p class="overflow-hidden w-[180px] mb-0 font-semibold leading-tight text-xs">
                                                                {{ $child->description }}</p>
                                                        </x-AdminPanel.table.cell>
                                                        <x-AdminPanel.table.cell>
                                                            <button type="button" wire:click="deleteCategory({{ $child->id }})"
                                                                class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Delete</button>
                                                            <button type="button" wire:click="editCategory({{ $child->id }})"
                                                                class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 drk:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Edit</button>
                                                        </x-AdminPanel.table.cell>
                                                        <x-AdminPanel.table.cell>
                                                            <button
                                                                wire:click="collapseChildOfSubChild({{ $child->id }}, {{ $showHideLevel3 }})"
                                                                type="button"
                                                                class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 drk:focus:ring-gray-800 drk:border-gray-700 drk:text-gray-400 hover:bg-gray-100 drk:hover:bg-gray-800">

                                                                <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0"
                                                                    fill="currentColor" viewBox="0 0 20 20"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd"
                                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                        clip-rule="evenodd"></path>
                                                                </svg>
                                                            </button>
                                                        </x-AdminPanel.table.cell>
                                                    </tr>
                                                    <tr class="{{ $showHideLevel3 == $child->id ? '' : 'hidden' }}">
                                                        <x-AdminPanel.table.cell class="bg-gray-400" colspan="4">
                                                            <x-AdminPanel.table>
                                                                <tbody>
                                                                    {{-- Sub Child Foreach --}}
                                                                    @forelse ($child->childCategories as $subChild)
                                                                        <tr>
                                                                            <x-AdminPanel.table.cell>
                                                                                <div class="flex px-2 py-1">

                                                                                    <div class="flex flex-col justify-center">
                                                                                        <h6 class="mb-0 leading-normal text-sm">
                                                                                            {{ $subChild->name }}</h6>
                                                                                    </div>
                                                                                </div>
                                                                            </x-AdminPanel.table.cell>
                                                                            <x-AdminPanel.table.cell>
                                                                                <p class="overflow-hidden w-[180px] mb-0 font-semibold leading-tight text-xs">
                                                                                    {{ $subChild->description }}</p>
                                                                            </x-AdminPanel.table.cell>
                                                                            <x-AdminPanel.table.cell>
                                                                                <button type="button" wire:click="deleteCategory({{ $subChild->id }})"
                                                                                    class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 drk:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Delete</button>
                                                                                <button type="button" wire:click="editCategory({{ $subChild->id }})"
                                                                                    class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 drk:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Edit</button>
                                                                            </x-AdminPanel.table.cell>
                                                                        </tr>
                                                                    @empty
                                                                        <tr>
                                                                            <td class="py-4 px-6 text-center" colspan="4">
                                                                                No Record Found
                                                                            </td>
                                                                        </tr>
                                                                    @endforelse
                                                                </tbody>
                                                            </x-AdminPanel.table>
                                                        </x-AdminPanel.table.cell>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="py-4 px-6 text-center" colspan="4">
                                                            No Record Found
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </x-AdminPanel.table>
                                    </x-AdminPanel.table.cell>
                                </tr>
                            @empty
                                <tr>
                                    <td class="py-4 px-6 text-center" colspan="4">
                                        No Record Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </x-AdminPanel.table>
                </div>
            </div>
        </div>

        <!-- Main modal -->
        <x-Modals.modal modalId="addNewCategory" title="Add New Category">
            @slot('content')
                <form class="space-y-6" wire:submit.prevent="createCategory" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 drk:text-gray-300">Category
                                Title</label>
                            <input type="text" wire:model="name" name="name" value="{{ old('name') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 drk:bg-gray-600 drk:border-gray-500 drk:placeholder-gray-400 drk:text-white"
                                placeholder="Enter Category Title">
                            @error('name')
                                <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 drk:text-gray-300">Category
                                Description</label>
                            <input type="text" wire:model="description" name="description"
                                value="{{ old('description') }}" placeholder="Enter Category Description"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 drk:bg-gray-600 drk:border-gray-500 drk:placeholder-gray-400 drk:text-white">
                            @error('description')
                                <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="parent_id"
                                class="block mb-2 text-sm font-medium text-gray-900 drk:text-gray-300">Select
                                Parent
                                Category</label>
                            <select wire:model="parent_id" name="parent_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 drk:bg-gray-600 drk:border-gray-500 drk:placeholder-gray-400 drk:text-white">

                                <option value="0">Choose...</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @if (count($category->childCategories) > 0)
                                        @foreach ($category->childCategories as $child)
                                            <option value="{{ $child->id }}">{{ $child->name }}</option>
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="py-2">
                        <h5 class="mb-4 text-xl font-medium text-gray-900 drk:text-white">Category Page Setup:</h5>
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 drk:text-gray-300">Category
                                    Tagline</label>
                                <input type="text" wire:model="tagline" name="tagline" value="{{ old('tagline') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 drk:bg-gray-600 drk:border-gray-500 drk:placeholder-gray-400 drk:text-white"
                                    placeholder="Enter Section Description">
                                @error('tagline')
                                    <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 drk:text-gray-300">Cover
                                    Photo</label>
                                    <p class="text-xs">dimensions min: 200 x 300 & max: 250 x 350</p>
                                <input type="file" accept="image/*" wire:model="cover_photo" name="coverPhoto"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 drk:bg-gray-600 drk:border-gray-500 drk:placeholder-gray-400 drk:text-white">
                                {{-- <x-inputs.image-upload wire:model="cover_photo" fileName="coverPhoto" /> --}}
                                @error('cover_photo')
                                    <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class= "block mb-2 text-sm font-medium text-gray-900 drk:text-gray-300">Category
                                    Icon</label>
                                    <p class="text-xs">dimensions min: 200 x 300 & max: 250 x 350</p>
                                <input type="file" accept="image/*" wire:model="category_icon" name="categoryIcon"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 drk:bg-gray-600 drk:border-gray-500 drk:placeholder-gray-400 drk:text-white">
                                {{-- <x-inputs.image-upload wire:model="category_icon" fileName="categoryIcon" /> --}}
                                @error('category_icon')
                                    <span class="text-xs text-red-500 mt-1">The category icon field is required</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="inline-block w-full px-4 py-3 mb-2 ml-2 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-purple-700 xl-max:to-pink-500 xl-max:text-white xl-max:border-0 hover:scale-102 hover:shadow-soft-xs active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 border-fuchsia-500 bg-none text-fuchsia-500 hover:border-fuchsia-500">Submit</button>
                </form>
            @endslot
        </x-Modals.modal>

        {{-- Edit Category Modal --}}
        <x-Modals.modal modalId="editCategoryModal" title="Edit Category">
            @slot('content')
                <form class="space-y-6" wire:submit.prevent="updateCategory">
                    @csrf
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 drk:text-gray-300">Category
                                Title</label>
                            <input type="text" wire:model="name" name="name" value="{{ old('name') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 drk:bg-gray-600 drk:border-gray-500 drk:placeholder-gray-400 drk:text-white"
                                placeholder="Enter Category Name">
                            @error('name')
                                <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 drk:text-gray-300">Category
                                Description</label>
                            <input type="text" wire:model="description" name="description"
                                value="{{ old('description') }}" placeholder="Enter Category Description"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 drk:bg-gray-600 drk:border-gray-500 drk:placeholder-gray-400 drk:text-white">
                            @error('description')
                                <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="py-2">
                        <h5 class="mb-4 text-xl font-medium text-gray-900 drk:text-white">Category Page Setup:</h5>
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 drk:text-gray-300">Category
                                    Tagline</label>
                                <input type="text" wire:model="tagline" name="tagline" value="{{ old('tagline') }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 drk:bg-gray-600 drk:border-gray-500 drk:placeholder-gray-400 drk:text-white"
                                    placeholder="Enter Section Description">
                                @error('tagline')
                                    <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 drk:text-gray-300">Cover
                            Photo</label>
                        <x-inputs.image-upload wire:model="cover_photo" fileName="coverPhoto" />

                    </div> --}}
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 drk:text-gray-300">Cover
                                    Photo</label>
                                    <p class="text-xs">dimensions min: 200 x 300 & max: 250 x 350</p>

                                <input type="file" accept="image/*" wire:model="cover_photo" name="coverPhoto"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 drk:bg-gray-600 drk:border-gray-500 drk:placeholder-gray-400 drk:text-white">
                                {{-- <x-inputs.image-upload wire:model="cover_photo" fileName="coverPhoto" /> --}}
                                @error('cover_photo')
                                    <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 drk:text-gray-300">Category
                                    Icon</label>
                                    <p class="text-xs">dimensions min: 200 x 300 & max: 250 x 350</p>
                                <input type="file" accept="image/*" wire:model="category_icon" name="categoryIcon"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 drk:bg-gray-600 drk:border-gray-500 drk:placeholder-gray-400 drk:text-white">
                                {{-- <x-inputs.image-upload wire:model="category_icon" fileName="categoryIcon" /> --}}
                                @error('category_icon')
                                    <span class="text-xs text-red-500 mt-1">The category icon field is required</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="inline-block w-full px-4 py-3 mb-2 ml-2 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-purple-700 xl-max:to-pink-500 xl-max:text-white xl-max:border-0 hover:scale-102 hover:shadow-soft-xs active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 border-fuchsia-500 bg-none text-fuchsia-500 hover:border-fuchsia-500">Update</button>
                </form>
            @endslot
        </x-Modals.modal>

        {{-- Delete Confirmation Modal --}}
        <x-Modals.delete-confirm-modal message="You are going to delete category" />

    </div>
</div>
