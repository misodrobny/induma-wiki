<div class="space-y-10 divide-y divide-gray-900/10">
    <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
        <div class="px-4 sm:px-0">
            <h2 class="text-base/7 font-semibold text-gray-900">{{ __('application.pages.documents.upload.header') }}</h2>
            <p class="mt-1 text-sm/6 text-gray-600">{{ __('application.pages.documents.upload.description') }}</p>
        </div>

        <form wire:submit="save" class="bg-zinc-50 dark:bg-zinc-900 shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <div class="px-4 py-6 sm:p-8">
                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <flux:field>
                            <flux:label class="required">{{ __('application.pages.documents.upload.name') }}</flux:label>

                            <flux:input wire:model.live="name" type="text" name="name" id="name" />

                            <flux:error name="name" />
                        </flux:field>
                    </div>

                    <div class="col-span-full">
                        <label for="cover-photo"
                               class="block text-sm/6 font-medium text-gray-900 required">{{ __('application.pages.documents.upload.document_file') }}</label>
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                <div class="flex">
                                @if($file instanceof Livewire\Features\SupportFileUploads\TemporaryUploadedFile)
                                        <p>{{ $file->getClientOriginalName() }}</p>
                                        <button
                                                type="button"
                                                wire:click="clearFile"
                                                class="ml-2 inline-flex items-center px-1 py-1 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <flux:icon.trash class="size-4"/>
                                        </button>
                                @else
                                    <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                                         data-slot="icon">
                                        <path fill-rule="evenodd"
                                              d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                @endif
                                </div>
                                <div class="mt-4 flex justify-center text-sm/6 text-gray-600">
                                    <label for="file-upload"
                                           class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                        <span>{{ __('application.pages.documents.upload.upload_file_text') }}</span>
                                        <input wire:model.live="file" id="file-upload" name="file-upload" type="file" class="sr-only">
                                    </label>
                                </div>
                                <p class="text-xs/5 text-gray-600">{{ __('application.pages.documents.upload.upload_file_max_size_text') }}</p>
                            </div>
                        </div>
                        <flux:error name="file" />
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                <button type="button" class="text-sm/6 font-semibold text-gray-900">{{ __('global.buttons.cancel') }}</button>
                <button type="submit"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ __('global.buttons.save') }}</button>
            </div>
        </form>
    </div>
</div>
