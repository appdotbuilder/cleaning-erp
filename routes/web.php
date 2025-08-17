<?php

use App\Http\Controllers\ErpDashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MaterialController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/health-check', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
    ]);
})->name('health-check');

// Home page - ERP Dashboard
Route::get('/', [ErpDashboardController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [ErpDashboardController::class, 'show'])->name('dashboard');
    
    // ERP Resource Routes
    Route::resource('suppliers', SupplierController::class);
    Route::resource('materials', MaterialController::class);
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
