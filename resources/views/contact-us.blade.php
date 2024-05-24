<x-app-layout>

<section class="bg-gray-100">
    <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 gap-x-16 gap-y-8 lg:grid-cols-5">
        <div class="lg:col-span-2 lg:py-12">
          <p class="max-w-xl text-lg">
            When you place an order and you have an issue with the seller. We offer a powerful dispute management and tickets system to resolve your
            disputes as quick as possible. If you have any other query related to TheHotBleep and how it works feel free to send us a message and we will
            get back to you at the earliest.
          </p>

          <div class="mt-8">
            {{-- <a href="" class="text-2xl font-bold text-pink-600">
              0151 475 4450
            </a>

            <address class="mt-2 not-italic">
              282 Kevin Brook, Imogeneborough, CA 58517
            </address> --}}
          </div>
        </div>

        <div class="rounded-lg bg-white p-8 shadow-lg lg:col-span-3 lg:p-12">
         <livewire:contact-us-form/>
        </div>
      </div>
    </div>
  </section>
</x-app-layout>
