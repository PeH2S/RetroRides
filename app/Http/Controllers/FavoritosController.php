<?php

namespace App\Http\Controllers;

class FavoritosController extends Controller
{
    public function index()
    {
        return view('pages.favoritos.index');
    }
}
