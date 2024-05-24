<div x-data="{ show: @entangle('show') }">
    <div wire:loading wire:target.delay='attachments'>
        <div id="loader-overlay"
            class="z-10  inset-0 absolute flex items-center justify-center bg-gray-200 opacity-75">
            <!-- Use your loader component or an animated spinner here -->
            <div class="w-16 h-16 border-t-4 border-blue-500 border-solid rounded-full animate-spin"></div>
        </div>
    </div>

    <div class="w-full sticky bottom-0 py-[15px] bg-white" x-show="show">
        <form wire:submit.prevent='sendMessage'>


            <div class="relative flex items-center w-[95%] mx-auto rounded p-[5px_5px_5px_15px] bg-white border border-[#E2EAED]">
                @if($uploading)
                    <progress  class="w-full h-2 absolute top-0 left-0" max="100" value="{{ $uploadProgress }}" ></progress>
                @endif

                <div class="flex items-center justify-between text-xl relative">

                    <label for="attachments"
                        class="flex items-center space-x-2 cursor-pointer bg-transparent text-[#0096D8] py-1 rounded-md">
                        <i class="fa fa-paperclip"></i>
                        @if (count($attachments) > 0)
                            <div class="flex justify-center align-items-center relative">
                                <div
                                    class="bg-[#E9711C] text-gray-200 text-sm inline-flex absolute bottom-[3px] right-[-8px] w-6 h-6 pl-1.5 rounded-full border-2 border-white">
                                    {{ count($attachments) }}</div>
                            </div>
                        @endif
                    </label>
                    <input wire:model="attachments" id="attachments" type="file" multiple class="hidden" accept="{{ $allowedFileTypes }}" />
                </div>

                <input maxlength=20000"  wire:model.defer="body"
                    class="border-none text-[#273346] bg-transparent p-3 text-base w-full outline-none focus:ring-0"
                    type="text" placeholder="Type Something Here....">
                <div class="flex gap-x-2 mr-1 text-[#0096D8]">

                    <button type="submit" class="mr-2" {{-- class="w-[36px]  h-[36px] text-lg bg-[#7c9f57]  rounded-full" --}}>
                        {{-- <i class="fa fa-send fa-2x" aria-hidden="true"></i> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-send">
                            <line x1="22" y1="2" x2="11" y2="13"></line>
                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                        </svg>
                    </button>
                </div>

            </div>
            @if($errors->has('attachments.*') || $errors->has('attachments') || $errors->has('attachments.*.size'))
            {{-- @error('error') --}}
            <div x-data="{ showError: true }" x-show="showError" x-init="setTimeout(() => { Livewire.emit('timeoutReached'); document.getElementById('alert-border-2').remove(); }, 4000)" id="alert-border-2" class=" items-center w-[95%] mx-auto text-red-500">{{ $errors->first() }}</p>
            @endif
            @if($errors->has('body'))
            <div x-data="{ showError: true }" x-show="showError" x-init="setTimeout(() => { Livewire.emit('timeoutReached'); document.getElementById('alert-border-2').remove(); }, 4000)" id="alert-border-2" class=" items-center w-[95%] mx-auto text-red-500">{{ $errors->first('body') }}</p>
            @endif
            @error('error')
            <div x-data="{ showError: true }" x-show="showError" x-init="setTimeout(() => { Livewire.emit('timeoutReached'); document.getElementById('alert-border-2').remove(); }, 4000)" id="alert-border-2" class=" items-center w-[95%] mx-auto text-red-500">{{ $message}}</p>
            @enderror

        </form>
        <p class="items-center w-[95%] mx-auto text-gray-500">  Files should not be greater than 5 MB,You may upload (pdf,doc,png,jpeg,gif,txt,zip) only </p>
        <p class="items-center w-[95%] mx-auto text-red-500">  It is prohibited to divert discussions from the platform or exchange contact information. </p>
    </div>

    <script>
        document.addEventListener('livewire-upload-progress', event => {

            // setTimeout(() => {
            @this.set('uploadProgress', event.detail.progress);
        // }, 3000);
        });

        // document.addEventListener('livewire-upload-finish', () => {
        //     @this.set('uploading', false);
        // });
    </script>
    <script>
      window.addEventListener('swal',function(e){
            Swal.fire(e.detail);
        });
    </script>
</div>
