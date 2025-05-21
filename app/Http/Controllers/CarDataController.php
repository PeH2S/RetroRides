<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CarApiService;
use Illuminate\Http\Request;

class CarDataController extends Controller
{
    protected $carApiService;

    public function __construct(CarApiService $carApiService)
    {
        $this->carApiService = $carApiService;
    }

    public function getBrands()
    {
        $brands = $this->carApiService->getBrands();
        return response()->json($brands);
    }

    public function getModels(Request $request, $brandId)
    {
        $vehicleType = $request->query('tipo');

        if (!$brandId || $brandId === 'undefined') {
            return response()->json(['error' => 'Brand ID é obrigatório'], 400);
        }

        $models = $this->carApiService->getModels($brandId, $vehicleType);

        $filteredModels = array_filter($models, function ($model) {
            return !empty($model['code']) && !empty($model['name']);
        });

        return response()->json(array_values($filteredModels));
    }

    public function getYears($brandId, $modelId)
    {
        $years = $this->carApiService->getYears($brandId, $modelId);
        return response()->json($years);
    }

    public function getDetails($brandId, $modelId, $yearId)
    {
        $versions = $this->carApiService->getVehicleDetails($brandId, $modelId, $yearId);
        return response()->json($versions);
    }
}
