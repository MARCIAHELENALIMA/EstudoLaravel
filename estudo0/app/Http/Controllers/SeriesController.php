<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $series = Serie::query()->orderBy('nome')->get();
        $mensagemSucesso = session('mensagem.sucesso');
        return view('series.index')->with('series', $series)
            ->with('mensagemSucesso', $mensagemSucesso);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('series.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $serie = Serie::create($request->all());

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série {$serie->nome} adicionada com sucesso");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Serie $series)
    {
        return view('series.edit')->with('serie', $series);
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
    public function destroy(Serie $series)
    {
        $series->delete();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série {$series->nome} removida com sucesso!");
    }
}
