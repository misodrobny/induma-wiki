<flux:modal class="min-w-[28rem] max-w-[50%] space-y-6" name="show-json-data-modal" wire:model="currentDocument" variant="flyout">
    <div>
        <flux:heading level="1" size="xl">{{ $currentDocument?->name }}</flux:heading>

        <flux:subheading>
            <p class="mb-2">{{ __('application.pages.documents.modals.show_json.description') }}</p>
        </flux:subheading>
    </div>

    @if($currentDocument)
    <flux:tooltip content="{{ __('application.pages.documents.actions.download_json') }}">
        <flux:button class="mt-2" size="xs" icon-trailing="arrow-down-tray" variant="primary" href="{{ route('application.document.download', ['id' => $currentDocument?->id]) }}">{{ __('application.pages.documents.actions.download_json') }}</flux:button>
    </flux:tooltip>
    @endif

    <flux:separator/>

    <andypf-json-viewer
            data="{{ route('get-json-data', [
    'id' => $currentDocument?->id
]) }}"
            indent="2"
            expanded="true"
            theme="default-light"
            show-data-types="true"
            show-toolbar="true"
            expand-icon-type="square"
            show-copy="true"
            show-size="true"
    ></andypf-json-viewer>
</flux:modal>
