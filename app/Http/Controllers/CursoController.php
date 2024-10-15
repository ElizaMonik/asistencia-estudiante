<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Profesor;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::all(); // UI: Obtiene todos los cursos
        return view('cursos.index', compact('cursos')); // UI: Renderiza la vista de la lista de cursos
    }

    public function create()
    {
        $profesores = Profesor::all(); // UI: Obtiene todos los profesores
        return view('cursos.form', compact('profesores')); // UI: Renderiza la vista del formulario de creación de cursos
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:255', // UX: Validación del código del curso
            'nombre' => 'required|string|max:255', // UX: Validación del nombre del curso
            'descripcion' => 'nullable|string|max:255', // UX: Validación de la descripción del curso
            'profesor_id' => 'nullable|exists:profesores,id', // UX: Validación del ID del profesor
        ]);

        Curso::create($validated); // UI: Crea un nuevo curso en la base de datos

        return redirect()->route("cursos.index")->with([
            "message" => "Curso creado exitosamente", // UX: Mensaje de éxito
            "type" => "success" // UX: Tipo de mensaje
        ]);
    }

    public function edit(Curso $curso)
    {
        $profesores = Profesor::all(); // UI: Obtiene todos los profesores
        return view('cursos.form', compact('curso', 'profesores')); // UI: Renderiza la vista del formulario de edición de cursos
    }

    public function update(Request $request, Curso $curso)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:255', // UX: Validación del código del curso
            'nombre' => 'required|string|max:255', // UX: Validación del nombre del curso
            'descripcion' => 'nullable|string|max:255', // UX: Validación de la descripción del curso
            'profesor_id' => 'nullable|exists:profesores,id', // UX: Validación del ID del profesor
        ]);

        $curso->update($validated); // UI: Actualiza el curso en la base de datos

        return redirect()->route("cursos.index")->with([
            "message" => "Curso actualizado exitosamente", // UX: Mensaje de éxito
            "type" => "success" // UX: Tipo de mensaje
        ]);
    }

    public function destroy(Curso $curso)
    {
        $curso->delete(); // UI: Elimina el curso de la base de datos

        return redirect()->route("cursos.index")->with([
            "message" => "Curso eliminado exitosamente", // UX: Mensaje de éxito
            "type" => "success" // UX: Tipo de mensaje
        ]);
    }

    // Nueva función para subir la foto del profesor
    public function uploadPhoto(Request $request, $id)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // UX: Validación de la foto del profesor
        ]);

        $curso = Curso::findOrFail($id); // UI: Encuentra el curso por ID

        if ($request->hasFile('photo')) {
            $image = $request->file('photo'); // UI: Obtiene el archivo de la foto
            $name = time().'.'.$image->getClientOriginalExtension(); // UI: Genera un nombre único para la foto
            $destinationPath = public_path('/path_to_professor_image'); // UI: Define la ruta de destino para la foto
            $image->move($destinationPath, $name); // UI: Mueve la foto a la ruta de destino

            // Assuming the Curso model has a relationship with Profesor
            $curso->profesor->imagen = $name; // UI: Asigna el nombre de la foto al profesor
            $curso->profesor->save(); // UI: Guarda los cambios en el profesor
        }

        return redirect()->route('cursos.index')->with('success', 'Foto subida correctamente'); // UX: Mensaje de éxito
    }
}