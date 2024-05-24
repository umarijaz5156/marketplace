@props(['fileName' => 'image', 'multiple'=> false])

<div
    wire:ignore
    x-data="{pond:null}"
    x-init="
        FilePond.setOptions({
            credits: false,
        });
        pond = FilePond.create($refs.input);
        pond.setOptions({
            {{-- allowMultiple: {{ isset($attributes['multiple']) ? 'true' : 'false' }}, --}}
            allowMultiple : {{ $multiple ? 'true' : 'false' }},
            maxFiles: 5,
            credits: false,
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes['wire:model'] }}', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('{{ $attributes['wire:model'] }}', filename, load)
                }
            },
        });
    "
>
    <input type="file" x-ref="input" name="{{ $fileName }}{{ $multiple ? '[]' : '' }}">
</div>
