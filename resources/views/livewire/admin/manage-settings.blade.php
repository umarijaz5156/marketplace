<div class="px-6">
    <div class="my-2">
        @if (session('success'))
            <x-alerts.success :success="session('success')" />
        @endif
    </div>

    <div class="mx-3">
        <div wire:ignore.self id="accordion-collapse" data-accordion="collapse">
            <h2 id="accordion-collapse-heading-1">
                <button type="button"
                    class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-700 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 drk:focus:ring-gray-800 drk:border-gray-700 drk:text-gray-400 hover:bg-gray-100 drk:hover:bg-gray-800"
                    data-accordion-target="#accordion-collapse-config-basic" aria-expanded="false"
                    aria-controls="accordion-collapse-config-basic">
                    <span>Config Basic</span>
                    <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </h2>
            <div wire:ignore.self id="accordion-collapse-config-basic" class="hidden"
                aria-labelledby="accordion-collapse-heading-1">
                <div class="p-5 font-light border border-b-0 border-gray-200 drk:border-gray-700 drk:bg-gray-900">
                    <form action="{{ route('submit_config_basic_form') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <x-AdminPanel.form.label>Site Title</x-AdminPanel.form.label>
                                <x-AdminPanel.form.input wire:model="site_title" placeholder="Enter Site Title"
                                    name="title" />
                                @error('site_title')
                                    <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <x-AdminPanel.form.label>Upload Logo</x-AdminPanel.form.label>
                                <x-inputs.image-upload wire:model="logo" fileName="logo" />
                                {{-- <p class="mt-1 text-sm text-gray-500 drk:text-gray-300" id="file_input_help">SVG, PNG,
                                    JPG or GIF (MAX. 800x400px).
                                </p> --}}
                                <div class="mx-2 my-2">
                                    <img src="{{ asset('storage/images/logo/' . $logo) }}" alt="" width="100"
                                        height="100" srcset="">
                                </div>
                            </div>
                            <div>
                                <x-AdminPanel.form.label>Upload Fav Icon</x-AdminPanel.form.label>
                                <x-inputs.image-upload wire:model="favIcon" fileName="favIcon" />
                                {{-- <p class="mt-1 text-sm text-gray-500 drk:text-gray-300" id="file_input_help">SVG, PNG,
                                    JPG or GIF (MAX. 800x400px).
                                </p> --}}
                                <div class="mx-2 my-2">
                                    <img src="{{ asset('storage/images/favIcon/' . $favIcon) }}" alt=""
                                        width="100" height="100" srcset="">
                                </div>
                            </div>
                        </div>

                        <x-AdminPanel.button type="submit">Save</x-AdminPanel.button>
                    </form>
                </div>
            </div>
            <livewire:admin.settings.home-page-settings />

            <livewire:admin.settings.manage-content-settings />

            <livewire:admin.settings.revenue-configs />

            <livewire:admin.settings.affiliate-settings />

            <livewire:admin.settings.misc-settings />
            <livewire:admin.settings.spam-settings />
        </div>
    </div>
</div>
