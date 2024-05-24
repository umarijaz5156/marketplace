<div>
    <h2 id="accordion-collapse-heading-3">
        <button type="button"
            class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 drk:focus:ring-gray-800 drk:border-gray-700 drk:text-gray-400 hover:bg-gray-100 drk:hover:bg-gray-800"
            data-accordion-target="#accordion-collapse-revenue-configs" aria-expanded="false"
            aria-controls="accordion-collapse-revenue-configs">
            <span>Revenue Configuration</span>
            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
    </h2>
    <div wire:ignore.self id="accordion-collapse-revenue-configs" class="hidden" aria-labelledby="accordion-collapse-heading-3">
        <div class="p-5 border border-b-0 border-gray-200 drk:border-gray-700 drk:bg-gray-900">

            <form wire:submit.prevent="updateRevenueSettings" enctype="multipart/form-data">
                @csrf

                <div class="grid gap-3 mb-6 md:grid-cols-2 lg:grid-cols-3">
                    <div class="">
                        <x-AdminPanel.form.label>Commission percentage</x-AdminPanel.form.label>

                        <x-AdminPanel.form.input wire:model="comissionPercentage" name="comission_percentage"
                            type="number" min="1" />
                    </div>

                    <div class="">
                        <x-AdminPanel.form.label>Refund commission percentage</x-AdminPanel.form.label>

                        <x-AdminPanel.form.input wire:model="refundComissionPercentage" name="refund_comission_percentage"
                            type="number" min="1" />
                    </div>
                </div>

                <x-AdminPanel.button type="submit">Save</x-AdminPanel.button>
            </form>
        </div>
    </div>
</div>
