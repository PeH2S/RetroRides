<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;


class SearchController extends Controller
{
    protected $anuncioController;

    public function __construct(AnuncioController $anuncioController)
    {
        $this->anuncioController = $anuncioController;
    }

    public function index(Request $request)
    {
        $query = Anuncio::query();

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('marca', 'like', "%{$request->q}%")
                  ->orWhere('modelo', 'like', "%{$request->q}%");
            });
        }

        $latitude = null;
        $longitude = null;
        $raioKm = 100;

        if ($request->filled('localizacao')) {
            [$coords, $radius] = explode('x', $request->localizacao);
            [$latitude, $longitude] = explode(',', $coords);
            $raioKm = floatval($radius);
        } elseif (Session::has('user_location')) {
            $userLocation = Session::get('user_location');
            $latitude = $userLocation['latitude'] ?? null;
            $longitude = $userLocation['longitude'] ?? null;
        }

        if ($latitude !== null && $longitude !== null) {
            $anuncios = $this->anuncioController->anunciosProximos($latitude, $longitude, $raioKm);

            if ($request->filled('q')) {
                $anuncios = $anuncios->filter(function($anuncio) use ($request) {
                    return str_contains(strtolower($anuncio->marca), strtolower($request->q))
                        || str_contains(strtolower($anuncio->modelo), strtolower($request->q));
                });
            }

            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $perPage = 15;
            $currentItems = $anuncios->slice(($currentPage - 1) * $perPage, $perPage)->values();

            $anuncios = new \Illuminate\Pagination\LengthAwarePaginator(
                $currentItems,
                $anuncios->count(),
                $perPage,
                $currentPage,
                ['path' => $request->url(), 'query' => $request->query()]
            );

        } else {
            $anuncios = $query->paginate(15);
        }

        return view('pages.anuncios.cars.search.list', compact('anuncios'));

    }
}
