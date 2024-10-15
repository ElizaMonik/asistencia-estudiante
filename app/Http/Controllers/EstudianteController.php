<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::all();
        return view('estudiantes.index', compact('estudiantes'));
    }

    public function create()
    {
        return view('estudiantes.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cedula' => 'required|numeric|digits:10|unique:estudiantes,cedula',
            'email' => 'required|string|email|max:255|unique:estudiantes,email',
            'telefono' => 'required|string|digits:10',
        ],[
            'email.unique' => 'No se puede repetir el correo',
     ]);

        Estudiante::create($validated);

        return redirect()->route("estudiantes.index")->with([
            "message" => "Estudiante creado exitosamente",
            "type" => "success"
        ]);
    }

    public function edit(Estudiante $estudiante)
    {
        return view('estudiantes.form', compact('estudiante'));
    }

    public function update(Request $request, Estudiante $estudiante)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cedula' => 'required|numeric|digits:10|unique:estudiantes,cedula,' . $estudiante->id,
            'email' => 'required|string|email|max:255|unique:estudiantes,email,' . $estudiante->id,
            'telefono' => 'required|string|digits:10',
        ],[
                'email.unique' => 'No se puede repetir el correo',
         ]);
        $estudiante->update($validated);

        return redirect()->route("estudiantes.index")->with([
            "message" => "Estudiante actualizado exitosamente",
            "type" => "success"
        ]);
    }

    public function destroy(Estudiante $estudiante)
    {
        $estudiante->delete();

        return redirect()->route("estudiantes.index")->with([
            "message" => "Estudiante eliminado exitosamente",
            "type" => "success"
        ]);
    }
}
