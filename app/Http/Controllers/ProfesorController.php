<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    public function index()
    {
        $profesores = Profesor::all(); // UI: Obtiene todos los profesores
        return view('profesores.index', compact('profesores')); // UI: Renderiza la vista de la lista de profesores
    }

    public function create()
    {
        return view('profesores.form'); // UI: Renderiza la vista del formulario de creación de profesores
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255', // UX: Validación del nombre
            'apellido' => 'required|string|max:255', // UX: Validación del apellido
            'cedula' => 'required|string|max:255|unique:profesores,cedula', // UX: Validación de la cédula
            'email' => 'required|string|email|max:255|unique:profesores,email', // UX: Validación del correo electrónico
            'password' => 'required|string|min:8|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/', // UX: Validación de la contraseña
        ], [
            'email.unique' => 'No se puede repetir el correo', // UX: Mensaje de error personalizado
        ]);

        Profesor::create($validated); // UI: Crea un nuevo profesor en la base de datos

        return redirect()->route("profesores.index")->with([
            "message" => "Profesor creado exitosamente", // UX: Mensaje de éxito
            "type" => "success" // UX: Tipo de mensaje
        ]);
    }

    public function edit(Profesor $profesor)
    {
        return view('profesores.form', compact('profesor')); // UI: Renderiza la vista del formulario de edición de profesores
    }

    public function update(Request $request, Profesor $profesor)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255', // UX: Validación del nombre
            'apellido' => 'required|string|max:255', // UX: Validación del apellido
            'cedula' => 'required|string|max:255|unique:profesores,cedula,' . $profesor->id, // UX: Validación de la cédula
            'email' => 'required|string|email|max:255|unique:profesores,email,' . $profesor->id, // UX: Validación del correo electrónico
            'password' => 'nullable|string|min:8|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/', // UX: Validación de la contraseña
        ], [
            'email.unique' => 'No se puede repetir el correo', // UX: Mensaje de error personalizado
        ]);

        // Si se proporciona una nueva contraseña, actualízala
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password); // UI: Encripta la nueva contraseña
        } else {
            // Si no se proporciona una nueva contraseña, elimina el campo de validación
            unset($validated['password']); // UI: Elimina la contraseña del array de validación
        }

        $profesor->update($validated); // UI: Actualiza el profesor en la base de datos

        return redirect()->route("profesores.index")->with([
            "message" => "Profesor actualizado exitosamente", // UX: Mensaje de éxito
            "type" => "success" // UX: Tipo de mensaje
        ]);
    }

    public function destroy(Profesor $profesor)
    {
        $profesor->delete(); // UI: Elimina el profesor de la base de datos

        return redirect()->route("profesores.index")->with([
            "message" => "Profesor eliminado exitosamente", // UX: Mensaje de éxito
            "type" => "success" // UX: Tipo de mensaje
        ]);
    }
}