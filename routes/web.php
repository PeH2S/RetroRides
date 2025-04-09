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

<<<<<<< HEAD


Route::resource("Marcas", MarcaController::class);
=======
// Página de cadastro (exibe o formulário de cadastro de usuário)
Route::get('/usuarios/cadastro', [UserController::class, 'create'])->name('users.create');
>>>>>>> F_B01
