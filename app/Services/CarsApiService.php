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

    public function fetchAndStoreBrands()
    {
        try {
            $response = $this->client->get("{$this->baseUrl}/cars/brands", [
                'headers' => $this->headers
            ]);

            $statusCode = $response->getStatusCode();
            $body = json_decode($response->getBody(), true);

            Log::info('Requisição GET /cars/brands', [
                'status' => $statusCode,
                'response' => $body
            ]);

            if ($statusCode === 200) {
                foreach ($body as $brand) {
                    Brand::updateOrCreate(
                        ['id' => $brand['code']], // ID único
                        ['name' => $brand['name']]
                    );
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
