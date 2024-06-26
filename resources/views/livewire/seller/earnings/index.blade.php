<div>
    <!-- HeroSection -->

      <!-- HeroSection -->
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
          <!-- Best Earning Money -->
    <div class="mt-[111px]">
       <livewire:seller.earnings.best-earning/>
    </div>
    <!-- Best Earning Money -->

    <!-- WithDrawn Methods -->
    <div class="relative">
       <livewire:seller.earnings.withdraw-filters />
    </div>
    <!-- table Section -->
    <div class="mt-[50px] md:mt-[118px]">
       <livewire:seller.earnings.table-section/>
    </div>
    <div class="mt-[50px] md:mt-[118px]">
        <livewire:seller.earnings.withdraws-table />
    </div>
</div>
