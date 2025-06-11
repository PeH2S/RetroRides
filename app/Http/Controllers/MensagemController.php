<?php

namespace App\Http\Controllers;

use App\Events\NovaMensagem;
use App\Models\Mensagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Conversa;

class MensagemController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'conversa_id' => 'required|exists:conversas,id',
            'conteudo' => 'required|string',
        ]);
        $conversa = Conversa::findOrFail($request->conversa_id);
        $anuncio = $conversa->anuncio;

        if (in_array($anuncio->status, ['finalizado', 'cancelado'])) {
            return response()->json(['error' => 'Conversa encerrada. Não é possível enviar mensagens.'], 403);
        }

        $mensagem = Mensagem::create([
            'conversa_id' => $request->conversa_id,
            'remetente_id' => Auth::id(),
            'conteudo' => $request->conteudo,
        ]);

        event(new NovaMensagem($mensagem));
        \Log::info('Mensagem enviada: ' . $mensagem->conteudo);
        event(new NovaMensagem($mensagem));

        return response()->json(['success' => true, 'mensagem' => $mensagem]);
    }
}
