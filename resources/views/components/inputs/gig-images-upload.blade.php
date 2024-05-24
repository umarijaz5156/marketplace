@props(['fileName' => 'image', 'multiple'=> false, 'required' => false, 'type' => 'image'])


<div
    wire:ignore
    x-data = "{pond:null}"
    x-init="



        FilePond.setOptions({
            credits: false,
        });
        pond = FilePond.create($refs.input);
        pond.on('addfile', (error, file) => {
            if (error) {
                @if ($type == 'image')

                Livewire.emitTo('gigs.description','imageError', error);
                @elseif ($type == 'portfolio')
                console.log('portfolio');
                Livewire.emitTo('gigs.description','imageErrorPortfolio', error);
                @endif
                return;
            }

        });

        pond.on('removefile', (error, file) => {

                @if ($type == 'portfolio')

                Livewire.emitTo('gigs.description','removeFile', file.filename);
                @elseif($type == 'image')

                Livewire.emitTo('gigs.description','removeGigImage', file.filename);
                @endif


        });
        pond.setOptions({

            allowMultiple : false,
            maxFiles: 5,

            allowImageValidateSize: {{ $type == 'image' ? 'true' : 'false' }},
            imageValidateSizeMinHeight: 370,
            imageValidateSizeMinWidth: 550,
            allowImagePreview: true,
            imagePreviewHeight: 200,
            acceptedFileTypes: ['image/png', 'image/jpeg', 'video/*'],
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes['wire:model'] }}', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('{{ $attributes['wire:model'] }}', filename, load)
                }
            },
            @if(isset($attributes['previous']))

                files: [
                    {

                        source : '{{ asset($attributes['previous']) }}',

{{--
                        options: {

                            file: {
                                name: '{{ Storage::disk('gigs')->url($attributes['previous'])}}',
                                type: 'image/jpeg'
                            }
                        }, --}}
                    }
                ]
            @endif

        });

    "
>

    <input type="file" x-ref="input" name="{{ $fileName }}">

        @push('scripts')

        <script>
            document.addEventListener('pond:error', (e) => {
                @if ($type == 'image')

                Livewire.emitTo('gigs.description','imageError', e.detail);
                @elseif ($type == 'portfolio')

                Livewire.emitTo('gigs.description','imageErrorPortfolio', e.detail);
                @endif
            //add image listener in component`
            });
            @if($type== 'portfolio')

            document.addEventListener('FilePond:removefile', (e) => {
                Livewire.emitTo('gigs.description','fileRemoved', e.detail);

            });
            @elseif ($type == 'image')
            document.addEventListener('FilePond:removefile', (e) => {
                Livewire.emitTo('gigs.description','fileRemoved', e.detail);

            });
            @endif


            document.addEventListener('FilePond:addfilestart', (e) => {
                Livewire.emitTo('gigs.description', 'disableSubmit', e.detail);
                // add image listener in component
            })

            document.addEventListener('FilePond:preparefile', (e) => {
                Livewire.emitTo('gigs.description', 'enableSubmit', e.detail);
                // add image listener in component
            })

        </script>

        @endpush



</div>
