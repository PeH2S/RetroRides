<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnuncioController extends Controller
{
    public function step1()
    {
        return view('pages.anuncios.cars.create.step1');
    }

    public function step1Post(Request $request)
    {
        $request->validate([
            'marca' => 'required',
            'modelo' => 'required',
            'ano_modelo' => 'required',
            'ano_fabricacao' => 'required',
            'cor' => 'required'
        ]);

        session(['anuncio.step1' => $request->all()]);
        return redirect()->route('anuncio.step2');
    }

    public function step2()
    {
        return view('pages.anuncios.cars.create.step2');
    }

    public function step2Post(Request $request)
    {
        session(['anuncio.step2' => $request->except('_token')]);
        return redirect()->route('anuncio.step3');
    }

    public function step3()
    {
        return view('pages.anuncios.cars.create.step3');
    }

    public function step3Post(Request $request)
    {
        session(['anuncio.step3' => $request->except('_token')]);
        return redirect()->route('anuncio.step4');
    }

    public function step4()
    {
        return view('pages.anuncios.cars.create.step4');
    }

    public function finalizar(Request $request)
    {
        session(['anuncio.step4' => $request->except('_token')]);

        $dados = array_merge(
            session('anuncio.step1', []),
            session('anuncio.step2', []),
            session('anuncio.step3', []),
            session('anuncio.step4', [])
        );

        // Aqui você pode salvar os dados no banco:
        // Anuncio::create($dados);

        session()->forget(['anuncio.step1', 'anuncio.step2', 'anuncio.step3', 'anuncio.step4']);

        return redirect()->route('home')->with('success', 'Anúncio criado com sucesso!');
    }
}
