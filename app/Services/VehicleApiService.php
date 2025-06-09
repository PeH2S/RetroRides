<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;


class VehicleApiService
{
    protected $baseUrl;
    protected $cacheHours;
    protected $headers;
    protected $client;
    protected $cacheTime;


    const DEFAULT_VEHICLE_TYPE = 'cars';
    const CACHE_PREFIX = 'fipe_';
    const CACHE_HOURS = 24;

    const VEHICLE_TYPES = [
        'carro' => 'cars',
        'moto' => 'motorcycles'
    ];

    public function __construct(Client $client = null)
    {
        $this->client = $client ?? new Client();
        $this->baseUrl = 'https://fipe.parallelum.com.br/api/v2';
        $this->cacheHours = self::CACHE_HOURS;
        $this->cacheTime = now()->addHours($this->cacheHours);
        $this->headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        if ($token = env('FIPE_API_TOKEN')) {
            $this->headers['X-Subscription-Token'] = $token;
        }
    }

    protected function getVehicleType($typeFromRequest)
    {
        return self::VEHICLE_TYPES[strtolower($typeFromRequest)] ?? self::DEFAULT_VEHICLE_TYPE;
    }

    public function getBrands($vehicleType = null)
    {
        $vehicleType = $this->getVehicleType($vehicleType);
        $cacheKey = self::CACHE_PREFIX . "brands_{$vehicleType}";

        return Cache::remember($cacheKey, now()->addHours($this->cacheHours), function () use ($vehicleType) {
            try {
                $response = $this->client->get("{$this->baseUrl}/{$vehicleType}/brands", [
                    'headers' => $this->headers,
                    'verify' => false
                ]);

                return $response->getStatusCode() === 200
                    ? json_decode($response->getBody()->getContents(), true)
                    : [];
            } catch (\Exception $e) {
                Log::error('Erro ao buscar marcas', [
                    'message' => $e->getMessage(),
                    'vehicleType' => $vehicleType
                ]);
                return [];
            }
        });
    }


    public function getModels($brandId, $vehicleType)
    {
        $vehicleType = $this->getVehicleType($vehicleType);
        try {
            return Cache::remember("fipe_models_{$vehicleType}_{$brandId}", $this->cacheTime, function () use ($brandId, $vehicleType) {
                $response = $this->client->get("{$this->baseUrl}/{$vehicleType}/brands/{$brandId}/models", [
                    'headers' => $this->headers,
                    'verify' => false
                ]);

                if ($response->getStatusCode() === 200) {
                    $data = json_decode($response->getBody()->getContents(), true);

                    return array_map(function ($item) {
                        return [
                            'code' => $item['code'] ?? $item['codigo'] ?? null,
                            'name' => $item['name'] ?? $item['nome'] ?? null
                        ];
                    }, $data);
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

    public function getYears($brandId, $modelId, $vehicleType)
    {

        $vehicleType = $this->getVehicleType($vehicleType);
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

    public function getVehicleDetails($brandId, $modelId, $yearId, $vehicleType)
    {
        $vehicleType = $this->getVehicleType($vehicleType);
        
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
