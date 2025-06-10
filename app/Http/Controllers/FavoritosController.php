<?php

namespace App\Http\Controllers;  // <-- certifique-se deste namespace

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Anuncio;
use App\Http\Controllers\Controller;

class FavoritosController extends Controller    // <-- estende Controller
{
    public function __construct()
    {
        // este método só existe porque estendemos o Controller correto
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
