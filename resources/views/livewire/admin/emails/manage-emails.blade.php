<div class="mx-8">
    <div>
        @if (session('success'))
            <x-alerts.success :success="session('success')" />
        @endif

        @if (session('error'))
            <x-alerts.error :error="session('error')" />
        @endif
    </div>

    <div class="flex justify-between my-6">
        <x-AdminPanel.button wire:click="showModal('addEmailTemplateModal')" id="addNewEmailTemplate" class="h-10"
            data-modal-toggle="addEmailTemplate"> Add New Email Template </x-AdminPanel.button>
    </div>

    <div class="flex-auto px-0 pt-0 pb-2">
        <div class="p-0 overflow-x-auto">
            <x-AdminPanel.table>
                <x-AdminPanel.table.thead>
                    <tr>
                        <th
                            class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                <button type="button">Subject</button>
                            </div>
                        </th>
                        <th
                            class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                <button type="button">Email Template For</button>
                            </div>
                        </th>
                        <th
                            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            <div class="flex items-center">
                                <button type="button">Date</button>
                            </div>
                        </th>
                        <th
                            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            View/Edit
                        </th>
                        <th
                            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                            Action
                        </th>
                    </tr>
                </x-AdminPanel.table.thead>
                <tbody>
                    @forelse ($templates as $template)
                        <tr>
                            <x-AdminPanel.table.cell>
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 leading-normal text-sm">{{ $template->subject }}</h6>
                                    </div>
                                </div>
                            </x-AdminPanel.table.cell>
                            <x-AdminPanel.table.cell>
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 leading-normal text-sm">{{ $template->type }}</h6>
                                    </div>
                                </div>
                            </x-AdminPanel.table.cell>
                            <x-AdminPanel.table.cell>
                                <div class="flex px-2 py-1">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 leading-normal text-sm">{{ $template->created_at }}
                                        </h6>
                                    </div>
                                </div>
                            </x-AdminPanel.table.cell>
                            <x-AdminPanel.table.cell>
                                <button wire:click="showEditModal({{ $template->id }})"
                                    class="bg-blue-500 text-white text-xs py-2 px-4 rounded-full"
                                    data-modal-toggle="updateEmailTemplate">
                                    View/Edit
                                </button>
                            </x-AdminPanel.table.cell>
                            <x-AdminPanel.table.cell>
                                <button wire:click="deleteEmailTemplate({{ $template->id }})"
                                    class="bg-red-500 text-white text-xs py-2 px-4 rounded-full">
                                    Delete
                                </button>
                            </x-AdminPanel.table.cell>
                        </tr>
                    @empty
                        <tr>
                            <td class="py-4 px-6 text-center" colspan="5">
                                No Record Found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </x-AdminPanel.table>
        </div>
        <div class="px-3 py-2">
            {{ $templates->links('vendor.livewire.custom-pagination') }}
        </div>
    </div>

    {{-- Add new Email Template Modal --}}
    <x-Modals.modal modalId="addEmailTemplateModal" title="Add New Template">
        @slot('content')
            <form class="space-y-6" wire:submit.prevent="createTemplate">
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <x-AdminPanel.form.label>Email Subject</x-AdminPanel.form.label>

                        <x-AdminPanel.form.input wire:model.debounce.500ms="subject" placeholder="Enter Email Subject" />
                        @error('subject')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="parent_id"
                            class="block mb-2 text-sm font-medium text-gray-900 drk:text-gray-300">Template For</label>
                        <select wire:model="templateType" name="templateType"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 drk:bg-gray-600 drk:border-gray-500 drk:placeholder-gray-400 drk:text-white">

                            <option value="">Choose...</option>
                            @foreach (App\Enums\EmailTemplateType::cases() as $type)
                                <option value="{{ $type->value }}">{{ $type->value }}</option>
                            @endforeach
                        </select>
                        @error('templateType')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    @error('body')
                        <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div wire:ignore class="">
                    <x-AdminPanel.form.textbox wire:model="body" class="ckeditor" id="ckeditor1" placeholder="">
                    </x-AdminPanel.form.textbox>
                    <span><strong>Use these replacement variables (double curly braces are necessary):</strong><br>@{{seller}}, @{{user}}, @{{service}}, @{{order_amount}}, @{{order_id}}, @{{ticket_status}}</span>
                </div>

                <x-AdminPanel.button type="submit">Submit</x-AdminPanel.button>
            </form>
        @endslot
    </x-Modals.modal>

    {{-- Update Ematil Template Modal --}}
    <x-Modals.modal modalId="updateEmailTemplateModal" title="Update Template">
        @slot('content')
            <form wire:submit.prevent="updateEmailTemplate">
                <div class="mx-8 mt-8">
                    <div class="">
                        <x-AdminPanel.form.label>Subject</x-AdminPanel.form.label>
                        <x-AdminPanel.form.input wire:model.debounce.500ms="subject" />
                        @error('subject')
                            <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div wire:ignore class="my-4">
                        <x-AdminPanel.form.label>Body</x-AdminPanel.form.label>
                        <x-AdminPanel.form.textbox wire:model="body" rows="10" class="ckeditor" id="ckeditor"
                            placeholder="">
                        </x-AdminPanel.form.textbox>
                        <span><strong>Use these replacement variables (double curly braces are necessary):</strong><br>@{{seller}}, @{{user}}, @{{email}}, @{{service}}, @{{order_amount}}, @{{order_id}}, @{{ticket_status}}</span>
                    </div>
                    @error('body')
                        <div class="text-xs text-red-500 mt-1">{{ $message }}</div>
                    @enderror

                    <x-AdminPanel.button type="submit">Update</x-AdminPanel.button>
                </div>
            </form>
        @endslot
    </x-Modals.modal>

    {{-- Delete Confirmation Modal --}}
    <x-Modals.delete-confirm-modal message="You are going to delete email template" />
</div>

@push('scripts')
    <script>
        const editor = CKEDITOR.replace('ckeditor');
        editor.on('change', function(event) {
            // console.log(event.editor.getData())
            @this.set('body', event.editor.getData());
        })

        window.addEventListener('updateCkEditorBody', event => {
            // setTimeout(() => {
            let changedVal = @this.get('body');
            // console.log(changedVal)
            editor.setData(changedVal)
            // }, 1000);
        })
    </script>

    <script>
        const editor1 = CKEDITOR.replace('ckeditor1');
        editor1.on('change', function(event) {
            // console.log(event.editor.getData())
            @this.set('body', event.editor.getData());
        })

        $('#addNewEmailTemplate').on('click', function() {
            editor1.setData('')
        })
    </script>

    <script>
        const scrollToBottom = (id) => {
            const element = document.getElementById(id);
            element.scrollTop = element.scrollHeight;
        }
        window.addEventListener('modalClose', event => {
            if (@this.get('checkModal') === 'update') {
                $("#close-updateEmailTemplate").click();
            } else if (@this.get('checkModal') === 'create') {
                $("#close-addEmailTemplate").click();
            }
        })
    </script>
@endpush
