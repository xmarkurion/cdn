<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});



// Laravel UI Auth routes - disable register/signup
Auth::routes(['register' => false]);

//group function with auth middleware
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //Create images
    Route::get('/images/create', [App\Http\Controllers\ImageController::class, 'create'])->name('images.create');
    Route::post('/images/store', [App\Http\Controllers\ImageController::class, 'store'])->name('images.store');

    Route::get('/images/resize/{id}', [App\Http\Controllers\ImageController::class, 'resize'])->name('images.resize');
});

Route::get('/images/{id}', [App\Http\Controllers\ImageController::class, 'fullSizeImageDownload'])->name('images.download');
Route::get('/images/{id}/thumb', [App\Http\Controllers\ImageController::class, 'thumbImageDownload'])->name('images.thumb.download');


