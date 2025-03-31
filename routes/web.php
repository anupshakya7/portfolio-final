<?php

use App\Http\Controllers\PorfolioController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Voyager\PortfolioController as VoyagerPortfolioController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[PortfolioController::class,'index'])->name('home');
Route::prefix('admin')->group(function(){
    Route::resource('/portfolio',VoyagerPortfolioController::class);
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
