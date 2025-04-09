<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/usuarios/cadastro', [UserController::class, 'create'])->name('users.create');
Route::post('/usuarios', [UserController::class, 'store'])->name('users.store');

// Página de exibição dos usuários cadastrados
Route::get('/usuarios', [UserController::class, 'index'])->name('users.index');

// Editar um usuário
Route::get('/usuarios/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('users.update');  

// Ver detalhes de um usuário
Route::get('/usuarios/{id}', [UserController::class, 'show'])->name('users.show');

// Excluir um usuário
Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Página inicial
Route::get('/inicio', [HomeController::class, 'homePage'])->name('inicio');



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');


Route::middleware(['auth'])->group(function () {
    Route::get('/anuncios/novo', [ListingController::class, 'create'])->name('listings.create');
    Route::post('/anuncios', [ListingController::class, 'store'])->name('listings.store');
});

Route::get('/buscar', [SearchController::class, 'index'])->name('search.index');

