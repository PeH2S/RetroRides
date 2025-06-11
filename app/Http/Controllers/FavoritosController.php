<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use App\Models\Favorito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritosController extends Controller
{
    /**
     * Toggle favorito via AJAX: adiciona ou remove.
     */
    public function toggle(Anuncio $anuncio)
    {
        if (! Auth::check()) {
            return response()->json(['error' => 'Faça login para favoritar'], 401);
        }

        $user = Auth::user();
        $attached = $user->anunciosFavoritados()->toggle($anuncio);

        $action = isset($attached['attached']) && count($attached['attached'])
            ? 'added'
            : 'removed';

        return response()->json([
            'action' => $action,
            'count'  => $anuncio->favoritadoPor()->count(),
        ]);
    }

    /**
     * Exibe a lista paginada de favoritos.
     */
    public function index()
    {
        $user = Auth::user();

        $favoritos = $user
            ->anunciosFavoritados()
            ->with('fotos')
            ->paginate(10);

        return view('pages.favoritos.index', compact('favoritos'));
    }
}
