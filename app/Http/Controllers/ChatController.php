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
}
