<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Clase;
use App\Models\Estudiante;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function index()
    {
        $asistencias = Asistencia::all(); // UI: Obtiene todas las asistencias
        return view('asistencias.index', compact('asistencias')); // UI: Renderiza la vista de la lista de asistencias
    }

    public function create()
    {
        $clases = Clase::all(); // UI: Obtiene todas las clases
        $estudiantes = Estudiante::all(); // UI: Obtiene todos los estudiantes
        return view('asistencias.form', compact('clases', 'estudiantes')); // UI: Renderiza la vista del formulario de creación de asistencias
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'estado' => 'required|in:PRESENTE,AUSENTE,TARDE', // UX: Validación del estado de asistencia
            'clase_id' => 'required|exists:clases,id', // UX: Validación del ID de la clase
            'estudiante_id' => 'required|exists:estudiantes,id', // UX: Validación del ID del estudiante
        ]);

        Asistencia::create($validated); // UI: Crea una nueva asistencia en la base de datos

        return redirect()->route("asistencias.index")->with([
            "message" => "Asistencia registrada exitosamente", // UX: Mensaje de éxito
            "type" => "success" // UX: Tipo de mensaje
        ]);
    }

    public function edit(Asistencia $asistencia)
    {
        $clases = Clase::all(); // UI: Obtiene todas las clases
        $estudiantes = Estudiante::all(); // UI: Obtiene todos los estudiantes
        return view('asistencias.form', compact('asistencia', 'clases', 'estudiantes')); // UI: Renderiza la vista del formulario de edición de asistencias
    }

    public function update(Request $request, Asistencia $asistencia)
    {
        $validated = $request->validate([
            'estado' => 'required|in:PRESENTE,AUSENTE,TARDE', // UX: Validación del estado de asistencia
            'clase_id' => 'required|exists:clases,id', // UX: Validación del ID de la clase
            'estudiante_id' => 'required|exists:estudiantes,id', // UX: Validación del ID del estudiante
        ]);

        $asistencia->update($validated); // UI: Actualiza la asistencia en la base de datos

        return redirect()->route("asistencias.index")->with([
            "message" => "Asistencia actualizada exitosamente", // UX: Mensaje de éxito
            "type" => "success" // UX: Tipo de mensaje
        ]);
    }

    public function destroy(Asistencia $asistencia)
    {
        $asistencia->delete(); // UI: Elimina la asistencia de la base de datos

        return redirect()->route("asistencias.index")->with([
            "message" => "Asistencia eliminada exitosamente", // UX: Mensaje de éxito
            "type" => "success" // UX: Tipo de mensaje
        ]);
    }
}