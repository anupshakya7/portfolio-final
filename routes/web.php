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
Route::prefix('tools')->name('tool.')->group(function(){
    Route::get('/', [ToolController::class,'index'])->name('index');    

    //GPA Converter
    Route::get('/gpa-calculator',[ToolController::class,'gpaCalculator'])->name('gpa-calculator');

    //Generate QR Code
    Route::get('/qr-code-generator',[ToolController::class,'qrCode'])->name('qr-code');
    Route::post('/qr-code-generate',[ToolController::class,'qrCodeSubmit'])->name('qr-code.submit')->middleware('throttle:5,1');

    //Sitemap Generator
    Route::get('/sitemap-generator',[ToolController::class, 'siteMap'])->name('sitemap.generate');
    Route::post('/sitemap-generate',[ToolController::class, 'siteMapSubmit'])->name('sitemap.generate.submit')->middleware('throttle:5,1');

    //Robot Generator
    Route::get('/robots-generator',[ToolController::class, 'robot'])->name('robots.index');
    Route::get('/robots-generator/generate',[ToolController::class, 'robotGenerate'])->name('robots.generate');
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
