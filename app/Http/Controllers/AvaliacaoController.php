<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Anuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvaliacaoController extends Controller
{
    public function store(Request $request, Anuncio $anuncio)
    {
        $request->validate([
            'nota' => 'required|integer|between:1,5',
            'comentario' => 'nullable|string|max:500'
        ]);

        $avaliacaoExistente = Avaliacao::where('avaliador_id', Auth::id())
            ->where('anuncio_id', $anuncio->id)
            ->exists();

        if ($avaliacaoExistente) {
            return back()->with('error', 'Você já avaliou este anúncio.');
        }

        Avaliacao::create([
            'avaliador_id' => Auth::id(),
            'anunciante_id' => $anuncio->user_id,
            'anuncio_id' => $anuncio->id,
            'nota' => $request->nota,
            'comentario' => $request->comentario
        ]);

        return back()->with('success', 'Avaliação enviada com sucesso!');
    }
    public function minhasAvaliacoes()
    {
        $avaliacoes = Avaliacao::with(['avaliador', 'anuncio'])
            ->where('anunciante_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $mediaAvaliacoes = auth()->user()->avaliacoesRecebidas()->avg('nota');

        return view('pages.avaliacoes.minhas', compact('avaliacoes', 'mediaAvaliacoes'));
    }
}
