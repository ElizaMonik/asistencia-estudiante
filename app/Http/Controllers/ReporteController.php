<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reporte;
use App\Models\Clase;
use App\Models\Estudiante;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function index()
    {
        // Cargar las relaciones 'clase' y 'estudiante'
        $reportes = Reporte::with(['clase', 'estudiante'])->get(); 
        return view('reportes.index', compact('reportes')); // UI: Renderiza la vista de la lista de reportes
    }
    
    public function create()
    {
        $clases = Clase::all(); 
        $estudiantes = Estudiante::all(); 

        return view('reportes.form', compact('clases', 'estudiantes')); // UI: Renderiza la vista del formulario de creación de reportes
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'clase_id' => 'required|exists:clases,id', // UX: Validación de la clase seleccionada
            'estudiante_id' => 'required|exists:estudiantes,id', // UX: Validación del estudiante seleccionado
            'estado' => 'required|in:PRESENTE,AUSENTE,TARDE', // UX: Validación del estado seleccionado
            'fecha' => 'required|date', // UX: Validación de la fecha
        ]);

        Reporte::create($validated); // UI: Crea un nuevo reporte en la base de datos

        return redirect()->route("reportes.index")->with([
            "message" => "Reporte creado exitosamente", // UX: Mensaje de éxito
            "type" => "success" // UX: Tipo de mensaje
        ]);
    }

    public function edit(Reporte $reporte)
    {
        $clases = Clase::all(); 
        $estudiantes = Estudiante::all(); 
        return view('reportes.form', compact('reporte', 'clases', 'estudiantes')); // UI: Renderiza la vista del formulario de edición de reportes
    }

    public function update(Request $request, Reporte $reporte)
    {
        $validated = $request->validate([
            'clase_id' => 'required|exists:clases,id', // UX: Validación de la clase seleccionada
            'estudiante_id' => 'required|exists:estudiantes,id', // UX: Validación del estudiante seleccionado
            'estado' => 'required|in:PRESENTE,AUSENTE,TARDE', // UX: Validación del estado seleccionado
            'fecha' => 'required|date', // UX: Validación de la fecha
        ]);

        $reporte->update($validated); // UI: Actualiza el reporte en la base de datos

        return redirect()->route("reportes.index")->with([
            "message" => "Reporte actualizado exitosamente", // UX: Mensaje de éxito
            "type" => "success" // UX: Tipo de mensaje
        ]);
    }

    public function destroy(Reporte $reporte)
    {
        $reporte->delete(); // UI: Elimina el reporte de la base de datos

        return redirect()->route("reportes.index")->with([
            "message" => "Reporte eliminado exitosamente", // UX: Mensaje de éxito
            "type" => "success" // UX: Tipo de mensaje
        ]);
    }

    public function generatePDF()
    {
        $reportes = Reporte::with(['clase', 'estudiante'])->get(); // UI: Obtiene los reportes con sus relaciones
        $pdf = PDF::loadView('reportes.pdf', compact('reportes')); // UI: Carga la vista del PDF con los datos de los reportes
        return $pdf->download('reportes.pdf'); // UX: Descarga el PDF generado
    }

    public function pdf()
    {
        return view("reportes.pdf"); // UI: Renderiza la vista del PDF
    }
}