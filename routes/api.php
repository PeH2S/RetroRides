<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleDataController;

Route::get('/marcas', [VehicleDataController::class, 'getBrands']);
Route::get('/modelos/{brandId}', [VehicleDataController::class, 'getModels']);
Route::get('/anos/{brandId}/{modelId}', [VehicleDataController::class, 'getYears']);
Route::get('/detalhes/{brandId}/{modelId}/{yearId}', [VehicleDataController::class, 'getDetails']);
