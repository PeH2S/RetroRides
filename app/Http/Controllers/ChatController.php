<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anuncio;
use App\Models\Conversa;
use App\Models\Mensagem;
use App\Events\NovaMensagemEnviada;
use Illuminate\Support\Facades\Auth;
class ChatController extends Controller
{
    public function index(Anuncio $anuncio)
    {
        $conversa = Conversa::firstOrCreate([
            'anuncio_id' => $anuncio->id,
            'comprador_id' => Auth::id(),
            'anunciante_id' => $anuncio->user_id
        ]);
        return redirect()->route('conversas.show', $conversa);
    }
    public function list()
    {
        $user = Auth::user();
        $conversas = Conversa::where('comprador_id', $user->id)
            ->orWhere('anunciante_id', $user->id)
            ->with('anuncio')
            ->get();
        return view('chat.lista', compact('conversas'));
    }
    public function show(Conversa $conversa)
    {
        $this->authorize('view', $conversa);
        $mensagens = $conversa->mensagens()->with('remetente')->get();
        return view('chat.mensagem', compact('conversa', 'mensagens'));
    }
    public function enviarMensagem(Request $request)
    {
        $request->validate([
            'conversa_id' => 'required|exists:conversas,id',
            'conteudo' => 'required|string'
        ]);
        $mensagem = Mensagem::create([
            'conversa_id' => $request->conversa_id,
            'remetente_id' => Auth::id(),
            'conteudo' => $request->conteudo,
        ]);
        broadcast(new NovaMensagemEnviada($mensagem))->toOthers();
        return response()->json($mensagem);
    }
}
