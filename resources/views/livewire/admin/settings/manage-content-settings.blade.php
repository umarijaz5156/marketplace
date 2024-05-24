<div>
    <h2 id="accordion-collapse-heading-3">
        <button type="button"
            class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 drk:focus:ring-gray-800 drk:border-gray-700 drk:text-gray-400 hover:bg-gray-100 drk:hover:bg-gray-800"
            data-accordion-target="#accordion-collapse-manage-content" aria-expanded="false"
            aria-controls="accordion-collapse-manage-content">
            <span>Content Settings</span>
            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
    </h2>
    <div wire:ignore.self id="accordion-collapse-manage-content" class="hidden"
        aria-labelledby="accordion-collapse-heading-3">
        <div class="p-5 border border-b-0 border-gray-200 drk:border-gray-700 drk:bg-gray-900">

            <form wire:submit.prevent="updateContentSettings" enctype="multipart/form-data">
                @csrf
                {{-- Criteria Section for recommended gigs on gig view page --}}
                <div class="flex justify-between">
                    <h1 class="mb-6">Criteria for recommended services on service view page</h1>

                    <div x-data="{ rcmndGigStatus: {{ $rcmndGigStatus == 1 ? 'true' : 'false' }} }" class="">
                        <label for="checked-toggle" class="inline-flex relative items-center cursor-pointer">
                            <input x-model="rcmndGigStatus" wire:model="rcmndGigStatus" type="checkbox" value="" id="checked-toggle" class="sr-only peer" >
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 drk:peer-focus:ring-blue-800 drk:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all drk:border-gray-600 peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-900 drk:text-gray-300">Disable Setting</span>
                        </label>
                    </div>
                </div>

                <div class="grid gap-3 mb-6 md:grid-cols-2 lg:grid-cols-3">
                    <div class="">
                        <x-AdminPanel.form.label>Seller rating should be greater than or equals
                        </x-AdminPanel.form.label>

                        <x-AdminPanel.form.select wire:model="sellerRatingForGigView" name="sellerRatingForGigView">
                            @foreach ($optionValues as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </x-AdminPanel.form.select>

                        @error('sellerRatingForGigView')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Service rating should be greater than equals</x-AdminPanel.form.label>

                        <x-AdminPanel.form.select wire:model="gigRatingForGigView" name="gigRatingForGigView">
                            @foreach ($optionValues as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </x-AdminPanel.form.select>

                        @error('gigRatingForGigView')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Service total orders must be greater than</x-AdminPanel.form.label>

                        <x-AdminPanel.form.select wire:model="gigOrdersForGigView" name="gigOrdersForGigView">
                            @foreach ($optionValues as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </x-AdminPanel.form.select>

                        @error('gigOrdersForGigView')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Seller total orders completed must be greater than
                        </x-AdminPanel.form.label>

                        <x-AdminPanel.form.input wire:model="sellerOrdersForGigView" name="sellerOrdersForGigView" type="number" min="1" />
                        @error('sellerOrdersForGigView')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Seller registration date should be greater than
                        </x-AdminPanel.form.label>

                        <x-AdminPanel.form.input wire:model="sellerRegDateForGigView" name="sellerRegDateForGigView" type="date" />

                        @error('sellerRegDateForGigView')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Service add date should be greater than</x-AdminPanel.form.label>

                        <x-AdminPanel.form.input wire:model="gigAddDateForGigView" name="gigAddDateForGigView" type="date" />

                        @error('gigAddDateForGigView')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Limit to show services</x-AdminPanel.form.label>

                        <x-AdminPanel.form.input wire:model="limit" name="limit" type="number" min="4" />

                        @error('limit')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Criteria section for Also Viewed Gigs In Gig View Page --}}
                <div class="flex justify-between">
                    <h1 class="mb-3 mt-6">Criteria for people who viewed this service for service view page</h1>

                    <div x-data="{ whoViewdServiceStatus: {{ $whoViewdServiceStatus == 1 ? 'true' : 'false' }} }" class="">
                        <label for="toggle-who-viewed-gig-view-page" class="inline-flex relative items-center cursor-pointer">
                            <input x-model="whoViewdServiceStatus" wire:model="whoViewdServiceStatus" type="checkbox" value="" id="toggle-who-viewed-gig-view-page" class="sr-only peer" >
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 drk:peer-focus:ring-blue-800 drk:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all drk:border-gray-600 peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-900 drk:text-gray-300">Disable Setting</span>
                        </label>
                    </div>
                </div>

                <div class="grid gap-3 mb-6 md:grid-cols-2 lg:grid-cols-3">
                    <div class="">
                        <x-AdminPanel.form.label>Seller rating should be greater than or equals
                        </x-AdminPanel.form.label>

                        <x-AdminPanel.form.select wire:model="sellerRatingForAlsoViewOnGigView"
                            name="sellerRatingForAlsoViewOnGigView">
                            @foreach ($optionValues as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </x-AdminPanel.form.select>

                        @error('sellerRatingForAlsoViewOnGigView')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Service rating should be greater than equals</x-AdminPanel.form.label>

                        <x-AdminPanel.form.select wire:model="gigRatingForAlsoViewOnGigView"
                            name="gigRatingForAlsoViewOnGigView">
                            @foreach ($optionValues as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </x-AdminPanel.form.select>

                        @error('gigRatingForAlsoViewOnGigView')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Service total orders must be</x-AdminPanel.form.label>

                        <x-AdminPanel.form.select wire:model="gigOrdersForAlsoViewOnGigView"
                            name="gigOrdersForAlsoViewOnGigView">
                            @foreach ($optionValues as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </x-AdminPanel.form.select>

                        @error('gigOrdersForAlsoViewOnGigView')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Seller total orders completed must be greater than
                        </x-AdminPanel.form.label>

                        <x-AdminPanel.form.input wire:model="sellerOrdersForAlsoViewOnGigView"
                            name="sellerOrdersForAlsoViewOnGigView" type="number" min="1" />

                        @error('sellerOrdersForAlsoViewOnGigView')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Seller registration date should be greater than
                        </x-AdminPanel.form.label>

                        <x-AdminPanel.form.input wire:model="sellerRegDateForAlsoViewOnGigView"
                            name="sellerRegDateForAlsoViewOnGigView" type="date" />

                        @error('sellerRegDateForAlsoViewOnGigView')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Service add date should be greater than</x-AdminPanel.form.label>

                        <x-AdminPanel.form.input wire:model="gigAddDateForAlsoViewOnGigView"
                            name="gigAddDateForAlsoViewOnGigView" type="date" />

                        @error('gigAddDateForAlsoViewOnGigView')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Limit to show services</x-AdminPanel.form.label>

                        <x-AdminPanel.form.input wire:model="limitForAlsoViewOnGigView" name="limitForAlsoViewOnGigView"
                            type="number" min="4" />

                        @error('limitForAlsoViewOnGigView')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror

                    </div>
                </div>

                {{-- Criteria section for Our Freelancers In Gig View Page --}}
                <div class="flex justify-between">
                    <h1 class="mb-3 mt-6">Criteria for our freelancers on service view page</h1>

                    <div x-data="{ ourFreelancersGWPStatus: {{ $ourFreelancersGWPStatus == 1 ? 'true' : 'false' }} }" class="">
                        <label for="toggle-our-freelancers-gig-view-page" class="inline-flex relative items-center cursor-pointer">
                            <input x-model="ourFreelancersGWPStatus" wire:model="ourFreelancersGWPStatus" type="checkbox" value="" id="toggle-our-freelancers-gig-view-page" class="sr-only peer" >
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 drk:peer-focus:ring-blue-800 drk:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all drk:border-gray-600 peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-900 drk:text-gray-300">Disable Setting</span>
                        </label>
                    </div>
                </div>

                <div class="grid gap-3 mb-6 md:grid-cols-2 lg:grid-cols-3">
                    <div class="">
                        <x-AdminPanel.form.label>Seller rating should be greater than or equals
                        </x-AdminPanel.form.label>

                        <x-AdminPanel.form.select wire:model="sellerRatingForOurFreelancersOnGigView"
                            name="sellerRatingForOurFreelancersOnGigView">
                            @foreach ($optionValues as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </x-AdminPanel.form.select>

                        @error('sellerRatingForOurFreelancersOnGigView')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Seller total orders completed must be greater than
                        </x-AdminPanel.form.label>

                        <x-AdminPanel.form.input wire:model="sellerOrdersForOurFreelancersOnGigView"
                            name="sellerOrdersForOurFreelancersOnGigView" type="number" min="1" />

                        @error('sellerOrdersForOurFreelancersOnGigView')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Seller registration date should be greater than
                        </x-AdminPanel.form.label>

                        <x-AdminPanel.form.input wire:model="sellerRegDateForOurFreelancersOnGigView"
                            name="sellerRegDateForOurFreelancersOnGigView" type="date" />

                        @error('sellerRegDateForOurFreelancersOnGigView')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Limit to show freelancers</x-AdminPanel.form.label>

                        <x-AdminPanel.form.input wire:model="limitForOurFreelancersOnGigView"
                            name="limitForOurFreelancersOnGigView" type="number" min="4" />

                        @error('limitForOurFreelancersOnGigView')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Criteria section for Our Freelancers In Gig View Page --}}
                <div class="flex justify-between">
                    <h1 class="mb-3 mt-6">Criteria for our freelancers on home page</h1>

                    <div x-data="{ ourFreelancersHomePageStatus: {{ $ourFreelancersHomePageStatus == 1 ? 'true' : 'false' }} }" class="">
                        <label for="toggle-our-freelancers-home-page" class="inline-flex relative items-center cursor-pointer">
                            <input x-model="ourFreelancersHomePageStatus" wire:model="ourFreelancersHomePageStatus" type="checkbox" value="" id="toggle-our-freelancers-home-page" class="sr-only peer" >
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 drk:peer-focus:ring-blue-800 drk:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all drk:border-gray-600 peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-900 drk:text-gray-300">Disable Setting</span>
                        </label>
                    </div>
                </div>

                <div class="grid gap-3 mb-6 md:grid-cols-2 lg:grid-cols-3">
                    <div class="">
                        <x-AdminPanel.form.label>Seller rating should be greater than or equals
                        </x-AdminPanel.form.label>

                        <x-AdminPanel.form.select wire:model="sellerRatingForOurFreelancersOnHome"
                            name="sellerRatingForOurFreelancersOnHome">
                            @foreach ($optionValues as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </x-AdminPanel.form.select>

                        @error('sellerRatingForOurFreelancersOnHome')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Seller total orders completed must be greater than
                        </x-AdminPanel.form.label>

                        <x-AdminPanel.form.input wire:model="sellerOrdersForOurFreelancersOnHome"
                            name="sellerOrdersForOurFreelancersOnHome" type="number" min="1" />

                        @error('sellerOrdersForOurFreelancersOnHome')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Seller registration date should be greater than
                        </x-AdminPanel.form.label>

                        <x-AdminPanel.form.input wire:model="sellerRegDateForOurFreelancersOnHome"
                            name="sellerRegDateForOurFreelancersOnHome" type="date" />

                        @error('sellerRegDateForOurFreelancersOnHome')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Limit to show freelancers</x-AdminPanel.form.label>

                        <x-AdminPanel.form.input wire:model="limitForOurFreelancersOnHome"
                            name="limitForOurFreelancersOnHome" type="number" min="4" />

                        @error('limitForOurFreelancersOnHome')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Criteria section for Popular Professional Services In Home Page --}}
                <div class="flex justify-between">
                    <h1 class="mb-3 mt-6">Criteria for Popular professional services for home page</h1>

                    <div x-data="{ popularProServicesHomePageStatus: {{ $popularProServicesHomePageStatus == 1 ? 'true' : 'false' }} }" class="">
                        <label for="toggle-pro-services-home-page" class="inline-flex relative items-center cursor-pointer">
                            <input x-model="popularProServicesHomePageStatus" wire:model="popularProServicesHomePageStatus" type="checkbox" value="" id="toggle-pro-services-home-page" class="sr-only peer" >
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 drk:peer-focus:ring-blue-800 drk:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all drk:border-gray-600 peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-900 drk:text-gray-300">Disable Setting</span>
                        </label>
                    </div>
                </div>

                <div class="grid gap-3 mb-6 md:grid-cols-2 lg:grid-cols-3">
                    <div class="">
                        <x-AdminPanel.form.label>Seller rating should be greater than or equals
                        </x-AdminPanel.form.label>

                        <x-AdminPanel.form.select wire:model="sellerRatingForPopularServicesHome"
                            name="sellerRatingForPopularServicesHome">
                            @foreach ($optionValues as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </x-AdminPanel.form.select>
                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Service rating should be greater than equals</x-AdminPanel.form.label>

                        <x-AdminPanel.form.select wire:model="gigRatingForPopularServicesHome"
                            name="gigRatingForPopularServicesHome">
                            @foreach ($optionValues as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </x-AdminPanel.form.select>
                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Service total orders must be</x-AdminPanel.form.label>

                        <x-AdminPanel.form.select wire:model="gigOrdersForPopularServicesHome"
                            name="gigOrdersForPopularServicesHome">
                            @foreach ($optionValues as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </x-AdminPanel.form.select>
                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Seller total orders completed must be greater than
                        </x-AdminPanel.form.label>

                        <x-AdminPanel.form.input wire:model="sellerOrdersForPopularServicesHome"
                            name="sellerOrdersForPopularServicesHome" type="number" min="1" />

                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Seller registration date should be greater than
                        </x-AdminPanel.form.label>

                        <x-AdminPanel.form.input wire:model="sellerRegDateForPopularServicesHome"
                            name="sellerRegDateForPopularServicesHome" type="date" />

                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Service add date should be greater than</x-AdminPanel.form.label>

                        <x-AdminPanel.form.input wire:model="gigAddDateForPopularServicesHome"
                            name="gigAddDateForPopularServicesHome" type="date" />

                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Limit to show services</x-AdminPanel.form.label>

                        <x-AdminPanel.form.input wire:model="limitForPopularServicesHome"
                            name="limitForPopularServicesHome" type="number" min="4" />

                    </div>
                </div>
                <x-AdminPanel.button type="submit">Save</x-AdminPanel.button>
            </form>
        </div>
    </div>
</div>
