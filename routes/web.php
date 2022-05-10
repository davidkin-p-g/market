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

    //квоты для покупателя
    Route::get('/quotas/edititem\{item_id}\{quotas_id}', [App\Http\Controllers\buyer\quotas_controller::class, 'edititem'])->name('quotas.edititem');
    Route::resource('/quotas',App\Http\Controllers\buyer\quotas_controller::class);
    Route::post('/quotas/additem', [App\Http\Controllers\buyer\quotas_controller::class, 'additem'])->name('quotas.additem');
    Route::post('/quotas/updateitem/{item_id}\{quotas_id}', [App\Http\Controllers\buyer\quotas_controller::class, 'updateitem'])
        ->name('quotas.updateitem');
    Route::post('/quotas/destroyitem/{item_id}\{quotas_id}', [App\Http\Controllers\buyer\quotas_controller::class, 'destroyitem'])
        ->name('quotas.destroyitem');

    //Товары для покупателя
    Route::get('/bproducts/', [App\Http\Controllers\buyer\buyer_products_controller::class, 'index'])->name('buyerproducts.index');
    Route::get('/bproducts/{IdCategories}', [App\Http\Controllers\buyer\buyer_products_controller::class, 'index'])->name('buyerproducts.indexcategory');

    // категории для админа
    Route::resource('/category',App\Http\Controllers\admin\category_controller::class);

    //Товары для продавца
    Route::get('/products/',[App\Http\Controllers\seller\products_controller::class, 'index'])->name('products.index');
    Route::get('/products/create/{IdCategories}',[App\Http\Controllers\seller\products_controller::class, 'create'])->name('products.create');
    Route::get('/products/create/{IdCategories}/{product_id}',[App\Http\Controllers\seller\products_controller::class, 'create'])
        ->name('products.createedit');
    Route::post('/products/store/{IdCategories}',[App\Http\Controllers\seller\products_controller::class, 'store'])->name('products.store');
    Route::post('/products/update/{IdCategories}/{product_id}',[App\Http\Controllers\seller\products_controller::class, 'update'])
        ->name('products.update');
    Route::post('/products/destroy/{IdCategories}/{product_id}',[App\Http\Controllers\seller\products_controller::class, 'destroy'])
        ->name('products.destroy');



});
