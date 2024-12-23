<?php

namespace App\Domains\Application\Documents\Livewire;

use App\Domains\Application\Documents\Events\LLMDataProcessingRunningEvent;
use App\Domains\Application\Documents\Events\LLMDataProcessingTriggeredEvent;
use App\Domains\Application\Documents\Models\Document;
use Exception;
use Flux\Flux;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class DocumentsTable extends DataTableComponent
{
    protected $model = Document::class;

    public ?Document $currentDocument = null;

    public function viewJsonDataForModel($documentId): void
    {
        /** @var Document $document */
        $this->currentDocument = Document::find($documentId);

        Flux::modal('show-json-data-modal')->show();
    }

    public function customView(): string
    {
        return 'domains.application.documents.livewire.show-json-data-modal';
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects([
                'documents.id as id',
                'documents.llama_cloud_id as llama_cloud_id',
                'documents.llama_cloud_status as llama_cloud_status',
            ])
            ->setDefaultSort('created_at', 'desc')
            ->setFilterLayout('slide-down')
            ->setSortingEnabled()
            ->setSortingPillsEnabled()
            ->setLoadingPlaceholderEnabled()
            ->setLoadingPlaceholderStatus(true)
            ->setSelectAllStatus(true)
            ->storeFiltersInSessionEnabled()
            ->setSearchVisibilityStatus(false)
            ->setConfigurableAreas([
                'toolbar-left-start' => [
                    'domains.application.documents.livewire.upload-button',
                ],
                'toolbar-left-end' => [
                    'domains.application.global.tables.refresh-button',
                ],
            ]);
    }

    public function columns(): array
    {
        return [
            BooleanColumn::make('JSON', 'json_data')
                ->setCallback(function (?array $value, $row) {
                    if ($value === null) {
                        return false;
                    }

                    return true;
                })
                ->setView('domains.application.documents.livewire.json-button'),
            Column::make(__('tables.documents.name'), 'name')
                ->searchable()
                ->sortable(),
            Column::make(__('tables.documents.original_filename'), 'original_filename')
                ->searchable()
                ->sortable(),
            Column::make(__('tables.documents.created_at'), 'created_at')
                ->sortable(),
            Column::make('')
                ->excludeFromColumnSelect()
                ->label(
                    fn (
                        $row,
                        Column $column
                    ) => view('domains.application.documents.livewire.actions')->with([
                        'item' => $row,
                    ])
                ),
        ];
    }

    public function processDataForLLM($id): void
    {
        try {
            event(new LLMDataProcessingTriggeredEvent(Document::findOrFail($id)));

            Flux::toast(
                text: __('application.pages.documents.table.messages.success.process_for_llm_started'),
                variant: 'success'
            );
        } catch (Exception) {
            Flux::toast(
                text: __('application.pages.documents.table.messages.error.unable_to_start'),
                variant: 'danger'
            );
        }
    }

    public function syncDocumentStatus($id): void
    {
        try {
            event(new LLMDataProcessingRunningEvent(Document::findOrFail($id)));

            Flux::toast(
                text: __('application.pages.documents.table.messages.success.sync_document_data_for_llm'),
                variant: 'success'
            );
        } catch (Exception) {
            Flux::toast(
                text: __('application.pages.documents.table.messages.error.unable_to_sync'),
                variant: 'danger'
            );
        }
    }
}
