<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class SearchController extends Controller
{

    public function index(Request $request)
    {
        $query = Anuncio::query();

        $latitude = null;
        $longitude = null;
        $raioKm = 100;

        if ($request->filled('q')) {
            $termos = explode('-', Str::slug($request->q));
            $query->where(function ($q) use ($termos) {
                foreach ($termos as $termo) {
                    $q->orWhere('marca', 'like', "%{$termo}%")
                        ->orWhere('modelo', 'like', "%{$termo}%");
                }
            });
        }

        if ($request->filled('localizacao')) {
            [$coords, $radius] = explode('x', $request->localizacao);
            [$latitude, $longitude] = explode(',', $coords);
            $raioKm = floatval($radius);
        } elseif (Session::has('user_location')) {
            $userLocation = Session::get('user_location');
            $latitude = $userLocation['latitude'] ?? null;
            $longitude = $userLocation['longitude'] ?? null;
            $raioKm = $request->input('distance', 100);
        }

        

        if($request->filled('detalhes')) {
            foreach($request->input('detalhes') as $filtro){
                $query->where('detalhes', 'LIKE', '%' .$filtro. '%');
            }
        }

        if($request->filled('situacao')){
            $query->WhereIn('situacao');
        }

        if ($request->filled('ano_de')) {
            $query->where('ano_modelo', '>=', intval($request->input('ano_de')));
        }

        if ($request->filled('ano_ate')) {
            $query->where('ano_modelo', '<=', intval($request->input('ano_de')));
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

        if ($request->filled('localizacao')) {
            [$coords, $radius] = explode('x', $request->localizacao);
            [$latitude, $longitude] = explode(',', $coords);
            $raioKm = floatval($radius);
        } elseif (Session::has('user_location')) {
            $userLocation = Session::get('user_location');
            $latitude = $userLocation['latitude'] ?? null;
            $longitude = $userLocation['longitude'] ?? null;
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

        $location = [
            'cidade' => '',
            'estado' => ''
        ];
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
