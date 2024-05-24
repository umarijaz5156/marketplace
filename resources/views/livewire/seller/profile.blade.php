<div class=" mx-auto mb-[2rem] pt-[10rem] sm:px-6 lg:px-8">
    @push('styles')
     @once
        @vite(['resources/css/select2.css'])
     @endonce
    @endpush
    <x-jet-form-section class="mb-20" submit="updateProfileInformation">
        <x-slot name="title">
            {{ __('Profile Information') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Update your seller account\'s profile information.') }}
        </x-slot>
            <x-slot name="form">

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="address1" value="{{ __('Address Line 1') }}" />
                    <x-jet-input x-model="formData.address1" id="address1" type="text" class="mt-1 block w-full" wire:model.defer="address1" autocomplete="address1" />
                    <x-jet-input-error for="address1" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="address2" value="{{ __('Address Line 2') }}" />
                    <x-jet-input x-model="formData.address2" id="address2" type="text" class="mt-1 block w-full" wire:model.defer="address2" autocomplete="address2" />
                    <x-jet-input-error for="address2" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="phone" value="{{ __('Phone') }}" />
                    <x-jet-input x-model="formData.phone" id="phone" type="text" class="mt-1 block w-full" wire:model.defer="phoneNumber" autocomplete="phone" placeholder="+xxxxxxxxxx" />
                    <x-jet-input-error for="phoneNumber" class="mt-2" />
                </div>

                <div class="col-span-8 sm:col-span-4">
                    <x-jet-label for="description" value="{{ __('About') }}" />
                    <textarea x-model="formData.description" wire:model.defer="description" id="description" rows="4"
                        class="block p-2.5 w-full text-sm  rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500"
                        placeholder="Write about yourself here..."></textarea>
                    {{--
                    <x-jet-input id="description" type="text" class="mt-1 block w-full" wire:model.defer="description"
                        autocomplete="description" /> --}}
                    <x-jet-input-error for="description" class="mt-2" />
                </div>

                <div wire:ignore class="col-span-8 sm:col-span-4">
                    <x-jet-label for="skills" value="{{ __('Skills') }}" />
                    <x-AdminPanel.form.select x-model="formData.skills" wire:model="selectSkills"
                    name="skills[]" multiple class="select2"
                    id="skills">
                        @if($skills)
                            @foreach ($skills as $skill)
                                <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                            @endforeach
                        @endif
                    </x-AdminPanel.form.select>

                    <x-jet-input-error for="description" class="mt-2" />
                </div>



                {{-- <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="formData.email" />
                    <x-jet-input-error for="email" class="mt-2" />

                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && !
                    $this->user->hasVerifiedEmail())
                    <p class="text-sm mt-2">
                        {{ __('Your email address is unverified.') }}

                        <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900"
                            wire:click.prevent="sendEmailVerification">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if ($this->verificationLinkSent)
                    <p v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                    @endif
                    @endif
                </div> --}}

                {{-- set payment method --}}
                 <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="formData.email" />
                    <x-jet-input-error for="email" class="mt-2" />


                </div>
            </x-slot>

        <x-slot name="actions">
            @if(session()->has('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="text-sm text-gray-600 mr-3">
                    Saved.
                </div>
            @endif

            <x-jet-button wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>

    @livewire('user-verification')
    @push('scripts')
        {{-- select2 jquery plugin --}}
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select multiple options    ",
                multiple: true,
                // allowClear: true,
            });

            $('#skills').on('change', function(e) {
                let data = $('#skills').select2("val");
                @this.set('selectSkills', data);
            });
        });
        </script>
    @endpush
</div>
