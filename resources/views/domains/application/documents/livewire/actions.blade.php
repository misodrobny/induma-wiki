@if($item->json_data === null)
    <flux:tooltip content="Process data for LLM">
        <flux:button variant="danger" size="xs" icon-trailing="arrow-path-rounded-square" wire:click="processDataForLLM({{$item->id}})"></flux:button>
    </flux:tooltip>
@endif