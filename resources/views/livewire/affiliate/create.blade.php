<x-jet-form-section submit="updateAffiInformation">
    <x-slot name="title">
        {{ __('Affiliate') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Click become affiliate to join Pushiii affiliate program') }}
    </x-slot>

    <x-slot name="form">


        @if($isAffiliate)

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for=link" value="{{ __('Affiliate Link') }}" />
                    <x-jet-input id="link" type="text" class="mt-1 block w-full" autocomplete="name" wire:model='link' disabled/>

                </div>
                <div class="text-2xl  cursor-pointer my-auto items-center">
                 <i  onclick="copyToClipboard()" class="fa-light fa-clipboard"></i>
                </div>
        @endif

    </x-slot>

    <x-slot name="actions">
        @if(!$isAffiliate)
        <button type="button" wire:click='becomeAffiliate' class='inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition'>
            Become Affiliate
        </button>
        @endif

    </x-slot>
    @push('scripts')
    <script>
        // function copyToClipboard() {
        //     var text = document.getElementById('link').value;
        //     navigator.clipboard.writeText(text)

        //   }
          function copyToClipboard() {
            // var text = document.getElementById('myDiv').innerText;
            var text = document.getElementById('link').value;
            navigator.permissions.query({
                name: "clipboard-write"
            }).then((result) => {
                if (result.state == "granted" || result.state == "prompt") {
                    // alert('Write access granted')
                    navigator.clipboard.writeText(text)
                        .then(function() {
                            // showTooltip();
                        })
                        .catch(function(err) {
                            console.error('Failed to copy text: ', err);
                        });
                } else {
                    // alert("not granted")
                    const textarea = document.createElement('textarea');
                    textarea.value = text;
                    // Move the textarea outside the viewport to make it invisible
                    textarea.style.position = 'absolute';
                    textarea.style.left = '-99999999px';
                    document.body.prepend(textarea);
                    // highlight the content of the textarea element
                    textarea.select();
                    try {
                        document.execCommand('copy')
                    } catch (error) {
                        console.error('Failed to copy text: ', err);
                    } finally {
                        textarea.remove();
                    }
                }
            })
        }
          </script>
    @endpush

</x-jet-form-section>
