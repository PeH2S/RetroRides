<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Services\CarApiService;
use App\Models\Anuncio;
use App\Models\AnuncioFoto;
use App\Services\GeocodingService;


class AnuncioController extends Controller
{
    protected CarApiService $carApi;

    /**
     * Aplica middleware auth (no routes/web.php, as rotas já estarão protegidas).
     */
    public function __construct(CarApiService $carApi)
    {
        $this->carApi = $carApi;
    }

    public function index()
    {
        // Exemplo: pega somente os anúncios do usuário autenticado
        $meusAnuncios = Anuncio::where('user_id', auth()->id())
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);

        return view('pages.anuncios.meus', compact('meusAnuncios'));
    }

    /**
     * Etapa 1 (GET): exibe formulário de dados básicos do veículo.
     * View: resources/views/pages/anuncios/cars/create/step1.blade.php
     */
    public function step1()
    {
        $old = session('anuncio.step1', []);
        return view('pages.anuncios.partials.cars.create.step1', compact('old'));
    }

    /**
     * Etapa 1 (POST): valida, salva em sessão e redireciona para etapa 2.
     */
    public function step1Post(Request $request)
    {
        $data = $request->validate([
            'titulo'         => 'required|string|max:255',
            'descricao'      => 'required|string',
            'marca'          => 'required|string|max:100',
            'modelo'         => 'required|string|max:100',
            'ano_modelo'     => 'required|string|max:10',
            'ano_fabricacao' => 'required|string|max:10',
            'combustivel'    => 'required|string|max:50',
            'cor'            => 'required|string|max:50',
        ]);

        session(['anuncio.step1' => $data]);
        return redirect()->route('anuncio.step2');
    }

    /**
     * Etapa 2 (GET): exibe formulário de preço e dados complementares.
     * View: resources/views/pages/anuncios/cars/create/step2.blade.php
     */
    public function step2()
    {
        $old = session('anuncio.step2', []);
        return view('pages.anuncios.partials.cars.create.step2', compact('old'));
    }

    /**
     * Etapa 2 (POST): valida, salva em sessão e redireciona para etapa 3.
     */
    public function step2Post(Request $request)
    {

        $request->validate([
            'placa' => 'required|string|size:7|alpha_num',
            'localizacao' => 'required|string|max:100',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'cidade' => 'required|string|max:50',
            'estado' => 'required|string|size:2',
        ]);

        session(['anuncio.step2' => $request->except('_token')]);
        return redirect()->route('anuncio.step3');
    }

    /**
     * Etapa 3 (GET): exibe formulário de condições, opcionais e observações.
     * View: resources/views/pages/anuncios/cars/create/step3.blade.php
     */
    public function step3()
    {
        $old = session('anuncio.step3', []);
        return view('pages.anuncios.partials.cars.create.step3', compact('old'));
    }

    /**
     * Etapa 3 (POST): valida, salva em sessão e redireciona para etapa 4.
     */
    public function step3Post(Request $request)
    {
        $data = $request->validate([
            'condicoes'   => 'nullable|array',
            'condicoes.*' => 'string',
            'opcionais'   => 'nullable|string',
            'observacoes' => 'nullable|string',
        ]);

        session(['anuncio.step3' => $data]);
        return redirect()->route('anuncio.step4');
    }

    /**
     * Etapa 4 (GET): exibe formulário para upload de fotos.
     * View: resources/views/pages/anuncios/cars/create/step4.blade.php
     */
    public function step4()
    {
        $oldPhotos = session('anuncio.step4.fotos', []);
        return view('pages.anuncios.partials.cars.create.step4', compact('oldPhotos'));
    }

    /**
     * Etapa 4 (POST): valida imagens, armazena em storage temporário e salva session.
     */
    public function step4Post(Request $request)
    {
        $request->validate([
            'fotos'   => 'required|array|min:1|max:20',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Apaga quaisquer fotos temporárias já existentes (para não acumular)
        if (session('anuncio.step4.fotos')) {
            foreach (session('anuncio.step4.fotos') as $oldPath) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        $fotos = [];
        foreach ($request->file('fotos') as $foto) {
            // Salva em storage/app/public/anuncios_temp
            $path = $foto->store('anuncios_temp', 'public');
            $fotos[] = $path;
        }

        session(['anuncio.step4.fotos' => $fotos]);
        return redirect()->route('anuncio.finalizar');
    }

    /**
     * Exibe a tela de confirmação final antes de salvar de fato.
     * View: resources/views/pages/anuncios/cars/create/finalizar.blade.php
     */
    public function finalizar()
    {
        $steps = ['step1', 'step2', 'step3', 'step4'];
        foreach ($steps as $step) {
            if (!session("anuncio.$step")) {
                return redirect()->route("anuncio.$step")
                                 ->with('error', 'Complete todos os passos primeiro.');
            }
        }

        if (!session('anuncio.step4.fotos') || count(session('anuncio.step4.fotos')) === 0) {
            return redirect()->route('anuncio.step4')
                             ->with('error', 'Adicione pelo menos uma foto do veículo.');
        }

        $dados = array_merge(
            session('anuncio.step1', []),
            session('anuncio.step2', []),
            session('anuncio.step3', [])
        );

        return view('pages.anuncios.cars.create.finalizar', [
            'dados' => $dados,
            'fotos' => session('anuncio.step4.fotos', []),
        ]);
    }

    /**
     * Recebe todas as etapas (sessions), grava no banco (com user_id) e move fotos.
     */
    public function confirmarAnuncio(Request $request)
    {
        $required = ['step1', 'step2', 'step3', 'step4'];
        foreach ($required as $step) {
            if (!session("anuncio.$step")) {
                return redirect()->route('anuncio.step1')
                                 ->with('error', 'Complete todos os passos primeiro.');
            }
        }

        if (!session('anuncio.step4.fotos') || count(session('anuncio.step4.fotos')) === 0) {
            return redirect()->route('anuncio.step4')
                             ->with('error', 'Adicione pelo menos uma foto do veículo.');
        }

        $dados1 = session('anuncio.step1');
        $dados2 = session('anuncio.step2');
        $dados3 = session('anuncio.step3');
        $fotosTemp = session('anuncio.step4.fotos', []);

        // (Opcional) Puxar detalhes extra via CarApiService
        $detalhesVeiculo = $this->carApi->getVehicleDetails(
            $dados1['marca'],
            $dados1['modelo'],
            $dados1['ano_modelo']
        );

        // Cria o anúncio no banco, atribuindo user_id
        $anuncio = Anuncio::create([

            'user_id' => auth()->id(),
            'marca' => $detalhesVeiculo['brand'] ?? session('anuncio.step1.marca'),
            'modelo' => $detalhesVeiculo['model'] ?? session('anuncio.step1.modelo'),
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
            'detalhes' => session('anuncio.step3.condicoes'),
            'status' => 'ativo'
        ]);

        // Move cada foto do temporário para “anuncios/” e salva em AnuncioFoto
        $principal = true;
        foreach ($fotosTemp as $idx => $oldPath) {
            try {
                $newPath = str_replace('anuncios_temp/', 'anuncios/', $oldPath);
                Storage::disk('public')->move($oldPath, $newPath);

                AnuncioFoto::create([
                    'anuncio_id' => $anuncio->id,
                    'caminho'    => $newPath,
                    'principal'  => $principal,
                    'ordem'      => $idx + 1,
                ]);

                $principal = false;
            } catch (\Exception $e) {
                \Log::error("Erro ao mover foto: " . $e->getMessage());
            }
        }

        // Limpa todas as sessões de anúncio
        session()->forget([
            'anuncio.step1',
            'anuncio.step2',
            'anuncio.step3',
            'anuncio.step4.fotos',
        ]);

        return redirect()
            ->route('anuncio.show', $anuncio->id)
            ->with('success', 'Anúncio criado com sucesso!');
    }

    /**
     * Exibe os detalhes públicos de um anúncio (sem exigir login).
     * View: resources/views/pages/anuncios/cars/search/show.blade.php
     */
    public function show($id)
    {
        $anuncio = Anuncio::with('fotos', 'user')->findOrFail($id);
        return view('pages.anuncios.cars.search.show', compact('anuncio'));
    }




    public function anunciosProximos(float $latitude, float $longitude, float $raioKm = 100)
    {
        return Anuncio::selectRaw(
            "*,
            (6371 * ACOS(
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
