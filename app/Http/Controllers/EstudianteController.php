<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::all(); // UI: Obtiene todos los estudiantes
        return view('estudiantes.index', compact('estudiantes')); // UI: Renderiza la vista de la lista de estudiantes
    }

    public function create()
    {
        return view('estudiantes.form'); // UI: Renderiza la vista del formulario de creación de estudiantes
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255', // UX: Validación del nombre
            'apellido' => 'required|string|max:255', // UX: Validación del apellido
            'cedula' => 'required|numeric|digits:10|unique:estudiantes,cedula', // UX: Validación de la cédula
            'email' => 'required|string|email|max:255|unique:estudiantes,email', // UX: Validación del correo electrónico
            'telefono' => 'required|string|digits:10', // UX: Validación del teléfono
        ],[
            'email.unique' => 'No se puede repetir el correo', // UX: Mensaje de error personalizado
        ]);

        Estudiante::create($validated); // UI: Crea un nuevo estudiante en la base de datos

        return redirect()->route("estudiantes.index")->with([
            "message" => "Estudiante creado exitosamente", // UX: Mensaje de éxito
            "type" => "success" // UX: Tipo de mensaje
        ]);
    }

    public function edit(Estudiante $estudiante)
    {
        return view('estudiantes.form', compact('estudiante')); // UI: Renderiza la vista del formulario de edición de estudiantes
    }

    public function update(Request $request, Estudiante $estudiante)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255', // UX: Validación del nombre
            'apellido' => 'required|string|max:255', // UX: Validación del apellido
            'cedula' => 'required|numeric|digits:10|unique:estudiantes,cedula,' . $estudiante->id, // UX: Validación de la cédula
            'email' => 'required|string|email|max:255|unique:estudiantes,email,' . $estudiante->id, // UX: Validación del correo electrónico
            'telefono' => 'required|string|digits:10', // UX: Validación del teléfono
        ],[
            'email.unique' => 'No se puede repetir el correo', // UX: Mensaje de error personalizado
        ]);

        $estudiante->update($validated); // UI: Actualiza el estudiante en la base de datos

        return redirect()->route("estudiantes.index")->with([
            "message" => "Estudiante actualizado exitosamente", // UX: Mensaje de éxito
            "type" => "success" // UX: Tipo de mensaje
        ]);
    }

    public function destroy(Estudiante $estudiante)
    {
        $estudiante->delete(); // UI: Elimina el estudiante de la base de datos

        return redirect()->route("estudiantes.index")->with([
            "message" => "Estudiante eliminado exitosamente", // UX: Mensaje de éxito
            "type" => "success" // UX: Tipo de mensaje
        ]);
    }
}