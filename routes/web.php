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

    //Товары
    Route::get('/products/',[App\Http\Controllers\seller\products_controller::class, 'index'])->name('products.index');
    Route::get('/product/{IdCategories}',[App\Http\Controllers\seller\products_controller::class, 'index'])->name('products.indexid');
    Route::get('/products/{IdCategories}',[App\Http\Controllers\seller\products_controller::class, 'create'])->name('products.create');
    Route::get('/products/{IdCategories}/{product_id}',[App\Http\Controllers\seller\products_controller::class, 'create'])
        ->name('products.createedit');
    Route::get('/products/show/{IdCategories}',[App\Http\Controllers\seller\products_controller::class, 'show'])->name('products.show');
    Route::post('/products/store/{IdCategories}',[App\Http\Controllers\seller\products_controller::class, 'store'])->name('products.store');
    Route::post('/products/update/{IdCategories}/{product_id}',[App\Http\Controllers\seller\products_controller::class, 'update'])
        ->name('products.update');
    Route::post('/products/destroy/{IdCategories}/{product_id}',[App\Http\Controllers\seller\products_controller::class, 'destroy'])
        ->name('products.destroy');

    // Предложения
    Route::get('/offer/{id}/{quota_id?}',[App\Http\Controllers\offers\offers_controller::class, 'create'])->name('offers.create_buyer');
    Route::get('/offer/add/{id}/{dop_id}',[App\Http\Controllers\offers\offers_controller::class, 'add'])->name('offers.add_buyer');
    Route::post('/offer/store/{item}/{product}',[App\Http\Controllers\offers\offers_controller::class, 'store'])->name('offers.store');
    Route::post('/offer/update/{offer_id}',[App\Http\Controllers\offers\offers_controller::class, 'update'])->name('offers.update');
    Route::post('/offer/storechat/{offer_id}',[App\Http\Controllers\offers\offers_controller::class, 'storechat'])->name('offers.storechat');
    Route::post('/offers/destroy/{offer_id}',[App\Http\Controllers\offers\offers_controller::class, 'destroy'])->name('offers.destroy');
    Route::get('/offer_seller/{id}/{IdCategories}',[App\Http\Controllers\offers\offers_controller::class, 'create_post'])->name('offers.create_seller');
    Route::get('/offers/',[App\Http\Controllers\offers\offers_controller::class, 'index'])->name('offers.index');
    Route::get('/offers/edit/{offer_id}',[App\Http\Controllers\offers\offers_controller::class, 'edit'])->name('offers.edit');

    Route::get('/offers/quota/{quota_id}',[App\Http\Controllers\offers\offers_controller::class, 'quota'])->name('offers.quota');
    Route::get('/offers/item/{item_id}',[App\Http\Controllers\offers\offers_controller::class, 'item'])->name('offers.item');
    Route::get('/offers/product/{product_id}',[App\Http\Controllers\offers\offers_controller::class, 'product'])->name('offers.product');
    Route::get('/offers/dogovor/{offer_id}',[App\Http\Controllers\offers\offers_controller::class, 'dogovor'])->name('offers.dogovor');




});
