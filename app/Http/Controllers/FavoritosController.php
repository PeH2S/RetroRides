<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use App\Models\Favorito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritosController extends Controller
{
    public function toggle(Anuncio $anuncio)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Faça login para favoritar'], 401);
        }

        $favorito = Favorito::where('user_id', Auth::id())
            ->where('anuncio_id', $anuncio->id)
            ->first();

        if ($favorito) {
            $favorito->delete();
            return response()->json(['action' => 'removed', 'count' => $anuncio->favoritadoPor()->count()]);
        } else {
            Favorito::create([
                'user_id' => Auth::id(),
                'anuncio_id' => $anuncio->id
            ]);
            return response()->json(['action' => 'added', 'count' => $anuncio->favoritadoPor()->count()]);
        }
    }

    public function index()
    {
        $favoritos = auth()->user()->anunciosFavoritados()
            ->with(['fotos', 'user'])
            ->paginate(10);

        return view('pages.favoritos.index', compact('favoritos'));
    }
}
