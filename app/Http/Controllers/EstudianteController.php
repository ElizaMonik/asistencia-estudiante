<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estudiantes = Estudiante::all();
        return response()->json($estudiantes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'apellido' => 'required|string|max:255',
            'cedula' => 'required|string|max:255|unique:estudiantes',
            'email' => 'required|email|max:255|unique:estudiantes',
            'nombre' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:255',
        ]);

        $estudiante = Estudiante::create($validatedData);
        return response()->json(['message' => 'Estudiante creado con éxito', 'estudiante' => $estudiante]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Estudiante $estudiante)
    {
        $estudiante = Estudiante::findOrFail($id);
        return response()->json($estudiante);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estudiante $estudiante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'apellido' => 'required|string|max:255',
            'cedula' => 'required|string|max:255|unique:estudiantes,cedula,' . $id,
            'email' => 'required|email|max:255|unique:estudiantes,email,' . $id,
            'nombre' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:255',
        ]);
    
        $estudiante = Estudiante::findOrFail($id);
        $estudiante->update($validatedData);
        return response()->json(['message' => 'Estudiante actualizado con éxito', 'estudiante' => $estudiante]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estudiante $estudiante)
    {
        $estudiante = Estudiante::findOrFail($id);
        $estudiante->delete();
        return response()->json(['message' => 'Estudiante eliminado con éxito']);
    }
}
