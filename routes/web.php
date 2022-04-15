<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ZipcodeController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\FavouritesController;

use App\Http\Controllers\HomeController;


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

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/* Route::get('/', function () {
    return View::make('home');
}); */

Route::get('/', [HomeController::class, 'index']);

Route::get('dashboard', function () {
    return View::make('admin.dashboard');
})->middleware('auth');

Route::get('dashboard', [DashboardController::class, 'index']);
Route::get('dashboard-logout', [DashboardController::class, 'logsout'])->name('logout');

/* ************* ROUTES FOR ZIPCODES ************* */
Route::get('zipcodes', [ZipcodeController::class, 'index'])->name('viewZipcodes');
Route::get('add-zipcodes', [ZipcodeController::class, 'addZipcodes'])->name('addzipcodes');
Route::post('savezipcodes', [ZipcodeController::class, 'saveZipCode'])->name('saveZipcodes');
Route::get('edit-zipcode/{id}', [ZipcodeController::class, 'addZipcodes'])->name('editZipcode');
Route::post('update-zip-code/{id}', [ZipcodeController::class, 'updateZipcode'])->name('updateZipcode');

Route::post('ajax/zipcode/del/req',[ZipcodeController::class, 'del'])->name('ajax.zipcode.del.req');

Route::post('ajax/search/q',[HomeController::class, 'searchZipCodes'])->name('ajax.search.req');




/* ************* ROUTES FOR SLIDERS ************* */
Route::get('sliders', [SlideController::class, 'index'])->name('sliders');
Route::get('add-slider', [SlideController::class, 'create'])->name('add-slider');
Route::post('store-slider', [SlideController::class, 'store'])->name('store-slider');
Route::get('edit/slide/{id}', [SlideController::class, 'create'])->name('edit-slide');
Route::post('update/slide/{id}', [SlideController::class, 'update'])->name('update-slide');

Route::post('ajax/slide/del/req', [SlideController::class,  'del'])->name('ajax.slide.del.req');

/* ************* ROUTES FOR PRODUCTS ************* */
Route::get('products', [ProductsController::class, 'index'])->name('products');
Route::get('add-product', [ProductsController::class, 'create'])->name('add-product');
Route::post('save-product', [ProductsController::class, 'store'])->name('store-product');
Route::get('edit-product/{id}', [ProductsController::class, 'create'])->name('edit-product');
Route::post('update-product/{id}', [ProductsController::class, 'update'])->name('update-product');

Route::post('ajax/prod/del/req', [ProductsController::class, 'del'])->name('ajax.product.del.req');

/* ************* ROUTES FOR FAVOURITE PRODUCTS ************* */
Route::get('favourite-products', [FavouritesController::class, 'index'])->name('favourites');
Route::get('add-favourites', [FavouritesController::class, 'create'])->name('add-favourites');
Route::post('save-favourites', [FavouritesController::class, 'store'])->name('store-favourite');
Route::get('edit-favourite-product/{id}', [FavouritesController::class, 'create'])->name('edit-favourite-product');
Route::post('update-favourite/{id}', [FavouritesController::class, 'update'])->name('update-favourite');

Route::post('ajax/fav/prod/del/req', [FavouritesController::class, 'del'])->name('ajax.favourite.product.del.req');

/* ************* ROUTES FOR ADMIN-PROFILES ************* */
Route::get('admin-profile', [AdminController::class, 'index'])->name('admin-profile');
Route::post('update-user/{id}', [AdminController::class, 'update'])->name('update-user');
Route::post('update-passwords/{id}', [AdminController::class, 'updatepass'])->name('update-passwords');



/* Route::get('administrator', function () {
    return View::make('auth.login');
}); */

/* Route::get('registeration', function () {
    return View::make('auth.register');
}); */

//Route::post('register', 'Admin\AdminRegisterController@register')->name('register');

//Route::post('login', 'Admin\AdminController@login')->name('login');

//Route::post('login', [AdminController::class, 'login']);
