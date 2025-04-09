<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

// Página inicial
Route::get('/inicio', [HomeController::class, 'homePage'])->name('inicio');

// Página de login (exibe a view)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Página de cadastro (exibe o formulário de cadastro de usuário)
Route::get('/usuarios/cadastro', [UserController::class, 'create'])->name('users.create');

// Rotas de anúncios SEM autenticação (removi o middleware)
Route::resource('listings', ListingController::class);


Route::get('/buscar', [SearchController::class, 'index'])->name('search.index');
