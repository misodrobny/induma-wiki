<?php

namespace App\Domains\Application\Global\Traits;

use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;

trait BaseDatatableTrait
{
    /**
     * @throws DataTableConfigurationException
     */
    public function bootedBaseTableTrait(): void
    {
        $this->setFilterLayout('slide-down')
            ->setSortingEnabled()
            ->setSortingPillsEnabled()
            ->setLoadingPlaceholderEnabled()
            ->setLoadingPlaceholderStatus(true)
            ->setSelectAllStatus(true)
            ->storeFiltersInSessionEnabled()
            ->setThAttributes(function (Column $column) {
                return [
                    'default' => false,
                    'default-colors' => true,
                    'class' => 'text-left text-xs font-medium whitespace-nowrap uppercase tracking-wider text-gray-500 dark:bg-gray-800 dark:text-gray-400 p-2',
                ];
            })
            ->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
                return [
                    'default' => false,
                    'default-colors' => true,
                    'class' => 'px-2 py-1 text-left text-sm font-medium whitespace-nowrap text-gray-500 dark:bg-gray-800 dark:text-gray-400',
                ];
            })
            ->setConfigurableAreas([
                'toolbar-left-end' => [
                    'domains.application.global.tables.refresh-button',
                ],
            ]);
    }
}
