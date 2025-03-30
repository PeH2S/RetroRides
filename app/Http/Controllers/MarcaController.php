<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas = Marca::all();
        return view('marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marcas = Marca::all();
        return view("produtos.create", compact("marcas"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Marca::create($request->all());
            return redirect()->route('marcas.index')
                ->with('sucesso', 'Marca criada com sucesso!');
        } catch (Exception $e) {
            Log::error("Erro ao criar a marca: ".$e->getMessage(), [
                'stack' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);

            return redirect()->route('marcas.index')
                ->with('erro' , 'Erro ao criar a Marca!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $marca = Marca::findOrFail($id);
        $marcas = Marca::all();
        return view('marcas.edit', compact('marca', 'marcas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $marca = Marca::findOrFail($id);
        $marcas = Marca::all();
        return view('marca.edit', compact('marca'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
