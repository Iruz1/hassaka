<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OnlyOfficeController;;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\InsightController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleDriveController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');




    Route::prefix('google-drive')->middleware(['auth'])->group(function () {
        Route::get('/connect', [GoogleDriveController::class, 'connect'])->name('databank.connect');
        Route::get('/callback', [GoogleDriveController::class, 'callback'])->name('databank.callback');

        Route::get('/files', [GoogleDriveController::class, 'listFiles'])->name('databank.index');
        Route::get('/upload', [GoogleDriveController::class, 'uploadForm'])->name('databank.upload.form');
        Route::post('/upload', [GoogleDriveController::class, 'upload'])->name('databank.upload');
        Route::get('/edit/{fileId}', [GoogleDriveController::class, 'edit'])->name('databank.edit');
        Route::put('/update/{fileId}', [GoogleDriveController::class, 'update'])->name('databank.update');
        Route::get('/share/{fileId}', [GoogleDriveController::class, 'shareForm'])->name('databank.share.form');
        Route::post('/share/{fileId}', [GoogleDriveController::class, 'share'])->name('databank.share');
        Route::delete('/delete/{fileId}', [GoogleDriveController::class, 'delete'])->name('databank.delete');
    });


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


    Route::get('/dashboard', [DashboardController::class, 'index'])
     ->middleware(['auth'])
     ->name('dashboard');


});

require __DIR__.'/auth.php';
