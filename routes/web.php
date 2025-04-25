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

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/databank', function () {
        return view('databank');
    })->middleware(['auth', 'verified'])->name('databank');

    Route::middleware(['auth'])->group(function () {
        Route::get('/databank', [DocumentController::class, 'index'])->name('databank');
        Route::get('/databank/upload', [DocumentController::class, 'showUploadForm'])->name('databank.upload');
        Route::post('/databank/upload', [DocumentController::class, 'upload'])->name('databank.upload.submit');
        Route::get('/databank/edit/{document}', [DocumentController::class, 'edit'])->name('databank.edit');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/documents/{document}/edit', [DocumentController::class, 'edit'])
            ->name('documents.edit');
    });


    Route::middleware(['auth'])->group(function () {
        // Route untuk WOPI integration
        Route::get('/wopi/files/{filename}', [DocumentController::class, 'getFile'])
            ->name('wopi.files');
    });


    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });


    Route::middleware(['auth'])->group(function () {
        // Route resource dengan parameter yang eksplisit
        Route::resource('project', ProjectController::class)->parameters([
            'project' => 'project:id' // Pastikan parameter menggunakan :id untuk binding model
        ]);

        Route::get('/project/calendar', [ProjectController::class, 'calendar'])->name('project.calendar');
        Route::get('/project/edit', [ProjectController::class, 'edit'])->name('project.edit');
        Route::get('/project/destroy', [ProjectController::class, 'destroy'])->name('project.destroy');

    });

    Route::middleware(['auth'])->group(function () {
        // Data Insights
        Route::get('/insights', [InsightController::class, 'index'])->name('insights.index');
        Route::get('/insights/fetch', [InsightController::class, 'fetchFromApis'])->name('insights.fetch')
            ->middleware('can:fetch-data');

        // Export
        Route::get('/insights/export', [ExportController::class, 'showExportForm'])->name('insights.export.form');
        Route::get('/insights/export/data', [ExportController::class, 'export'])->name('insights.export');
    });


    require __DIR__.'/auth.php';
