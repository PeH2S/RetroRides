<?php

namespace App\Http\Controllers;

use App\Services\NominatimService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LocationController extends Controller
{
    public function __construct(
        protected NominatimService $geocoder
    ) {}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $geoData = $this->geocoder->reverseGeocode(
            $validated['latitude'],
            $validated['longitude']
        );

        if (!$geoData) {
            return response()->json(['error' => 'Geocoding failed'], 500);
        }

        Session::put('user_location', [
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'cidade' => $geoData['address']['city'] ?? $geoData['address']['town'] ?? null,
            'estado' => $geoData['address']['state'] ?? null,
        ]);

        return response()->json([
            'cidade' => Session::get('user_location.cidade'),
            'estado' => Session::get('user_location.estado'),
        ]);
    }
}
