<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnuncioController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\MensagemController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FavoritosController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'Home'])->name('home');
Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/anuncios/{id}', [AnuncioController::class, 'show'])->name('anuncio.show');

/*
|--------------------------------------------------------------------------
| Autenticação
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('login',    [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login',   [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register',[RegisterController::class, 'register']);
    Route::get('login/google',          [GoogleController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('login/google/callback', [GoogleController::class, 'handleGoogleCallback']);
});

Route::post('logout', [LoginController::class, 'logout'])
     ->name('logout')
     ->middleware('auth');

/*
|--------------------------------------------------------------------------
| Rotas Protegidas
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Chat & Mensagens
    Route::post('/mensagens', [MensagemController::class, 'store']);
    Route::get('/conversas/{conversa}', [ChatController::class, 'show'])->name('conversas.show');
    Route::get('/conversas/{conversa}/mensagens/check', function(\App\Models\Conversa $c) {
        return response()->json(['total' => $c->mensagens()->count()]);
    });
    Route::post('/conversas/{conversa}/atualizar-status', [ChatController::class, 'atualizarStatus'])->name('conversas.atualizar-status');
    Route::post('/chat/iniciar', [ChatController::class, 'store'])->name('chat.store');
    Route::get('/chats', [ChatController::class, 'index'])->name('chat.index');

    // Dashboard & Minha Conta
    Route::get('/dashboard',          [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/account',  [DashboardController::class, 'account'])->name('dashboard.account');
    Route::post('/dashboard/account', [AccountController::class,   'update'])->name('dashboard.account.update');

    // Meus Anúncios
    Route::get('/meus-anuncios',                    [AnuncioController::class, 'index'])->name('anuncios.index');
    Route::delete('/meus-anuncios/{id}',            [AnuncioController::class, 'destroy'])->name('anuncios.destroy');
    Route::get('/meus-anuncios/{id}/editar',        [AnuncioController::class, 'edit'])->name('anuncios.edit');
    Route::put('/meus-anuncios/{id}',               [AnuncioController::class, 'update'])->name('anuncios.update');
    Route::patch('/meus-anuncios/status/{anuncio}', [AnuncioController::class, 'updateStatus'])->name('anuncios.update-status');

    // Criar Anúncio
    Route::get('/anunciar', fn() => view('pages.anuncios.opcao'))->name('anunciar');
    Route::prefix('anunciar/{tipoVeiculo}')
         ->whereIn('tipoVeiculo', ['carro','moto'])
         ->group(function(){
             Route::get('/',        [AnuncioController::class, 'step1'])->name('anuncio.step1');
             Route::post('/etapa1', [AnuncioController::class, 'step1Post'])->name('anuncio.step1Post');
             Route::get('/etapa2',  [AnuncioController::class, 'step2'])->name('anuncio.step2');
             Route::post('/etapa2', [AnuncioController::class, 'step2Post'])->name('anuncio.step2Post');
             Route::get('/etapa3',  [AnuncioController::class, 'step3'])->name('anuncio.step3');
             Route::post('/etapa3', [AnuncioController::class, 'step3Post'])->name('anuncio.step3Post');
             Route::get('/etapa4',  [AnuncioController::class, 'step4'])->name('anuncio.step4');
             Route::post('/etapa4', [AnuncioController::class, 'step4Post'])->name('anuncio.step4Post');
         });
    Route::get('/anuncio/finalizar',  [AnuncioController::class, 'finalizar'])->name('anuncio.finalizar');
    Route::post('/anuncio/confirmar', [AnuncioController::class, 'confirmarAnuncio'])->name('anuncio.confirmar');

    // Favoritos & Avaliações
    Route::get('/favoritos', [App\Http\Controllers\FavoritosController::class, 'index'])
     ->name('favoritos.index');
    Route::post('/favoritos/{anuncio}',          [FavoritosController::class, 'store'])->name('favoritos.store');
    Route::delete('/favoritos/{anuncio}',        [FavoritosController::class, 'destroy'])->name('favoritos.destroy');
    Route::post('/anuncios/{anuncio}/favoritar', [FavoritosController::class, 'toggle'])->name('favoritos.toggle');
    Route::post('/anuncios/{anuncio}/avaliar',   [AvaliacaoController::class, 'store'])->name('avaliacoes.store');

    // CRUD Usuários (Admin)
    Route::middleware('isAdmin')->group(function(){
        Route::resource('users', UserController::class);
    });
});

/*
|--------------------------------------------------------------------------
| Reset de Senha
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
