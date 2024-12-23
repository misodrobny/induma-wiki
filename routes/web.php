<?php

use App\Domains\Application\Dashboard\Controllers\DashboardController;
use App\Domains\Application\Documents\Controllers\GetDocumentJsonDataController;
use App\Domains\Application\Documents\Controllers\ListDocumentsController;
use App\Domains\Application\Documents\Controllers\UploadDocumentController;
use App\Domains\Application\Global\Controllers\LogoutController;
use App\Domains\Global\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'web',
])
    ->group(function () {
        Route::middleware([
            'auth',
        ])
            ->group(function () {
                Route::name('application.')
                    ->group(function () {
                        Route::get('/', DashboardController::class)
                            ->name('dashboard');

                        Route::get('documents', ListDocumentsController::class)
                            ->name('documents.list');

                        Route::get('document/upload', UploadDocumentController::class)
                            ->name('document.upload');

                        Route::get('profile', function () {
                            return view('profile');
                        })->name('profile');
                    });

                Route::get('logout', LogoutController::class)
                    ->name('logout');

                Route::get('get-json-data/{id?}', GetDocumentJsonDataController::class)
                    ->name('get-json-data');
            });

        Route::get('language/{locale}', LanguageController::class)
            ->name('language');

    });

require __DIR__.'/auth.php';
