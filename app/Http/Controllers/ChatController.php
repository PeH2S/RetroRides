<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversa;

class ChatController extends Controller
{
    public function show(Conversa $conversa)
    {
        $conversa->load('mensagens', 'anunciante', 'comprador');
        return view('pages.chat.show', compact('conversa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'comprador_id' => 'required|exists:users,id',
            'anunciante_id' => 'required|exists:users,id',
            'anuncio_id' => 'required|exists:anuncios,id',
        ]);

        $conversa = Conversa::where('comprador_id', $request->comprador_id)
            ->where('anunciante_id', $request->anunciante_id)
            ->where('anuncio_id', $request->anuncio_id)
            ->first();

        if (!$conversa) {
            $conversa = Conversa::create([
                'comprador_id' => $request->comprador_id,
                'anunciante_id' => $request->anunciante_id,
                'anuncio_id' => $request->anuncio_id,
            ]);
        }

        return redirect()->route('conversas.show', $conversa);
    }
    public function index()
    {
        $compradorId = auth()->id();

        $conversas = Conversa::with(['anuncio', 'anunciante'])
            ->where('comprador_id', $compradorId)
            ->latest()
            ->get();

        return view('pages.chat.list', compact('conversas'));
    }
}
