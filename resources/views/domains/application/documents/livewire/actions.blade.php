@if($item->json_data === null && $item->llama_cloud_id === null && $item->llama_cloud_status === null)
    <flux:tooltip content="{{ __('application.pages.documents.actions.process_data') }}">
        <flux:button variant="danger" size="xs" icon-trailing="arrow-up-tray" wire:click="processDataForLLM({{$item->id}})"></flux:button>
    </flux:tooltip>
@endif
@if($item->json_data === null && $item->llama_cloud_id !== null &&
($item->llama_cloud_status === \App\Domains\Application\Documents\Enums\LlamaCloud\LlamaDocumentStatusEnum::PENDING))
    <flux:tooltip content="{{ __('application.pages.documents.actions.sync') }}">
        <flux:button variant="primary" size="xs" icon-trailing="arrow-path-rounded-square"
                     wire:click="syncDocumentStatus({{$item->id}})"></flux:button>
    </flux:tooltip>
@endif
@if($item->json_data !== null)
    <flux:tooltip content="{{ __('application.pages.documents.actions.show_json_data') }}">
        <flux:button size="xs" icon-trailing="eye" wire:click="viewJsonDataForModel({{$item->id}})"></flux:button>
    </flux:tooltip>
@endif