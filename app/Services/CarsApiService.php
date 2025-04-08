<?php
namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use App\Models\Brand;
use App\Models\CarModel;
use App\Models\ModelYear;
use App\Models\VehicleDetail;
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


    public function fetchAndStoreBrands()
    {
        try {
            $response = $this->client->get("{$this->baseUrl}/cars/brands", [
                'headers' => $this->headers,
                'verify' => false
            ]);

            if ($response->getStatusCode() === 200) {
                $brands = json_decode($response->getBody(), true);

                foreach ($brands as $brandData) {
                    $brand = Brand::updateOrCreate(
                        ['api_id' => $brandData['code']],
                        ['name' => $brandData['name']]
                    );

                    $this->fetchAndStoreModelsForBrand($brand->api_id);
                }
                return true;
            }
        } catch (\Exception $e) {
            Log::error('Erro ao buscar marcas', ['message' => $e->getMessage()]);
        }
        return false;
    }

    public function fetchAndStoreModelsForBrand($brandApiId)
    {
        try {
            $brand = Brand::where('api_id', $brandApiId)->first();
            if (!$brand) return false;

            $response = $this->client->get("{$this->baseUrl}/cars/brands/{$brandApiId}/models", [
                'headers' => $this->headers,
                'verify' => false
            ]);

            if ($response->getStatusCode() === 200) {
                $models = json_decode($response->getBody(), true);

                foreach ($models as $modelData) {
                    $model = CarModel::updateOrCreate(
                        ['api_id' => $modelData['code'], 'brand_id' => $brand->id],
                        ['name' => $modelData['name']]
                    );

                    $this->fetchAndStoreYearsForModel($brandApiId, $model->api_id);
                }
                return true;
            }
        } catch (\Exception $e) {
            Log::error("Erro ao buscar modelos para marca {$brandApiId}", [
                'message' => $e->getMessage()
            ]);
        }
        return false;
    }

    public function fetchAndStoreYearsForModel($brandApiId, $modelApiId)
    {
        try {
            $model = CarModel::where('api_id', $modelApiId)->first();
            if (!$model) return false;

            $response = $this->client->get("{$this->baseUrl}/cars/brands/{$brandApiId}/models/{$modelApiId}/years", [
                'headers' => $this->headers,
                'verify' => false
            ]);

            if ($response->getStatusCode() === 200) {
                $years = json_decode($response->getBody(), true);

                foreach ($years as $yearData) {
                    $year = ModelYear::updateOrCreate(
                        ['code' => $yearData['code'], 'car_model_id' => $model->id],
                        ['year' => $yearData['name']]
                    );

                    $this->fetchAndStoreVehicleDetails($brandApiId, $modelApiId, $year->code);
                }
                return true;
            }
        } catch (\Exception $e) {
            Log::error("Erro ao buscar anos para modelo {$modelApiId}", [
                'message' => $e->getMessage()
            ]);
        }
        return false;
    }

    public function fetchAndStoreVehicleDetails($brandApiId, $modelApiId, $yearCode)
    {
        try {
            $year = ModelYear::where('code', $yearCode)
                ->whereHas('carModel', fn($q) => $q->where('api_id', $modelApiId))
                ->first();

            if (!$year) return false;

            $response = $this->client->get("{$this->baseUrl}/cars/brands/{$brandApiId}/models/{$modelApiId}/years/{$yearCode}", [
                'headers' => $this->headers,
                'verify' => false
            ]);

            if ($response->getStatusCode() === 200) {
                $detailData = json_decode($response->getBody(), true);

                VehicleDetail::updateOrCreate(
                    ['model_year_id' => $year->id],
                    [
                        'fipe_code' => $detailData['codeFipe'],
                        'fuel' => $detailData['fuel'],
                        'fuel_acronym' => $detailData['fuelAcronym'],
                        'price' => $this->parsePrice($detailData['price']),
                        'model_year' => $detailData['modelYear'],
                        'reference_month' => $detailData['referenceMonth']
                    ]
                );
                return true;
            }
        } catch (\Exception $e) {
            Log::error("Erro ao buscar detalhes para ano {$yearCode}", [
                'message' => $e->getMessage()
            ]);
        }
        return false;
    }

    private function parsePrice($priceString)
    {
        return (float) preg_replace(['/R\$/', '/\./', '/,/'], ['', '', '.'], $priceString);
    }
}
