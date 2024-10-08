<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use App\Models\Curso;
use Illuminate\Http\Request;

class ClaseController extends Controller
{
    public function index()
    {
        $clases = Clase::all();
        return view('clases.index', compact('clases'));
    }

    public function create()
    {
        $cursos = Curso::all(); 
        return view('clases.form', compact('cursos')); 
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha_hora' => 'required|date',
            'curso_id' => 'required|exists:cursos,id',
        ]);

        Clase::create($validated);

        return redirect()->route("clases.index")->with([
            "message" => "Clase creada exitosamente",
            "type" => "success"
        ]);
    }

    public function edit(Clase $clase)
    {
        $cursos = Curso::all();
        return view('clases.form', compact('clase', 'cursos')); 
    }

    public function update(Request $request, Clase $clase)
    {
        $validated = $request->validate([
            'fecha_hora' => 'required|date',
            'curso_id' => 'required|exists:cursos,id',
        ]);

        $clase->update($validated);

        return redirect()->route("clases.index")->with([
            "message" => "Clase actualizada exitosamente",
            "type" => "success"
        ]);
    }

    public function destroy(Clase $clase)
    {
        $clase->delete();

        return redirect()->route("clases.index")->with([
            "message" => "Clase eliminada exitosamente",
            "type" => "success"
        ]);
    }
}
