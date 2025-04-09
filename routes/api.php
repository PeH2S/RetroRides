<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// API de autenticação
Route::prefix('auth')->group(function () {
    Route::post('/registrar', [AuthController::class, 'register'])->name('auth.registrar');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('auth.logout');
    Route::get('/perfil', [AuthController::class, 'profile'])->middleware('auth:api')->name('auth.perfil');
});


// API de criação de usuários (se for separada do AuthController)
Route::post('/usuarios/cadastro', [UserController::class, 'store'])->name('users.store');


Route::get('/models/{brand}', function ($brandId) {
    return CarModel::where('brand_id', $brandId)->get(['id', 'name']);
});

Route::get('/years/{model}', function ($modelId) {
    return ModelYear::where('car_model_id', $modelId)->get(['id', 'year']);
});

