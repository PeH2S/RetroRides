<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CarsApiService;

class CarsController extends Controller
{
    protected $carsApiService;

    public function __construct(CarsApiService $carsApiService)
    {
        $this->carsApiService = $carsApiService;
    }

    public function syncBrands()
    {
        if ($this->carsApiService->fetchAndStoreBrands()) {
            return response()->json(['message' => 'Marcas sincronizadas com sucesso!']);
        }
        return response()->json(['error' => 'Erro ao sincronizar marcas.'], 500);
    }

    public function syncModels($brandId)
    {
        if ($this->carsApiService->fetchAndStoreModelsForBrand($brandId)) {
            return response()->json(['message' => 'Modelos sincronizados com sucesso!']);
        }
        return response()->json(['error' => 'Erro ao sincronizar modelos.'], 500);
    }
}
