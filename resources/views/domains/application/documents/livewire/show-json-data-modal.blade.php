<flux:modal class="min-w-[28rem] max-w-[50%] space-y-6" name="show-json-data-modal" wire:model="currentDocument" variant="flyout">
    <div>
        <flux:heading level="1" size="xl">{{ $currentDocument?->name }}</flux:heading>

        <flux:subheading>
            <p class="mb-2">Data from the document transformed to JSON, for easier interpretation by LLM.</p>
        </flux:subheading>
    </div>

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
