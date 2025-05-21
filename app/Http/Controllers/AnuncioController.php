<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\CarApiService;
use App\Models\Anuncio;
use App\Models\AnuncioFoto;

class AnuncioController extends Controller
{

    protected CarApiService $carApi;

    public function __construct(
        CarApiService $carApi
    ){
        $this->carApi = $carApi;
    }



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
    $dadosEtapa1 = session('anuncio.step1');

    if (!session('anuncio.step1')) {
        return redirect()->route('anuncio.step1')->with('error', 'Preencha os dados do veículo primeiro.');
    }

    $brandId = $dadosEtapa1['marca'];           // deve ser o código da marca
    $modelId = $dadosEtapa1['modelo'];          // deve ser o código do modelo
    $yearId = $dadosEtapa1['ano_modelo'];       // deve ser o código do ano (ex: '2021-3')

    $detalhes = $this->carApi->getVehicleDetails($brandId, $modelId, $yearId);
    $precoFipe = isset($detalhes['price']) ? (float) str_replace(['R$', '.', ','], ['', '', '.'], $detalhes['price']) : null;

    return view('pages.anuncios.cars.create.step2', compact('precoFipe'));
}


    public function step2Post(Request $request)
    {
        session(['anuncio.step2' => $request->except('_token')]);
        return redirect()->route('anuncio.step3');
    }

    public function step3()
    {
        if (!session('anuncio.step2')) {
            return redirect()->route('anuncio.step2')->with('error', 'Complete os passos anteriores primeiro.');
        }
        return view('pages.anuncios.cars.create.step3');
    }

    public function step3Post(Request $request)
    {
        session(['anuncio.step3' => $request->except('_token')]);
        return redirect()->route('anuncio.step4');
    }

    public function step4()
    {

        if (!session('anuncio.step3')) {
            return redirect()->route('anuncio.step3')->with('error', 'Complete os passos anteriores primeiro.');
        }

        return view('pages.anuncios.cars.create.step4');
    }

    public function step4Post(Request $request)
    {
        $request->validate([
            'fotos' => 'required|array|min:1|max:20', // Limite máximo de 20 fotos
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120' // Aumentei para 5MB
        ]);

        // Remove fotos temporárias antigas se existirem
        if (session('anuncio.temp_fotos')) {
            foreach (session('anuncio.temp_fotos') as $foto) {
                Storage::disk('public')->delete($foto);
            }
        }

        $fotos = [];
        foreach ($request->file('fotos') as $foto) {
            $path = $foto->store('temp_anuncios', 'public');
            $fotos[] = $path;
        }

        session(['anuncio.temp_fotos' => $fotos]);
        session(['anuncio.step4' => ['fotos' => count($fotos)]]);

        return redirect()->route('anuncio.finalizar');
    }


    public function finalizar()
    {

        $steps = ['step1', 'step2', 'step3', 'step4'];
        foreach ($steps as $step) {
            if (!session("anuncio.$step")) {
                return redirect()->route("anuncio.$step")->with('error', 'Complete todos os passos primeiro.');
            }
        }


        if (!session('anuncio.temp_fotos')) {
            return redirect()->route('anuncio.step4')->with('error', 'Adicione pelo menos uma foto do veículo.');
        }

        $dados = array_merge(
            session('anuncio.step1', []),
            session('anuncio.step2', []),
            session('anuncio.step3', [])
        );

        return view('pages.anuncios.cars.create.finalizar', [
            'dados' => $dados,
            'fotos' => session('anuncio.temp_fotos', [])
        ]);
    }

    public function confirmarAnuncio(Request $request)
    {

        $requiredSteps = ['step1', 'step2', 'step3', 'step4'];
        foreach ($requiredSteps as $step) {
            if (!session("anuncio.$step")) {
                return redirect()->route('anuncio.step1')->with('error', 'Complete todos os passos primeiro.');
            }
        }

        if (!session('anuncio.temp_fotos')) {
            return redirect()->route('anuncio.step4')->with('error', 'Adicione pelo menos uma foto do veículo.');
        }

        // Cria o anúncio
        $anuncio = Anuncio::create([
            //'user_id' => auth()->id(),
            'marca' => session('anuncio.step1.marca'),
            'modelo' => session('anuncio.step1.modelo'),
            'ano_modelo' => session('anuncio.step1.ano_modelo'),
            'ano_fabricacao' => session('anuncio.step1.ano_fabricacao'),
            'cor' => session('anuncio.step1.cor'),
            'preco' => session('anuncio.step2.preco'),
            'quilometragem' => session('anuncio.step2.quilometragem'),
            'combustivel' => session('anuncio.step2.combustivel'),
            'portas' => session('anuncio.step2.portas'),
            'placa' => session('anuncio.step2.placa'),
            'final_placa' => session('anuncio.step2.final_placa'),
            'descricao' => session('anuncio.step3.descricao'),
            'status' => 'ativo'
        ]);

        // Processa as fotos
        $fotos = session('anuncio.temp_fotos', []);
        $principal = true;

        foreach ($fotos as $index => $fotoPath) {
            try {
                $newPath = str_replace('temp_anuncios/', 'anuncios/', $fotoPath);
                Storage::disk('public')->move($fotoPath, $newPath);

                AnuncioFoto::create([
                    'anuncio_id' => $anuncio->id,
                    'caminho' => $newPath,
                    'principal' => $principal,
                    'ordem' => $index + 1
                ]);

                $principal = false;
            } catch (\Exception $e) {
                \Log::error("Erro ao processar foto do anúncio: " . $e->getMessage());
                continue;
            }
        }

        session()->forget([
            'anuncio.step1',
            'anuncio.step2',
            'anuncio.step3',
            'anuncio.step4',
            'anuncio.temp_fotos'
        ]);

        return redirect()->route('anuncio.show', $anuncio->id)
            ->with('success', 'Anúncio criado com sucesso!');
    }


    public function show($id)
    {
        $anuncio = Anuncio::with('fotos')->findOrFail($id);

        return view('pages.anuncios.cars.create.show', compact('anuncio'));
    }
}
