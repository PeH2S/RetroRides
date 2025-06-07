<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class NominatimService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://nominatim.openstreetmap.org/',
            'verify' => config('app.env') === 'local' ? false : storage_path('certs/cacert.pem'),
            'headers' => [
                'User-Agent' => 'YourApp/1.0 (contact@yourapp.com)',
            ],
        ]);
    }

    public function reverseGeocode(float $latitude, float $longitude): ?array
    {
        try {
            $response = $this->client->get('reverse', [
                'query' => [
                    'format' => 'json',
                    'lat' => $latitude,
                    'lon' => $longitude,
                    'addressdetails' => 1,
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error("Geocoding failed: " . $e->getMessage());
            return null;
        }
    }
    public function geocodeCity(string $city): ?array
    {
        try {
            $response = $this->client->get('search', [
                'query' => [
                    'format' => 'json',
                    'q' => $city,
                    'limit' => 1,
                    'addressdetails' => 1,
                ]
            ]);

            $results = json_decode($response->getBody(), true);

            if (!empty($results[0])) {
                return [
                    'lat' => $results[0]['lat'],
                    'lng' => $results[0]['lon'],
                    'cidade' => $results[0]['address']['city'] ?? $results[0]['address']['town'] ?? '',
                    'estado' => $results[0]['address']['state'] ?? '',
                ];
            }
        } catch (\Exception $e) {
            Log::error("City geocoding failed: " . $e->getMessage());
        }

        return null;
    }
}
