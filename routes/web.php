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


Route::match(['get', 'post'], '/', [\App\Http\Controllers\SiteController::class, 'index'])->name('index');
Route::get('/dashboard', [\App\Http\Controllers\SiteController::class, 'dashboard'])->name('dashboard');

Route::group(['middleware' => ['role:superadmin']], function (){

});

Route::group(['middleware' => ['role:buyer']], function (){
    Route::post('/addcart', [\App\Http\Controllers\SiteController::class, 'addCart'])->name('addCart');
    Route::get('/getcartcontent', [\App\Http\Controllers\SiteController::class, 'getCartContent'])->name('getCartContent');
    Route::post('/checkout',[\App\Http\Controllers\SiteController::class, 'checkout'])->name('checkout');
    Route::get('/success',[\App\Http\Controllers\SiteController::class, 'success'])->name('success');

});



require __DIR__.'/auth.php';
