<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/Datanbank', function () {
    return view('Databank');
})->middleware(['auth', 'verified'])->name('Databank');

Route::middleware(['auth'])->group(function () {
    Route::get('/databank', [DocumentController::class, 'index'])->name('databank');
    Route::get('/databank/upload', [DocumentController::class, 'showUploadForm'])->name('databank.upload');
    Route::post('/databank/upload', [DocumentController::class, 'upload'])->name('databank.upload.submit');
    Route::get('/databank/edit/{document}', [DocumentController::class, 'edit'])->name('databank.edit');
});

Route::get('/Schedule', function () {
    return view('Schedule');
})->middleware(['auth', 'verified'])->name('Schedule');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
