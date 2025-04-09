<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Página inicial
Route::get('/inicio', [HomeController::class, 'homePage'])->name('inicio');


// Página de login (exibe a view)
Route::get('/login', function () {
    return view('auth.login'); // resources/views/auth/login.blade.php
})->name('login');


// Página de cadastro (exibe o formulário de cadastro de usuário)
Route::get('/usuarios/cadastro', [UserController::class, 'create'])->name('users.create');


Route::middleware(['auth'])->group(function () {
    Route::get('/anuncios/novo', [ListingController::class, 'create'])->name('listings.create');
    Route::post('/anuncios', [ListingController::class, 'store'])->name('listings.store');
});

Route::get('/buscar', [SearchController::class, 'index'])->name('search.index');

