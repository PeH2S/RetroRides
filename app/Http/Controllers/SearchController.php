<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use App\Services\NominatimService;

class SearchController extends Controller
{

    protected $nominatim;

    public function __construct(NominatimService $nominatim)
    {
        $this->nominatim = $nominatim;
    }


    public function index(Request $request)
    {
        $query = Anuncio::query();

        $latitude = null;
        $longitude = null;
        $raioKm = $request->input('distance', 100);
        $location = [
            'cidade' => '',
            'estado' => '',
            'user_provided' => false
        ];

        if ($request->filled('q')) {
            $termos = explode('-', Str::slug($request->q));
            $query->where(function ($q) use ($termos) {
                foreach ($termos as $termo) {
                    $q->orWhere('marca', 'like', "%{$termo}%")
                        ->orWhere('modelo', 'like', "%{$termo}%");
                }
            });
        }
        if ($request->filled('location')) {
            $cityData = $this->nominatim->geocodeCity($request->input('location'));

            if ($cityData) {
                $latitude = $cityData['lat'];
                $longitude = $cityData['lng'];
                $location['cidade'] = $cityData['cidade'];
                $location['estado'] = $cityData['estado'];
                $location['user_provided'] = true;

                Session::put('user_location', [
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'cidade' => $cityData['cidade'],
                    'estado' => $cityData['estado'],
                ]);
            }
        }

        if (!$latitude && $request->filled('localizacao')) {
            [$coords, $radius] = explode('x', $request->localizacao);
            [$latitude, $longitude] = explode(',', $coords);
            $raioKm = floatval($radius);
        } elseif (!$latitude && Session::has('user_location')) {
            $userLocation = Session::get('user_location');
            $latitude = $userLocation['latitude'] ?? null;
            $longitude = $userLocation['longitude'] ?? null;
            $raioKm = $request->input('distance', 100);
        }




        if ($request->filled('detalhes')) {
            foreach ($request->input('detalhes') as $filtro) {
                $query->where('detalhes', 'LIKE', '%' . $filtro . '%');
            }
        }

        if ($request->filled('condicao')) {
            $query->WhereIn('situacao', $request->condicao);
        } else {
            $query->whereIn('situacao', ['Usado', 'Novo', 'Seminovo']);
        }

        if ($request->filled('ano_de')) {
            $query->where('ano_modelo', '>=', intval($request->input('ano_de')));
        }

        if ($request->filled('ano_ate')) {
            $query->where('ano_modelo', '<=', intval($request->input('ano_ate')));
        }



        switch ($request->input('sort', '')) {
            case 'Menor preço':
                $query->orderBy('preco', 'asc');
                break;
            case 'Maior preço':
                $query->orderBy('preco', 'desc');
                break;
            case 'Mais novos':
                $query->orderBy('ano_modelo', 'desc');
                break;
            default:
                break;
        }


        $anuncios = $query->get();

        if ($latitude !== null && $longitude !== null) {
            $anuncios = $anuncios->map(function ($anuncio) use ($latitude, $longitude) {
                $distancia = $this->calcularDistancia(
                    $latitude,
                    $longitude,
                    $anuncio->latitude,
                    $anuncio->longitude
                );

                $anuncio->distancia = $distancia;
                return $anuncio;
            })
                ->sortBy('distancia');
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 15;
        $currentItems = $anuncios->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $anuncios = new LengthAwarePaginator(
            $currentItems,
            $anuncios->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );


        if (Session::has('user_location')) {
            $userLocation = Session::get('user_location');
            if (isset($userLocation['cidade'], $userLocation['estado'])) {
                $location['cidade'] = $userLocation['cidade'];
                $location['estado'] = $userLocation['estado'];
            }
        }



        return view('pages.anuncios.cars.search.list', compact('anuncios', 'location'));
    }


    private function calcularDistancia($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
