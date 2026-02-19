<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DragonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/morphs', [HomeController::class, 'morphs'])->name('morphs');
Route::get('/breeding-stock', [HomeController::class, 'breedingStock'])->name('breeding-stock');

Route::get('/dashboard', function () {
    return view('dashboard', [
        'totalDragons' => \App\Models\Dragon::count(),
        'availableDragons' => \App\Models\Dragon::where('status', 'available')->count(),
        'soldDragons' => \App\Models\Dragon::where('status', 'sold')->count(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Admin dragon routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('dragons', DragonController::class);
        Route::delete('dragons/{dragon}/images/{image}', [DragonController::class, 'deleteImage'])->name('dragons.images.delete');
        Route::patch('dragons/{dragon}/images/{image}/primary', [DragonController::class, 'setPrimaryImage'])->name('dragons.images.primary');
    });
});

require __DIR__.'/auth.php';