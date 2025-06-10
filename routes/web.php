<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnuncioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\UserController;



//Route::get('/', [HomeController::class, 'Home'])->name('home');


// Detalhes públicos de um anúncio
Route::get('/anuncios/{id}', [AnuncioController::class, 'show'])
     ->name('anuncio.show');

// (Opcional) Lista de anúncios
Route::get('/anuncios-carros', fn() => view('pages.anuncios.cars.search.list'))
     ->name('anuncios-carros');

/*
|--------------------------------------------------------------------------
| Autenticação (apenas para visitantes não autenticados)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Formulário de login
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    // Formulário de registro
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    Route::get('login/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback']);
});

/*
|--------------------------------------------------------------------------
| Logout (apenas usuários autenticados)
|--------------------------------------------------------------------------
*/
Route::post('logout', [LoginController::class, 'logout'])
     ->name('logout')
     ->middleware('auth');

/*
|--------------------------------------------------------------------------
| Rotas Protegidas (apenas usuários autenticados)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Dashboard — liberado para qualquer usuário logado
    Route::view('/dashboard', 'pages.dashboard')->name('dashboard');

    Route::delete('/meus-anuncios/{id}', [AnuncioController::class, 'destroy'])->name('anuncios.destroy');
    // Adicione esta linha para “Meus anúncios”
    Route::get('/meus-anuncios', [AnuncioController::class, 'index'])
         ->name('anuncios.index');

    // Rota para página de Chat:
    Route::get('/chat', [App\Http\Controllers\ChatController::class, 'index'])
        ->name('chat.index');
    // Favoritos

    // Alertas
    Route::get('/alertas', [AlertasController::class, 'index'])
         ->name('alertas.index');


    // Ajuda
    Route::get('/ajuda', [AjudaController::class, 'index'])
         ->name('ajuda');

    // CRUD de usuários → apenas admin (ID = 1)
    Route::middleware('isAdmin')->group(function () {
        Route::resource('users', UserController::class);
    });

    // “Minha Conta” — qualquer usuário logado pode ver
    Route::get('/minha-conta', [AccountController::class, 'index'])
         ->name('minha-conta');
    Route::post('/minha-conta', [AccountController::class, 'update'])
         ->name('minha-conta.update');

    // Tela de escolha de tipo de anúncio
    Route::get('/anunciar', function(){
    return view('pages.anuncios.opcao');
    })->name('anunciar');

   Route::prefix('anunciar/{tipoVeiculo}')
     ->whereIn('tipoVeiculo', ['carro', 'moto'])
     ->group(function () {
        Route::get('/', [AnuncioController::class, 'step1'])->name('anuncio.step1');
        Route::post('/etapa1', [AnuncioController::class, 'step1Post'])->name('anuncio.step1Post');

        Route::get('/etapa2', [AnuncioController::class, 'step2'])->name('anuncio.step2');
        Route::post('/etapa2', [AnuncioController::class, 'step2Post'])->name('anuncio.step2Post');

        Route::get('/etapa3', [AnuncioController::class, 'step3'])->name('anuncio.step3');
        Route::post('/etapa3', [AnuncioController::class, 'step3Post'])->name('anuncio.step3Post');

        Route::get('/etapa4', [AnuncioController::class, 'step4'])->name('anuncio.step4');
        Route::post('/etapa4', [AnuncioController::class, 'step4Post'])->name('anuncio.step4Post');
    });

    // Tela de confirmação final (GET)
    Route::get('/anuncio/finalizar', [AnuncioController::class, 'finalizar'])
         ->name('anuncio.finalizar');
    // POST para salvar o anúncio com fotos
    Route::post('/anuncio/confirmar', [AnuncioController::class, 'confirmarAnuncio'])
         ->name('anuncio.confirmar');
});

/*
|--------------------------------------------------------------------------
| Rotas para reset de senha (fora de “auth/isAdmin”)
|--------------------------------------------------------------------------
*/
Route::get('password/forgot', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])
     ->name('password.request');
Route::post('password/email', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])
     ->name('password.email');
Route::get('password/reset/{token}', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])
     ->name('password.reset');
Route::post('password/reset', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])
     ->name('password.update');



Route::get('/anuncios/{id}', [AnuncioController::class, 'show'])->name('anuncio.show');




Route::middleware(['location'])->group(function () {
    Route::get('/', [HomeController::class, 'Home'])->name('home');
    Route::get('/search', [SearchController::class, 'index'])->name('search.index');
});


Route::post('/definir-localizacao', [LocationController::class, 'store'])
     ->name('location.store');

