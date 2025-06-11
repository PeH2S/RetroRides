<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Exibe a visão geral do painel.
     */
    public function index()
    {
        $user = Auth::user();
        return view('pages.dashboard', compact('user'))
             ->with('tab', 'overview');
    }

    /**
     * Exibe a aba "Minha Conta" dentro do painel.
     */
    public function account()
    {
        $user = Auth::user();
        return view('pages.dashboard', compact('user'))
             ->with('tab', 'account');
    }
}
