<?php

use App\Domains\Application\Dashboard\Controllers\DashboardController;
use App\Domains\Application\Documents\Controllers\ListDocumentsController;
use App\Domains\Application\Documents\Controllers\UploadDocumentController;
use App\Domains\Application\Documents\Models\Document;
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

                Route::post('logout', function () {
                    Auth::guard('web')->logout();

                    Session::invalidate();
                    Session::regenerateToken();

                    return redirect()->route('login');
                })->name('logout');

                Route::get('get-json-data/{id?}', function ($id) {
                    if ($id === null) {
                        return response()->json();
                    }

                    $document = Document::findOrFail($id);
                    return response()->json(
                        $document->json_data
                    );
                })->name('get-json-data');
            });

        Route::get('language/{locale}', LanguageController::class)
            ->name('language');

    });

require __DIR__.'/auth.php';
