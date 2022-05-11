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

    // квоты
    Route::get('/quotas', [App\Http\Controllers\buyer\quotas_controller::class, 'index'])->name('quotas.index');
    Route::get('/quotas/create', [App\Http\Controllers\buyer\quotas_controller::class, 'create'])->name('quotas.create');
    Route::post('/quotas/store', [App\Http\Controllers\buyer\quotas_controller::class, 'store'])->name('quotas.store');
    Route::get('/quotas/edit/{quota_id}', [App\Http\Controllers\buyer\quotas_controller::class, 'edit'])->name('quotas.edit');
    Route::get('/quotas/edit\{quota_id}\{item_id}', [App\Http\Controllers\buyer\quotas_controller::class, 'edit'])->name('quotas.edititem');
    Route::put('/quotas/update/{quota_id}', [App\Http\Controllers\buyer\quotas_controller::class, 'update'])->name('quotas.update');
    Route::get('/quotas/show/{quota_id}', [App\Http\Controllers\buyer\quotas_controller::class, 'show'])->name('quotas.show');
    Route::get('/quotas/showitem/{quota_id}\{item_id}', [App\Http\Controllers\buyer\quotas_controller::class, 'show'])->name('quotas.showitem');
    Route::post('/quotas/additem', [App\Http\Controllers\buyer\quotas_controller::class, 'additem'])->name('quotas.additem');
    Route::delete('/quotas/destroy/{quota_id}', [App\Http\Controllers\buyer\quotas_controller::class, 'destroy'])->name('quotas.destroy');
    Route::post('/quotas/updateitem/{item_id}\{quota_id}', [App\Http\Controllers\buyer\quotas_controller::class, 'updateitem'])
        ->name('quotas.updateitem');
    Route::post('/quotas/destroyitem/{item_id}\{quota_id}', [App\Http\Controllers\buyer\quotas_controller::class, 'destroyitem'])
        ->name('quotas.destroyitem');

    // категории для админа
    Route::resource('/category',App\Http\Controllers\admin\category_controller::class);


    //Товары для покупателя
//    Route::get('/bproducts/', [App\Http\Controllers\buyer\buyer_products_controller::class, 'index'])->name('buyerproducts.index');
//    Route::get('/bproducts/{IdCategories}', [App\Http\Controllers\buyer\buyer_products_controller::class, 'index'])->name('buyerproducts.indexcategory');


    //Товары для продавца
    Route::get('/products/',[App\Http\Controllers\seller\products_controller::class, 'index'])->name('products.index');
    Route::get('/productss/{IdCategories}',[App\Http\Controllers\seller\products_controller::class, 'index'])->name('products.indexid');
    Route::get('/products/{IdCategories}',[App\Http\Controllers\seller\products_controller::class, 'create'])->name('products.create');
    Route::get('/products/{IdCategories}/{product_id}',[App\Http\Controllers\seller\products_controller::class, 'create'])
        ->name('products.createedit');
    Route::get('/products/show/{IdCategories}',[App\Http\Controllers\seller\products_controller::class, 'show'])->name('products.show');
    Route::post('/products/store/{IdCategories}',[App\Http\Controllers\seller\products_controller::class, 'store'])->name('products.store');
    Route::post('/products/update/{IdCategories}/{product_id}',[App\Http\Controllers\seller\products_controller::class, 'update'])
        ->name('products.update');
    Route::post('/products/destroy/{IdCategories}/{product_id}',[App\Http\Controllers\seller\products_controller::class, 'destroy'])
        ->name('products.destroy');



});
