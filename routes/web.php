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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['role:superadmin']], function (){

});

Route::match(['get', 'post'], '/', [\App\Http\Controllers\SiteController::class, 'index'])->name('index');
Route::post('/addcart', [\App\Http\Controllers\SiteController::class, 'addCart'])->name('addCart');
Route::get('/getcartcontent', [\App\Http\Controllers\SiteController::class, 'getCartContent'])->name('getCartContent');


require __DIR__.'/auth.php';
