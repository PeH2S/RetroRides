<?php

namespace App\Http\Controllers\Api;

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

    public function getModels($brandId)
    {
        $models = $this->carApiService->getModels($brandId);
        return response()->json($models);
    }

    public function getYears($brandId, $modelId)
    {
        $years = $this->carApiService->getYears($brandId, $modelId);
        return response()->json($years);
    }

    public function getVersions($brandId, $modelId, $yearId)
    {
        $versions = $this->carApiService->getVersions($brandId, $modelId, $yearId);
        return response()->json($versions);
    }
}
