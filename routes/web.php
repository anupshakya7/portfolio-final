<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\PorfolioController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\Voyager\PortfolioController as VoyagerPortfolioController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

//Blog
Route::resource('blog',BlogController::class)->only(['index','show']); 

//Tools
Route::prefix('tool')->group(function(){
    //GPA Converter
    Route::get('/gpa-calculator',[ToolController::class,'gpaCalculator'])->name('tool.gpa-calculator');

    //Generate QR Code
    Route::get('/qr-code',[ToolController::class,'qrCode'])->name('tool.qr-code');
    Route::post('/qr-code-generate',[ToolController::class,'qrCodeSubmit'])->name('tool.qr-code.submit');
});

Route::prefix('admin')->group(function(){
    Route::prefix('portfolio')->group(function(){
        Route::get('/',[VoyagerPortfolioController::class,'index'])->name('portfolio.index');
        Route::post('/aboutStore',[VoyagerPortfolioController::class,'aboutStore'])->name('portfolio.about.store');
        Route::post('/experienceStore',[VoyagerPortfolioController::class,'experienceStore'])->name('portfolio.experience.store');
        Route::post('/projectStore',[VoyagerPortfolioController::class,'projectStore'])->name('portfolio.project.store');
    });
});



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
