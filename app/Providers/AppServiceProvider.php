<?php

namespace App\Providers;

use App\Domains\Application\Documents\Livewire\DocumentsTable;
use App\Domains\Application\Documents\Livewire\UploadDocumentComponent;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->bootLivewireComponents();
    }

    private function bootLivewireComponents(): void
    {
        Livewire::component('application.documents.table', DocumentsTable::class);

        Livewire::component('application.documents.upload', UploadDocumentComponent::class);
    }
}
