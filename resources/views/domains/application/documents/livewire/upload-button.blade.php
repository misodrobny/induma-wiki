@aware(['component'])

@if ($component->isTailwind())
    <flux:button.group>
        <flux:tooltip content="{{ __('global.menu.batch_upload') }}">
            <flux:button icon-trailing="arrow-up-on-square-stack" variant="danger" :loading="true"
                         href="{{ route('application.document.batch-upload') }}"></flux:button>
        </flux:tooltip>
        <flux:tooltip content="{{ __('global.menu.upload') }}">
            <flux:button icon-trailing="arrow-up-tray" variant="primary" :loading="true"
                         href="{{ route('application.document.upload') }}"></flux:button>
        </flux:tooltip>
        <flux:tooltip content="{{ __('global.menu.process_for_llm') }}">
            <flux:button icon-trailing="cloud-arrow-up" variant="filled" :loading="true" wire:click="startPreProcessForALlDocuments()"></flux:button>
        </flux:tooltip>
    </flux:button.group>
@endif

