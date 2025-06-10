<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ManagersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [IndexController::class, 'index'])->name('homepage');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::match(['get', 'post'], '/admin/skelbimai/naujas', [AdminController::class, 'skelbimai_naujas'])->name('admin.skelbimai.naujas');
    Route::get('/admin/skelbimai', [AdminController::class, 'skelbimai'])->name('admin.skelbimai');
    Route::match(['get', 'post'], '/admin/skelbimai/edit/{id}', [AdminController::class, 'skelbimai_redaguoti'])->name('admin.skelbimai.edit');
    Route::get('admin/delete/', [AdminController::class, 'delete'])->name('admin.delete');
    Route::post('admin/delete_few_rows/', [AdminController::class, 'delete_few_rows'])->name('admin.delete_few_rows');

    Route::get('admin/getRegion/', [AdminController::class, 'getRegion'])->name('admin.getRegion');
    Route::get('admin/getMikroregion/', [AdminController::class, 'getMikroregion'])->name('admin.getMikroregion');
    Route::get('admin/getGatve/', [AdminController::class, 'getGatve'])->name('admin.getGatve');
    Route::post('admin/updateOrder/', [AdminController::class, 'updateOrder'])->name('admin.updateOrder');

    Route::get('admin/getManagers/', [AdminController::class, 'getManagers'])->name('admin.getManagers');
    Route::get('admin/updateManager/', [AdminController::class, 'updateManager'])->name('admin.updateManager');

    Route::match(['get', 'post'],'admin/addStreet/', [AdminController::class, 'addStreet'])->name('admin.addStreet');
    Route::match(['get', 'post'],'admin/addMikroregion/', [AdminController::class, 'addMikroregion'])->name('admin.addMikroregion');
    
    Route::post('admin/deleteImage/', [AdminController::class, 'deleteImage'])->name('admin.deleteImage');

    Route::group(['middleware' => ['role:Administratorius|Super Admin']], function () { 
        Route::get('/admin/managers', [ManagersController::class, 'index'])->name('admin.managers');
        Route::match(['get', 'post'], '/admin/managers/edit/{id}', [ManagersController::class, 'edit'])->name('admin.managers.edit');
        Route::match(['get', 'post'], '/admin/managers/add/', [ManagersController::class, 'add'])->name('admin.managers.add');
        Route::post('/admin/manager/removeImage/', [ManagersController::class, 'removeImage'])->name('admin.managers.removeImage');
        Route::get('admin/managers/delete', [ManagersController::class, 'delete'])->name('admin.managers.delete');
     });

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
