<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// стандартный маршрут сайта
//Route::get('/', function () {
//    return view('welcome');
//});
// руты для решистрации и авторизации
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/index', function () {
        return view('index');
    });

    Route::get('/quotas/edititem\{item_id}\{quotas_id}', [App\Http\Controllers\buyer\quotas_controller::class, 'edititem'])->name('quotas.edititem');
    Route::resource('/quotas',App\Http\Controllers\buyer\quotas_controller::class);

    Route::post('/quotas/additem', [App\Http\Controllers\buyer\quotas_controller::class, 'additem'])->name('quotas.additem');
    Route::post('/quotas/updateitem/{item_id}\{quotas_id}', [App\Http\Controllers\buyer\quotas_controller::class, 'updateitem'])
        ->name('quotas.updateitem');
    Route::post('/quotas/destroyitem/{item_id}\{quotas_id}', [App\Http\Controllers\buyer\quotas_controller::class, 'destroyitem'])
        ->name('quotas.destroyitem');

    Route::resource('/category',App\Http\Controllers\admin\category_controller::class);
    Route::resource('/products',App\Http\Controllers\seller\products_controller::class);

});
