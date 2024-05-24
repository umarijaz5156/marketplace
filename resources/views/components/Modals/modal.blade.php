@props(['modalId' => 'viewingModal', 'title' => 'Modal'])
<x-jet-dialog-modal wire:model="{{ $modalId }}" >
    <x-slot name="title">
        <button
            wire:click="closeModal('{{ $modalId }}')"
            type="button"
            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center drk:hover:bg-gray-800 drk:hover:text-white"
        >
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close modal</span>
        </button>
        {{ $title }}
    </x-slot>

    <x-slot name="content" >
        {{ $content }}
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeModal('{{ $modalId }}')" wire:loading.attr="disabled">
            @lang('Close')
        </x-jet-secondary-button>
    </x-slot>
</x-jet-dialog-modal>
