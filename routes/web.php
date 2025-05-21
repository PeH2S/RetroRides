<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnuncioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'Home'])->name('home');


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
