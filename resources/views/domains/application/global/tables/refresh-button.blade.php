@aware(['component'])

@if ($component->isTailwind())
    <flux:tooltip content="Refresh">
        <flux:button icon-trailing="arrow-path" wire:click="$refresh"></flux:button>
    </flux:tooltip>
@endif