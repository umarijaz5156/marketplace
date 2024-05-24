<div>
    @if(session()->has('message'))

    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 60000)" id="alert-border-3"
        class=" flex p-4 mb-4 bg-green-100 border-t-4 border-green-500 drk:bg-green-200" role="alert">
        <svg class="flex-shrink-0 w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                clip-rule="evenodd"></path>
        </svg>
        <div class="ml-3 text-sm font-medium text-green-700">
            {{ session('message') }}
        </div>

    </div>

    @endif
    <form wire:submit.prevent="submit" class="space-y-4">
        <div>
          <label class="sr-only" for="name">Name</label>
          <input wire:model="name"
            class="w-full rounded-lg border-gray-200 p-3 text-sm"
            placeholder="Name"
            type="text"
            id="name"
          />
          @error('name')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
        </div>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
          <div>
            <label class="sr-only" for="email">Email</label>
            <input wire:model="email"
              class="w-full rounded-lg border-gray-200 p-3 text-sm"
              placeholder="Email address"
              type="email"
              id="email"
            />
            @error('email')
            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
        @enderror
          </div>

          <div>
            <label class="sr-only" for="phone">Phone</label>
            <input wire:model="phone"
              class="w-full rounded-lg border-gray-200 p-3 text-sm"
              placeholder="Phone Number"
              type="tel"
              id="phone"
            />
            @error('phone')
            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
        @enderror
          </div>
        </div>

        <div>
          <label class="sr-only" for="message">Message</label>
          <textarea wire:model="message"
            class="w-full rounded-lg border-gray-200 p-3 text-sm"
            placeholder="Message"
            rows="8"
            id="message"
          ></textarea>
             @error('message')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
        </div>

        <div class="mt-4">
          <button
            type="submit"
            class="inline-flex w-full items-center justify-center rounded-lg bg-black px-5 py-3 text-white sm:w-auto"
          >
            <span class="font-medium"> Send Enquiry </span>

            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="ml-3 h-5 w-5"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M14 5l7 7m0 0l-7 7m7-7H3"
              />
            </svg>
          </button>
        </div>
      </form>
</div>
