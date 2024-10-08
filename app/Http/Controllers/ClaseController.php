<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clase;

class ClaseController extends Controller
{

    public function index()
    {
        $clases = Clase::all();
        return view('clases.index', compact('clases'));
    }

    public function create()
    {
        return view('clases.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha_hora' => 'required|date',
            'curso_id' => 'required|exists:cursos,id'
        ]); 

        Clase::create($validated);
        return redirect()->route('clases.index')->with([
            'message' => 'Clase creada exitosamente',
            'type' => 'success'
        ]);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Clase $clase)
    {
        return view('clases.form', compact('clase'));
    }

    public function update(Request $request, Clase $clase)
    {
        $validated = $request->validate([
            'fecha_hora' => 'required|date',
            'curso_id' => 'required|exists:cursos,id'
        ]);

        $clase->update($validated);

        return redirect()->route('clases.index')->with([
            'message' => 'Clase actualizada exitosamente',
            'type' => 'success'
        ]);
    }

    public function destroy(Clase $clase)
    {
        $clase->delete();
            
            return redirect()->route('clases.index')->with([
                'message' => 'Clase eliminada exitosamente',
                'type' => 'success'
            ]);
    }
}
