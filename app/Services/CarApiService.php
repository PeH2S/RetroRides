<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class CarApiService
{
    protected $baseUrl;
    protected $cacheTime;
    protected $headers;
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = 'https://parallelum.com.br/fipe/api/v2'; // URL corrigida da API FIPE
        $this->cacheTime = now()->addHours(24); // Cache de 24 horas
        $this->headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];
    }

    public function getBrands($vehicleType = 'cars')
    {
        try {
            return Cache::remember("fipe_brands_{$vehicleType}", $this->cacheTime, function () use ($vehicleType) {
                $response = $this->client->get("{$this->baseUrl}/{$vehicleType}/brands", [
                    'headers' => $this->headers,
                    'verify' => false
                ]);

                if ($response->getStatusCode() === 200) {
                    return json_decode($response->getBody()->getContents(), true);
                }
                return [];
            });
        } catch (\Exception $e) {
            Log::error('Erro ao buscar marcas', [
                'message' => $e->getMessage(),
                'vehicleType' => $vehicleType
            ]);
            return [];
        }
    }

    public function getModels($brandId, $vehicleType = 'cars')
    {
        try {
            return Cache::remember("fipe_models_{$vehicleType}_{$brandId}", $this->cacheTime, function () use ($brandId, $vehicleType) {
                $response = $this->client->get("{$this->baseUrl}/{$vehicleType}/brands/{$brandId}/models", [
                    'headers' => $this->headers,
                    'verify' => false
                ]);

                if ($response->getStatusCode() === 200) {
                    return json_decode($response->getBody()->getContents(), true);
                }
                return [];
            });
        } catch (\Exception $e) {
            Log::error('Erro ao buscar modelos', [
                'message' => $e->getMessage(),
                'brandId' => $brandId,
                'vehicleType' => $vehicleType
            ]);
            return [];
        }
    }

    public function getYears($brandId, $modelId, $vehicleType = 'cars')
    {
        try {
            return Cache::remember("fipe_years_{$vehicleType}_{$brandId}_{$modelId}", $this->cacheTime, function () use ($brandId, $modelId, $vehicleType) {
                $response = $this->client->get("{$this->baseUrl}/{$vehicleType}/brands/{$brandId}/models/{$modelId}/years", [
                    'headers' => $this->headers,
                    'verify' => false
                ]);

                if ($response->getStatusCode() === 200) {
                    return json_decode($response->getBody()->getContents(), true);
                }
                return [];
            });
        } catch (\Exception $e) {
            Log::error('Erro ao buscar anos', [
                'message' => $e->getMessage(),
                'brandId' => $brandId,
                'modelId' => $modelId,
                'vehicleType' => $vehicleType
            ]);
            return [];
        }
    }

    public function getVehicleDetails($brandId, $modelId, $yearId, $vehicleType = 'cars')
    {
        try {
            $cacheKey = "fipe_details_{$vehicleType}_{$brandId}_{$modelId}_{$yearId}";

            return Cache::remember($cacheKey, $this->cacheTime, function () use ($brandId, $modelId, $yearId, $vehicleType) {
                $response = $this->client->get("{$this->baseUrl}/{$vehicleType}/brands/{$brandId}/models/{$modelId}/years/{$yearId}", [
                    'headers' => $this->headers,
                    'verify' => false
                ]);

                if ($response->getStatusCode() === 200) {
                    return json_decode($response->getBody()->getContents(), true);
                }
                return null;
            });
        } catch (\Exception $e) {
            Log::error('Erro ao buscar detalhes do veículo', [
                'message' => $e->getMessage(),
                'brandId' => $brandId,
                'modelId' => $modelId,
                'yearId' => $yearId,
                'vehicleType' => $vehicleType
            ]);
            return null;
        }
    }
}
