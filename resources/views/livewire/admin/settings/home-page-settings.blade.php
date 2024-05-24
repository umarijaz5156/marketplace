<div>
    @push('styles')
        @once
                @vite(['resources/css/select2.css'])
        @endonce
    @endpush
    <h2 id="accordion-collapse-heading-2">
        <button type="button"
            class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 drk:focus:ring-gray-800 drk:border-gray-700 drk:text-gray-400 hover:bg-gray-100 drk:hover:bg-gray-800"
            data-accordion-target="#accordion-collapse-body-2" aria-expanded="false"
            aria-controls="accordion-collapse-body-2">
            <span>Config Home</span>
            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
    </h2>
    <div wire:ignore.self id="accordion-collapse-body-2" class="hidden" aria-labelledby="accordion-collapse-heading-2">
        <div class="p-5 font-light border border-b-0 border-gray-200 drk:border-gray-700 drk:bg-gray-900">
            <form wire:submit.prevent="updateHomeConfig" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <x-AdminPanel.form.label>Header Title</x-AdminPanel.form.label>
                        <x-AdminPanel.form.input wire:model="header_title" placeholder="Enter Title" name="title" />
                        @error('header_title')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <x-AdminPanel.form.label>Header Description</x-AdminPanel.form.label>
                        <x-AdminPanel.form.textbox wire:model="header_description" placeholder="Enter Description"
                            name="description">
                            {{ $configHome->description }}</x-AdminPanel.form.textbox>
                        @error('header_description')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div x-data="{ popular: {{ $configHome->status1 == 1 ? 'true' : 'false' }} }">
                        <label for="default-toggle" class="inline-flex relative items-center cursor-pointer">
                            <input x-model="popular" wire:model="popularCategoriesCheck" name="popularCategoriesCheck"
                                type="checkbox" value="1" id="default-toggle" class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 drk:peer-focus:ring-blue-800 rounded-full peer drk:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all drk:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-900 drk:text-gray-300">Select
                                Manual</span>
                        </label>
                        <div x-show="!popular">
                            <x-AdminPanel.form.label>Show Popular Categories</x-AdminPanel.form.label>
                            <x-AdminPanel.form.select wire:model="popularCategoriesFilter"
                                name="homePagePopularCategoriesFilter">
                                <option value="1">Top 10 Selling</option>
                            </x-AdminPanel.form.select>
                        </div>

                        <div wire:ignore x-show="popular">
                            <x-AdminPanel.form.label>Select Popular Categories</x-AdminPanel.form.label>
                            <x-AdminPanel.form.select wire:model="popularCategoriesManual"
                                name="homePagePopularCategoriesManual[]" multiple class="select2"
                                id="popularCategories">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @foreach ($category->childCategories as $child)
                                        <option value="{{ $child->id }}">{{ $child->name }}</option>
                                        @foreach ($child->childCategories as $subChild)
                                            <option value="{{ $subChild->id }}">{{ $subChild->name }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </x-AdminPanel.form.select>
                        </div>
                        @error('popularCategoriesManual.*')
                            <span class="text-xs text-red-500 mt-1">This field is required</span>
                        @enderror
                    </div>
                    <div x-data="{ marketPlace: {{ $configHome->status2 == 1 ? 'true' : 'false' }} }">
                        <label for="default-toggle2" class="inline-flex relative items-center cursor-pointer">
                            <input x-model="marketPlace" wire:model="marketPlaceCheck" name="marketPlaceCheck"
                                type="checkbox" value="1" id="default-toggle2" class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 drk:peer-focus:ring-blue-800 rounded-full peer drk:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all drk:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-900 drk:text-gray-300">Select
                                Manual</span>
                        </label>
                        <div x-show="!marketPlace">
                            <x-AdminPanel.form.label>Show Market Place By</x-AdminPanel.form.label>
                            <x-AdminPanel.form.select wire:model="marketPlaceFilter" name="marketPlaceFilter">
                                <option value="1">Show All Categories</option>
                            </x-AdminPanel.form.select>
                        </div>
                        <div wire:ignore x-show="marketPlace">
                            <x-AdminPanel.form.label>Select Categories</x-AdminPanel.form.label>
                            <x-AdminPanel.form.select wire:model="marketPlaceManual" name="marketPlaceManual[]"
                                multiple="multiple" id="marketePlace" class="select2">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @foreach ($category->childCategories as $child)
                                        <option value="{{ $child->id }}">{{ $child->name }}</option>
                                        @foreach ($child->childCategories as $subChild)
                                            <option value="{{ $subChild->id }}">{{ $subChild->name }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </x-AdminPanel.form.select>
                        </div>
                        @error('marketPlaceManual.*')
                            <span class="text-xs text-red-500 mt-1">This field is required</span>
                        @enderror
                    </div>

                    <div>
                        <x-AdminPanel.form.label>Upload Header Image</x-AdminPanel.form.label>
                        <x-inputs.image-upload wire:model="headerImage" fileName="headerImage" />
                        {{-- <p class="mt-1 text-sm text-gray-500 drk:text-gray-300" id="file_input_help">SVG,
                            PNG,
                            JPG or GIF (MAX. 800x400px).</p> --}}
                        @if (isset($configHome->header_image))
                            <div class="mx-2 my-2">
                                <img src="{{ asset('storage/images/homePage/' . $configHome->header_image) }}"
                                    alt="" width="100" height="100" srcset="">
                            </div>
                        @endif
                    </div>
                </div>

                <x-AdminPanel.button type="submit">Save</x-AdminPanel.button>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    placeholder: "Select multiple options    ",
                    multiple: true,
                    // allowClear: true,
                });

                $('#marketePlace').on('change', function(e) {
                    let data = $('#marketePlace').select2("val");
                    @this.set('marketPlaceManual', data);
                });

                $('#popularCategories').on('change', function(e) {
                    let data = $('#popularCategories').select2("val");
                    @this.set('popularCategoriesManual', data);
                });

                $('#sellerManualIds').on('change', function(e) {
                    let data = $('#sellerManualIds').select2("val");
                    @this.set('sellerManual', data);
                });

                $('#gigsManualIds').on('change', function(e) {
                    let data = $('#gigsManualIds').select2("val");
                    @this.set('gigManual', data);
                });
            });
        </script>
    @endpush

</div>
