<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarDataController;

Route::get('/marcas', [CarDataController::class, 'getBrands']);
Route::get('/modelos/{brandId}', [CarDataController::class, 'getModels']);
Route::get('/anos/{brandId}/{modelId}', [CarDataController::class, 'getYears']);
Route::get('/versoes/{brandId}/{modelId}/{yearId}', [CarDataController::class, 'getVersions']);
