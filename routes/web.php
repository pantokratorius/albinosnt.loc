<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPagesController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ManagersController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\ChooseLang;
use App\Http\Middleware\SharedViewDataMiddleware;
use Illuminate\Support\Facades\App;
// use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

// Route::get('/linkstorage', function () {
//     Artisan::call('storage:link');
// });


Route::get('/', function () {
    return view('welcome');
});


  Route::get('language/{locale}', function (string $locale) {// dd($locale);
    if (!in_array($locale, ['lt', 'ru'])) {
        abort(400);
    }

    Session::put('locale', $locale);
    app()->setLocale($locale);

    // return redirect()->back();
     return redirect()->route($locale . '_homepage');
})->name('lang');


Route::post('/sendmail', [IndexController::class, 'sendmail'])->name('sendmail');

//frontend pages
Route::middleware([ChooseLang::class])->group(function () {


    // homepage
    Route::match(['get', 'post'], '/', [IndexController::class, 'index'])->name('lt_homepage');
    Route::match(['get', 'post'], '/ru', [IndexController::class, 'index'])->name('ru_homepage');
    Route::match(['get', 'post'], '/nekilnojamas-turtas/{itemtype}', [IndexController::class, 'itemtype'])->name('lt_itemtype');
    Route::match(['get', 'post'], '/недвижимость/{itemtype}', [IndexController::class, 'itemtype'])->name('ru_itemtype');
    Route::match(['get', 'post'], '/sandorio-tipas/{sellaction}', [IndexController::class, 'sellaction'])->name('lt_sellaction');
    Route::match(['get', 'post'], '/тип-сделки/{sellaction}', [IndexController::class, 'sellaction'])->name('ru_sellaction');
    Route::match(['get', 'post'], 'search', [IndexController::class, 'search'])->name('search');
    Route::get('nekilnojamas-turtas/skelbimas/{id}', [IndexController::class, 'item'])->name('lt_nt_item');
    Route::get('недвижимость/объявление/{id}', [IndexController::class, 'item'])->name('ru_nt_item');

    // rest pages
    Route::get('paslaugos', [PagesController::class, 'services'])->name('lt_services');
    Route::get('partneriai', [PagesController::class, 'partners'])->name('lt_partners');
    Route::get('kontaktai', [PagesController::class, 'contacts'])->name('lt_contacts');
    Route::get('услуги', [PagesController::class, 'services'])->name('ru_services');
    Route::get('партнеры', [PagesController::class, 'partners'])->name('ru_partners');
    Route::get('контакты', [PagesController::class, 'contacts'])->name('ru_contacts');

    Route::get('privatumo-politika', [PagesController::class, 'privacy'])->name('lt_privacy');
    Route::get('политика-конфиденциальности', [PagesController::class, 'privacy'])->name('ru_privacy');


       Route::get('getRegion/', [IndexController::class, 'getRegion'])->name('getRegion');
    Route::get('getGatve/', [IndexController::class, 'getGatve'])->name('getGatve');
    Route::get('getMikroregion/', [IndexController::class, 'getMikroregion'])->name('getMikroregion');

});


//admin pages
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::match(['get', 'post'], '/admin/skelbimai/naujas', [AdminController::class, 'skelbimai_naujas'])->name('admin.skelbimai.naujas');
    Route::get('/admin/skelbimai', [AdminController::class, 'skelbimai'])->name('admin.skelbimai');
    Route::match(['get', 'post'], '/admin/skelbimai/edit/{id}', [AdminController::class, 'skelbimai_redaguoti'])->name('admin.skelbimai.edit');
    Route::post('admin/delete/', [AdminController::class, 'delete'])->name('admin.delete');
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


        Route::match(['get', 'post'], '/admin/services/', [AdminPagesController::class, 'services'])->name('admin.pages.services');
        Route::match(['get', 'post'], '/admin/partners/', [AdminPagesController::class, 'partners'])->name('admin.pages.partners');
        Route::post('/admin/partners/delete_files/', [AdminPagesController::class, 'delete_files'])->name('admin.pages.partners.delete_files');
        Route::match(['get', 'post'], '/admin/contacts/', [AdminPagesController::class, 'contacts'])->name('admin.pages.contacts');


     });

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
