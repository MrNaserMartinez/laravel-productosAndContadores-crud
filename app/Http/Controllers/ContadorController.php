<?php

namespace App\Http\Controllers;

use App\Models\Contador;
use Illuminate\Http\Request;

class ContadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contadores = Contador::all();
        return view('contadores.index', compact('contadores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contadores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero_contador' => 'required|string|max:20',
            'direccion' => 'required|string|max:150',
            'lectura_actual' => 'required|numeric',
        ]);

        Contador::create($request->all());

        return redirect()->route('contadores.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contador $contador)
    {
        return view('contadores.edit', compact('contador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contador $contador)
    {
        $request->validate([
            'numero_contador' => 'required|string|max:20',
            'direccion' => 'required|string|max:150',
            'lectura_actual' => 'required|numeric',
        ]);

        $contador->update($request->all());

        return redirect()->route('contadores.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contador $contador)
    {
        $contador->delete();

        return redirect()->route('contadores.index');
    }
}