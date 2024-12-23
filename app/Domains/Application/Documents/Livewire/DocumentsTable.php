<?php

namespace App\Domains\Application\Documents\Livewire;

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

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects([
                'documents.id as id',
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
            Column::make("Name", "name")
                ->searchable()
                ->sortable(),
            Column::make("Original filename", "original_filename")
                ->searchable()
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make('')
                ->label(
                    fn(
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
                text: 'Data processing triggered for LLM. Please wait for the result.',
                variant: 'success'
            );
        }
        catch (Exception) {
            Flux::toast(
                text: 'Unable to process data for LLM.',
                variant: 'danger'
            );
        }
    }
}
