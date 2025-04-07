<?php
namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use App\Models\Brand;
use App\Models\CarModel;

class CarsApiService
{
    protected $client;
    protected $baseUrl;
    protected $headers;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = 'https://fipe.parallelum.com.br/api/v2';
        $this->headers = [
            'X-Subscription-Token' => env('FIPE_API_TOKEN'),
            'Accept' => 'application/json'
        ];
    }

    public function fetchAndStoreModelsForBrand($brandId)
    {
        try {
            $response = $this->client->get("{$this->baseUrl}/cars/brands/{$brandId}/models", [
                'headers' => $this->headers,
                'verify' => false
            ]);

            $statusCode = $response->getStatusCode();
            $body = json_decode($response->getBody(), true);

            Log::info("Requisição GET /cars/brands/{$brandId}/models", [
                'status' => $statusCode,
                'response' => $body,
                'verify' => false
            ]);

            if ($statusCode === 200) {
                $models = $body['models'] ?? $body;

                foreach ($models as $model) {
                    CarModel::updateOrCreate(
                        ['api_id' => $model['code']],
                        [
                            'brand_id' => $brandId,
                            'name' => $model['name'],
                        ]
                    );
                }

                return true;
            }
        } catch (\Exception $e) {
            Log::error("Erro na requisição GET /cars/brands/{$brandId}/models", [
                'message' => $e->getMessage()
            ]);
        }
        return false;
    }

    public function fetchAndStoreBrands()
    {
        try {
            $response = $this->client->get("{$this->baseUrl}/cars/brands", [
                'headers' => $this->headers,
                'verify' => false
            ]);

            $statusCode = $response->getStatusCode();
            $body = json_decode($response->getBody(), true);

            Log::info('Requisição GET /cars/brands', [
                'status' => $statusCode,
                'response' => $body,
                'verify' => false
            ]);

            if ($statusCode === 200) {
                foreach ($body as $brand) {
                    Brand::updateOrCreate(
                        ['api_id' => $brand['code']],
                        ['name' => $brand['name']]
                    );

                    $this->fetchAndStoreModelsForBrand($brand['code']);

                }
                return true;
            }
        } catch (\Exception $e) {
            Log::error('Erro na requisição GET /cars/brands', [
                'message' => $e->getMessage()
            ]);
        }
        return false;
    }
}
