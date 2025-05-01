<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\InsightController;

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
    Route::prefix('insights')->group(function () {
        Route::get('/', [InsightController::class, 'index'])->name('insights.index');
        Route::get('/fetch', [InsightController::class, 'fetchFromApis'])
            ->name('insights.fetch')
            ->middleware('can:fetch-data');

        // Export Routes
        Route::get('/export', [ExportController::class, 'showExportForm'])->name('insights.export.form');
        Route::get('/export/data', [ExportController::class, 'export'])->name('insights.export');
    });
});

require __DIR__.'/auth.php';
