<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use App\Models\Curso;
use Illuminate\Http\Request;

class ClaseController extends Controller
{
    public function index()
    {
        $clases = Clase::all(); // UI: Obtiene todas las clases
        return view('clases.index', compact('clases')); // UI: Renderiza la vista de la lista de clases
    }

    public function create()
    {
        $cursos = Curso::all(); // UI: Obtiene todos los cursos
        return view('clases.form', compact('cursos')); // UI: Renderiza la vista del formulario de creación de clases
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha_hora' => 'required|date', // UX: Validación de la fecha y hora
            'curso_id' => 'required|exists:cursos,id', // UX: Validación del ID del curso
        ]);

        Clase::create($validated); // UI: Crea una nueva clase en la base de datos

        return redirect()->route("clases.index")->with([
            "message" => "Clase creada exitosamente", // UX: Mensaje de éxito
            "type" => "success" // UX: Tipo de mensaje
        ]);
    }

    public function edit(Clase $clase)
    {
        $cursos = Curso::all(); // UI: Obtiene todos los cursos
        return view('clases.form', compact('clase', 'cursos')); // UI: Renderiza la vista del formulario de edición de clases
    }

    public function update(Request $request, Clase $clase)
    {
        $validated = $request->validate([
            'fecha_hora' => 'required|date', // UX: Validación de la fecha y hora
            'curso_id' => 'required|exists:cursos,id', // UX: Validación del ID del curso
        ]);

        $clase->update($validated); // UI: Actualiza la clase en la base de datos

        return redirect()->route("clases.index")->with([
            "message" => "Clase actualizada exitosamente", // UX: Mensaje de éxito
            "type" => "success" // UX: Tipo de mensaje
        ]);
    }

    public function destroy(Clase $clase)
    {
        $clase->delete(); // UI: Elimina la clase de la base de datos

        return redirect()->route("clases.index")->with([
            "message" => "Clase eliminada exitosamente", // UX: Mensaje de éxito
            "type" => "success" // UX: Tipo de mensaje
        ]);
    }
}