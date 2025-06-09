<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $marcasPopulares = [
            ['marca' => 'FIAT', 'modelo' => 'Strada', 'imagem' => 'Strada.png'],
            ['marca' => 'Volkswagen', 'modelo' => 'Gol', 'imagem' => 'Gol.png'],
            ['marca' => 'FIAT', 'modelo' => 'Palio', 'imagem' => 'Palio.png'],
            ['marca' => 'Hyundai', 'modelo' => 'HB20', 'imagem' => 'Hb20.png'],
            ['marca' => 'Toyota', 'modelo' => 'Corolla', 'imagem' => 'Corolla.png'],
        ];

        $banners = [
            ['titulo' => 'Revisado e com garantia', 'texto' => 'Compre com confiança: veículos verificados e prontos para rodar.'],
            ['titulo' => 'Menor desvalorização', 'texto' => 'Veículos usados desvalorizam menos e têm custo-benefício maior.'],
            ['titulo' => 'Facilidade no financiamento', 'texto' => 'Aprovação rápida e parcelas que cabem no seu bolso.'],
        ];

        return view('pages.home', compact('marcasPopulares', 'banners'));
    }
}
