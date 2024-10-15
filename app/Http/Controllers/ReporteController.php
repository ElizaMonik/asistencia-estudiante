<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reporte;
use App\Models\Clase;
use App\Models\Estudiante;

class ReporteController extends Controller
{
    public function index()
    {
        // Cargar las relaciones 'clase' y 'estudiante'
        $reportes = Reporte::with(['clase', 'estudiante'])->get(); 
        return view('reportes.index', compact('reportes'));
    }
    
    public function create()
    {
        $clases = Clase::all(); 
        $estudiantes = Estudiante::all(); 

        return view('reportes.form', compact('clases', 'estudiantes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'clase_id' => 'required|exists:clases,id',
            'estudiante_id' => 'required|exists:estudiantes,id',
            'estado' => 'required|in:PRESENTE,AUSENTE,TARDE',
            'fecha' => 'required|date',
        ]);

        Reporte::create($validated);

        return redirect()->route("reportes.index")->with([
            "message" => "Reporte creado exitosamente",
            "type" => "success"
        ]);
    }

    public function edit(Reporte $reporte)
    {
        $clases = Clase::all(); 
        $estudiantes = Estudiante::all(); 
        return view('reportes.form', compact('reporte', 'clases', 'estudiantes'));
    }

    public function update(Request $request, Reporte $reporte)
    {
        $validated = $request->validate([
            'clase_id' => 'required|exists:clases,id',
            'estudiante_id' => 'required|exists:estudiantes,id',
            'estado' => 'required|in:PRESENTE,AUSENTE,TARDE',
            'fecha' => 'required|date',
        ]);

        $reporte->update($validated);

        return redirect()->route("reportes.index")->with([
            "message" => "Reporte actualizado exitosamente",
            "type" => "success"
        ]);
    }

    public function destroy(Reporte $reporte)
    {
        $reporte->delete();

        return redirect()->route("reportes.index")->with([
            "message" => "Reporte eliminado exitosamente",
            "type" => "success"
        ]);
    }
}
