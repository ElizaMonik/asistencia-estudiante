<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    public function index()
    {
        $profesores = Profesor::all();
        return view('profesores.index', compact('profesores'));
    }

    public function create()
    {
        return view('profesores.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cedula' => 'required|string|max:255|unique:profesores,cedula',
            'email' => 'required|string|email|max:255|unique:profesores,email',
            'password' => 'required|string|min:8',
        ]);

        Profesor::create($validated);

        return redirect()->route("profesores.index")->with([
            "message" => "Profesor creado exitosamente",
            "type" => "success"
        ]);
    }

    public function edit(Profesor $profesor)
    {
        return view('profesores.form', compact('profesor'));
    }

    public function update(Request $request, Profesor $profesor)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cedula' => 'required|string|max:255|unique:profesores,cedula,' . $profesor->id,
            'email' => 'required|string|email|max:255|unique:profesores,email,' . $profesor->id,
            'password' => 'nullable|string|min:8',
        ]);

        $profesor->update($validated);

        return redirect()->route("profesores.index")->with([
            "message" => "Profesor actualizado exitosamente",
            "type" => "success"
        ]);
    }

    public function destroy(Profesor $profesor)
    {
        $profesor->delete();

        return redirect()->route("profesores.index")->with([
            "message" => "Profesor eliminado exitosamente",
            "type" => "success"
        ]);
    }
}
