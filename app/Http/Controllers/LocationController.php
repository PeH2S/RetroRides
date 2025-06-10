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
            'estado' => $this->converterEstadoParaUF($geoData['address']['state'] ?? null),
        ]);

        
        return response()->json([
            'cidade' => Session::get('user_location.cidade'),
            'estado' => Session::get('user_location.estado'),
        ]);
    }

    public function storeByCep(Request $request)
    {
        $data = $request->validate([
            'cidade' => 'required|string',
            'estado' => 'required|string',
        ]);
        session(['user_location' => $data]);
        return response()->json(['sucesso' => true]);
    }

    private function converterEstadoParaUF(?string $estado): ?string
    {
        $ufs = [
            'Acre' => 'AC', 'Alagoas' => 'AL', 'Amapá' => 'AP', 'Amazonas' => 'AM',
            'Bahia' => 'BA', 'Ceará' => 'CE', 'Distrito Federal' => 'DF', 'Espírito Santo' => 'ES',
            'Goiás' => 'GO', 'Maranhão' => 'MA', 'Mato Grosso' => 'MT', 'Mato Grosso do Sul' => 'MS',
            'Minas Gerais' => 'MG', 'Pará' => 'PA', 'Paraíba' => 'PB', 'Paraná' => 'PR',
            'Pernambuco' => 'PE', 'Piauí' => 'PI', 'Rio de Janeiro' => 'RJ', 'Rio Grande do Norte' => 'RN',
            'Rio Grande do Sul' => 'RS', 'Rondônia' => 'RO', 'Roraima' => 'RR', 'Santa Catarina' => 'SC',
            'São Paulo' => 'SP', 'Sergipe' => 'SE', 'Tocantins' => 'TO'
        ];

        return $ufs[$estado] ?? null;
    }

}
