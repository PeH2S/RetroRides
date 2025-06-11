<?php

namespace App\Http\Controllers;  

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Anuncio;
use App\Http\Controllers\Controller;

class FavoritosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $favoritos = Auth::user()
                         ->favoritos()
                         ->with('fotos')
                         ->get();

        return view('pages.favoritos.index', compact('favoritos'));
    }

    public function store(Anuncio $anuncio)
    {
        $user = Auth::user();
        if (! $user->favoritos->contains($anuncio->id)) {
            $user->favoritos()->attach($anuncio->id);
        }
        return back();
    }

    public function destroy(Anuncio $anuncio)
    {
        Auth::user()->favoritos()->detach($anuncio->id);
        return back();
    }
}
