<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\SearchController;
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

Route::get('/home', [CarController::class, 'homePage']);

Route::get('/usuarios/cadastro', [UserController::class, 'create'])->name('users.create');
Route::post('/usuarios/cadastro', [UserController::class, 'store'])->name('users.store');



Route::middleware(['auth'])->group(function () {
    Route::get('/anuncios/novo', [ListingController::class, 'create'])->name('listings.create');
    Route::post('/anuncios', [ListingController::class, 'store'])->name('listings.store');
});

Route::get('/buscar', [SearchController::class, 'index'])->name('search.index');
