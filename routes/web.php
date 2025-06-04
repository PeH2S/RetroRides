<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnuncioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SearchController;

//Route::get('/', [HomeController::class, 'Home'])->name('home');

// Formulário e submissão de login (apenas para guests)
Route::middleware('guest')->group(function () {
     // Login (já existente)
    Route::get('login',  [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    // Registro
    Route::get('register',  [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

// Logout (usuário autenticado)
Route::post('logout', [LoginController::class, 'logout'])->name('logout')
     ->middleware('auth');

// Rotas protegidas (exemplo: dashboard)
Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'pages.dashboard')->name('dashboard');
    // ... outras rotas que só o usuário logado pode acessar
});


Route::get('/anunciar', function(){
    return view('pages.anuncios.opcao');
})->name('anunciar');

Route::get('/anunciar/carro', function(){
    return view('pages.anuncios.cars.create.step1');
})->name('anunciar-carros');



Route::get('/anuncio/carro/etapa1', [AnuncioController::class, 'step1'])->name('anuncio.step1');
Route::post('/anuncio/carro/etapa1', [AnuncioController::class, 'step1Post']);

Route::get('/anuncio/carro/etapa2', [AnuncioController::class, 'step2'])->name('anuncio.step2');
Route::post('/anuncio/carro/etapa2', [AnuncioController::class, 'step2Post']);

Route::get('/anuncio/carro/etapa3', [AnuncioController::class, 'step3'])->name('anuncio.step3');
Route::post('/anuncio/carro/etapa3', [AnuncioController::class, 'step3Post']);

Route::get('/anuncio/carro/etapa4', [AnuncioController::class, 'step4'])->name('anuncio.step4');
Route::post('/anuncio/carro/etapa4', [AnuncioController::class, 'step4Post']);

Route::get('/anuncio/finalizar', [AnuncioController::class, 'finalizar'])->name('anuncio.finalizar');
Route::post('/anuncio/confirmar', [AnuncioController::class, 'confirmarAnuncio'])->name('anuncio.confirmar');


Route::get('/anuncios/{id}', [AnuncioController::class, 'show'])->name('anuncio.show');


//mudar
Route::get('/anuncios-carros', function(){
    return view('pages.anuncios.cars.search.list');
})->name('anuncios-carros');


//Route::get('/search', [AnuncioController::class, 'search'])->name('search.cars');


Route::middleware(['location'])->group(function () {
    Route::get('/', [HomeController::class, 'Home'])->name('home');
    Route::get('/search', [SearchController::class, 'index'])->name('search.cars');
});


Route::post('/definir-localizacao', [LocationController::class, 'store'])
     ->name('location.store');
