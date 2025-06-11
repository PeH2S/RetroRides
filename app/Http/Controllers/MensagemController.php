<?php

namespace App\Http\Controllers;

use App\Events\NovaMensagem;
use App\Models\Mensagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MensagemController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'conversa_id' => 'required|exists:conversas,id',
            'conteudo' => 'required|string',
        ]);

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
