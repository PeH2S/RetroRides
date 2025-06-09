<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\VehicleApiService;
use Illuminate\Http\Request;

class VehicleDataController extends Controller
{
    protected $vehicleApiService;

    public function __construct(VehicleApiService $vehicleApiService)
    {
        $this->vehicleApiService = $vehicleApiService;
    }

    public function getBrands(Request $request)
    {
         $vehicleType = $request->query('tipo'); 
        $brands = $this->vehicleApiService->getBrands($vehicleType);
        return response()->json($brands);
    }

    public function getModels(Request $request, $brandId)
    {
        $vehicleType = $request->query('tipo');

        if (!$brandId || $brandId === 'undefined') {
            return response()->json(['error' => 'Brand ID é obrigatório'], 400);
        }

        $models = $this->vehicleApiService->getModels($brandId, $vehicleType);

        $filteredModels = array_filter($models, function ($model) {
            return !empty($model['code']) && !empty($model['name']);
        });

        return response()->json(array_values($filteredModels));
    }

    public function getYears(Request $request, $brandId, $modelId)
    {
        $vehicleType = $request->query('tipo');

        $years = $this->vehicleApiService->getYears($brandId, $modelId, $vehicleType);
        return response()->json($years);
    }

    public function getDetails(Request $request, $brandId, $modelId, $yearId)
    {
        $vehicleType = $request->query('tipo');
        $versions = $this->vehicleApiService->getVehicleDetails($brandId, $modelId, $yearId, $vehicleType);
        return response()->json($versions);
    }


    
}
