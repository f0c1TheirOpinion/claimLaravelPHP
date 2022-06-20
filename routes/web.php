<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\Admin\AdminController;
use \App\Http\Controllers\Admin\UslugiController;
use \App\Http\Controllers\Admin\SliderController;
use \App\Http\Controllers\Admin\BidController;

use \App\Http\Controllers\ProfileController;

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

Route::get('/',  [HomeController::class, 'index'])->name('index.user');


Route::group([
    'as' => 'admin.', // имя маршрута, например admin.index
    'prefix' => 'admin', // префикс маршрута, например admin/index
    'middleware' => ['auth', 'admin'] // один или несколько посредников
], function () {
    Route::get('index', [AdminController::class, '__invoke'])->name('index');
    Route::resource('uslug', UslugiController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('bidOR', BidController::class);
    Route::get('editD/{bidOR}', [BidController::class, 'editD'])->name('editD');


});


Auth::routes();


Route::resource('profileUser', ProfileController::class);
Route::get('createBid/{Bid}',  [HomeController::class, 'showForm'])->name('createBid.user');
Route::post('saveBid/{Bid}',  [HomeController::class, 'saveFormBid'])->name('saveBid.user');
