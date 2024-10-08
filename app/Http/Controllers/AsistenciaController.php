<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{

    public function index()
    {
        $asistencias = Asistencia::all();
        return view('asistencias.index', compact('asistencias'));
    }

    public function create()
    {
        return view('asistencias.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'estado' => 'required|in:PRESENTE,AUSENTE,TARDE',
            'clase_id' => 'required|exists:clases,id',
            'estudiante_id' => 'required|exists:estudiantes,id'
        ]);

        Asistencia::create($validated);
        return redirect()->route('asistencias.index')->with([
            'message' => 'Asistencia creada',
            'type' => 'success'
        ]);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Asistencia $asistencia)
    {
        return view('asistencias.form', compact('asistencia'));
    }

    public function update(Request $request, Asistencia $asistencia)
    {
        $validated = $request->validate([
            'estado' => 'required|in:PRESENTE,AUSENTE,TARDE',
            'clase_id' => 'required|exists:clases,id',
            'estudiante_id' => 'required|exists:estudiantes,id'
        ]);

        $asistencia->update($validated);
        return redirect()->route('asistencias.index')->with([
            'message' => 'Asistencia actualizada',
            'type' => 'success'
        ]);
    }

    public function destroy(Asistencia $asistencia)
    {
        $asistencia->delete();

        return redirect()->route('asistencias.index')->with([
            'message' => 'Asistencia eliminada exitosamente',
            'type' => 'success'
        ]);
    }
}