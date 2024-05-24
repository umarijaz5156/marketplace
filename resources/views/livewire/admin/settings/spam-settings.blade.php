<div>
    <h2 id="accordion-collapse-heading-5">
        <button type="button"
            class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 drk:focus:ring-gray-800 drk:border-gray-700 drk:text-gray-400 hover:bg-gray-100 drk:hover:bg-gray-800"
            data-accordion-target="#accordion-collapse-spam-configs" aria-expanded="false"
            aria-controls="accordion-collapse-spam-configs">
            <span>Spam Configuration</span>
            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
    </h2>
    <div wire:ignore.self id="accordion-collapse-spam-configs" class="hidden" aria-labelledby="accordion-collapse-heading-5">
        <div class="p-5 border border-b-0 border-gray-200 drk:border-gray-700 drk:bg-gray-900">

            <form >
                @csrf
                <div wire:ignore class="grid gap-3 mb-6 md:grid-cols-2 lg:grid-cols-3">

                        <x-AdminPanel.form.label>Detect Keywords as Spam</x-AdminPanel.form.label>
                                <select  id='spam' name="spam[]"
                                multiple
                                class="bg-white !border-[#E7EFFF] text-gray-900 text-sm rounded-md focus:ring-1 focus:ring-[#0096D8] focus:border-[#0096D8]  block w-full  focus:outline-none"
                            >
                            @if($keywords)
                                @foreach ($keywords as $keyword)
                                    <option selected value="{{ $keyword }}">{{ $keyword }}</option>
                                 @endforeach
                            @endif
                            </select>
                </div>

ap

            </select>
                {{-- <x-AdminPanel.button type="submit">Save</x-AdminPanel.button> --}}
            </form>
        </div>
    </div>
@push('scripts')
<script>


    var $select = $('#spam').selectize({
        create          : true,
        onChange(value){
            Livewire.emit('spamUpdated', value)
        }
    });
</script>
@endpush
</div>
