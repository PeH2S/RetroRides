<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'Home'])->name('home');


Route::get('/anunciar', function(){
    return view('pages.anuncios.opcao');
})->name('anunciar');

Route::get('/anunciar/carro', function(){
    return view('pages.anuncios.cars.create');
})->name('anunciar-carros');
