<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Página inicial
Route::get('/inicio', [HomeController::class, 'homePage'])->name('inicio');

// Página de login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Página de cadastro (view)
Route::get('/usuarios/cadastro', [UserController::class, 'create'])->name('register');
Route::post('/usuarios/cadastro', [UserController::class, 'store'])->name('users.store');

// Autenticação via API
Route::prefix('auth')->group(function () {
    Route::post('/registrar', [AuthController::class, 'register'])->name('auth.registrar');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
});

// Rotas protegidas
Route::middleware('auth:api')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/perfil', [AuthController::class, 'profile'])->name('auth.perfil');
});