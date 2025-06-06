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

    public function __construct(CarApiService $carApi)
    {
        $this->carApi = $carApi;
    }

    public function index()
    {
        $meusAnuncios = Anuncio::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.anuncios.meus', compact('meusAnuncios'));
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
            'combustivel' => 'required',
            'cor' => 'required',
        ]);

        session(['anuncio.step1' => $request->all()]);
        return redirect()->route('anuncio.step2');
    }

    public function step2()
    {
        if (!session('anuncio.step1')) {
            return redirect()->route('anuncio.step1')->with('error', 'Preencha os dados do veículo primeiro.');
        }

        $dados = session('anuncio.step1');
        $detalhes = $this->carApi->getVehicleDetails($dados['marca'], $dados['modelo'], $dados['ano_modelo']);
        $precoFipe = isset($detalhes['price']) ? (float) str_replace(['R$', '.', ','], ['', '', '.'], $detalhes['price']) : null;

        return view('pages.anuncios.cars.create.step2', compact('precoFipe'));
    }

    public function step2Post(Request $request)
    {
        $request->validate([
            'placa' => 'required|string|size:7|alpha_num',
        ]);

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
            'fotos' => 'required|array|min:1|max:20',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

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
            'fotos' => session('anuncio.temp_fotos', []),
        ]);
    }

    public function confirmarAnuncio(Request $request)
    {
        $steps = ['step1', 'step2', 'step3', 'step4'];
        foreach ($steps as $step) {
            if (!session("anuncio.$step")) {
                return redirect()->route('anuncio.step1')->with('error', 'Complete todos os passos primeiro.');
            }
        }

        if (!session('anuncio.temp_fotos')) {
            return redirect()->route('anuncio.step4')->with('error', 'Adicione pelo menos uma foto do veículo.');
        }

        $detalhes = $this->carApi->getVehicleDetails(
            session('anuncio.step1.marca'),
            session('anuncio.step1.modelo'),
            session('anuncio.step1.ano_modelo')
        );

        $anuncio = Anuncio::create([
            'user_id' => auth()->id(),
            'marca' => $detalhes['brand'] ?? session('anuncio.step1.marca'),
            'modelo' => $detalhes['model'] ?? session('anuncio.step1.modelo'),
            'ano_modelo' => session('anuncio.step1.ano_modelo'),
            'ano_fabricacao' => session('anuncio.step1.ano_fabricacao'),
            'combustivel' => session('anuncio.step1.combustivel'),
            'cor' => session('anuncio.step1.cor'),
            'preco' => session('anuncio.step2.preco'),
            'localizacao' => session('anuncio.step2.localizacao'),
            'latitude' => session('anuncio.step2.latitude'),
            'longitude' => session('anuncio.step2.longitude'),
            'cidade' => session('anuncio.step2.cidade'),
            'estado' => session('anuncio.step2.estado'),
            'quilometragem' => session('anuncio.step2.quilometragem'),
            'portas' => session('anuncio.step2.portas'),
            'placa' => session('anuncio.step2.placa'),
            'descricao' => session('anuncio.step2.descricao'),
            'situacao' => session('anuncio.step2.situacao'),
            'detalhes' => is_array(session('anuncio.step3.condicoes')) ? implode(',', session('anuncio.step3.condicoes')) : null,
            'status' => 'ativo',
        ]);

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
                    'ordem' => $index + 1,
                ]);

                $principal = false;
            } catch (\Exception $e) {
                \Log::error("Erro ao processar foto do anúncio: " . $e->getMessage());
            }
        }

        session()->forget([
            'anuncio.step1',
            'anuncio.step2',
            'anuncio.step3',
            'anuncio.step4',
            'anuncio.temp_fotos',
        ]);

        return redirect()->route('anuncio.show', $anuncio->id)->with('success', 'Anúncio criado com sucesso!');
    }

    public function show($id)
    {
        $anuncio = Anuncio::with('fotos', 'user')->findOrFail($id);
        return view('pages.anuncios.cars.search.show', compact('anuncio'));
    }

    public function anunciosProximos(float $latitude, float $longitude, float $raioKm = 100)
    {
        return Anuncio::selectRaw(
            "*, (6371 * ACOS(
                COS(RADIANS(?)) * COS(RADIANS(latitude)) * COS(RADIANS(longitude) - RADIANS(?)) +
                SIN(RADIANS(?)) * SIN(RADIANS(latitude))
            )) AS distancia",
            [$latitude, $longitude, $latitude]
        )
        ->having('distancia', '<=', $raioKm)
        ->orderBy('distancia')
        ->get();
    }
}
