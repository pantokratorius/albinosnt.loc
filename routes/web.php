<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::match(['get', 'post'], '/admin/skelbimai/naujas', AdminController::class)->name('admin.skelbimai.naujas');
    Route::get('/admin/skelbimai', [AdminController::class, 'skelbimai'])->name('admin.skelbimai');
    Route::get('/admin/skelbimai/redaguoti/{id}', [AdminController::class, 'skelbimai_redaguoti'])->name('admin.skelbimai');

    Route::get('admin/getRegion/', [AdminController::class, 'getRegion'])->name('admin.getRegion');
    Route::get('admin/getMikroregion/', [AdminController::class, 'getMikroregion'])->name('admin.getMikroregion');
    Route::get('admin/getGatve/', [AdminController::class, 'getGatve'])->name('admin.getGatve');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
