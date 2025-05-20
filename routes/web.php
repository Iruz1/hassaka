<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\InsightController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Databank Routes
    Route::prefix('databank')->group(function () {
         Route::get('/', [DocumentController::class, 'index'])->name('databank');
         Route::get('/upload', [DocumentController::class, 'showUploadForm'])->name('databank.upload');
         Route::post('/upload', [DocumentController::class, 'upload'])->name('databank.upload.submit');
         Route::get('/edit/{document}', [DocumentController::class, 'edit'])->name('databank.edit');

    // Tambahkan route untuk konfirmasi dan aksi penghapusan
         Route::get('/delete/{document}', [DocumentController::class, 'confirmDelete'])->name('databank.confirm-delete');
         Route::delete('/{document}', [DocumentController::class, 'destroy'])->name('databank.destroy');
    });

    // Documents Routes
    Route::get('/documents/{document}/edit', [DocumentController::class, 'edit'])
        ->name('documents.edit');

    // WOPI Integration
    Route::get('/wopi/files/{filename}', [DocumentController::class, 'getFile'])
        ->name('wopi.files');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Project Routes
    Route::prefix('project')->group(function () {
        // Manual routes
        Route::get('/index', [ProjectController::class, 'index'])->name('project.index');
        Route::get('/create', [ProjectController::class, 'create'])->name('project.create');
        Route::get('/calendar', [ProjectController::class, 'calendar'])->name('project.calendar');

        Route::post('/', [ProjectController::class, 'store'])->name('project.store');
        Route::get('/{project}', [ProjectController::class, 'show'])->name('project.show');
        Route::put('/{project}', [ProjectController::class, 'update'])->name('project.update');

        Route::get('/{project}/edit', [ProjectController::class, 'edit'])
            ->name('project.edit')
            ->middleware('can:update,project');

        Route::delete('/{project}', [ProjectController::class, 'destroy'])
            ->name('project.destroy')
            ->middleware('can:delete,project');
    });

    // Insights Routes
    Route::prefix('insights')
    ->name('insights.')
    ->middleware(['auth', 'verified']) // Apply common middleware
    ->group(function () {

        // Data Display
        Route::get('/', [InsightController::class, 'index'])
            ->name('index');

        // Data Operations
        Route::middleware('can:fetch-data')->group(function () {
            Route::post('/fetch', [InsightController::class, 'fetchFromApis'])
                ->name('fetch'); // Changed to POST for data modification
        });

        // Export Operations
        Route::prefix('export')
            ->name('export.')
            ->group(function () {
                Route::get('/', [ExportController::class, 'showExportForm'])
                    ->name('form');

                Route::post('/data', [ExportController::class, 'export'])
                    ->name('data'); // Changed to POST for data processing
            });
    });


    Route::get('/dashboard', [DashboardController::class, 'index'])
     ->middleware(['auth'])
     ->name('dashboard');


});

require __DIR__.'/auth.php';
