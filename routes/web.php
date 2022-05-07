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
Route::get('/', function () {
    return view('welcome');
});
// руты для решистрации и авторизации
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/index', function () {
        return view('index');
    });

    Route::resource('/quotas',App\Http\Controllers\buyer\quotas_controller::class);

//    Route::get('/quotas', [App\Http\Controllers\quotas_controller::class, 'index'])->name('quotas.index');
//    Route::post('/quotas', [App\Http\Controllers\quotas_controller::class, 'store'])->name('quotas.store');
//    Route::get('/quotas/create', [App\Http\Controllers\quotas_controller::class, 'index'])->name('quotas/create');
//    Route::get('/quotas', [App\Http\Controllers\quotas_controller::class, 'index'])->name('quotas.index');
//    Route::get('/quotas', [App\Http\Controllers\quotas_controller::class, 'index'])->name('quotas.index');
//    Route::get('/quotas', [App\Http\Controllers\quotas_controller::class, 'index'])->name('quotas.index');
//    Route::get('/quotas', [App\Http\Controllers\quotas_controller::class, 'index'])->name('quotas.index');
});
