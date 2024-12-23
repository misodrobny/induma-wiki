@aware(['component'])

@if ($component->isTailwind())
    <flux:tooltip content="{{ __('global.refresh') }}">
        <flux:button icon-trailing="arrow-path" wire:click="$refresh"></flux:button>
    </flux:tooltip>
@endif