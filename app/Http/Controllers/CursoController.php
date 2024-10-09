<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Profesor;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::all();
        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        $profesores = Profesor::all();
        return view('cursos.form', compact('profesores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'profesor_id' => 'nullable|exists:profesores,id',
        ]);

        Curso::create($validated);

        return redirect()->route("cursos.index")->with([
            "message" => "Curso creado exitosamente",
            "type" => "success"
        ]);
    }

    public function edit(Curso $curso)
    {
        $profesores = Profesor::all();
        return view('cursos.form', compact('curso', 'profesores'));
    }

    public function update(Request $request, Curso $curso)
    {
        $validated = $request->validate([
            'codigo' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'profesor_id' => 'nullable|exists:profesores,id',
        ]);

        $curso->update($validated);

        return redirect()->route("cursos.index")->with([
            "message" => "Curso actualizado exitosamente",
            "type" => "success"
        ]);
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();

        return redirect()->route("cursos.index")->with([
            "message" => "Curso eliminado exitosamente",
            "type" => "success"
        ]);
    }

    // Nueva función para subir la foto del profesor
    public function uploadPhoto(Request $request, $id)
    {
        // Validar la imagen
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Buscar el profesor asociado al curso
        $profesor = Profesor::findOrFail($id);

        // Generar un nombre único para la imagen
        $fileName = time() . '.' . $request->photo->extension();

        // Mover la imagen a la carpeta de imágenes del profesor
        $request->photo->move(public_path('images/profesores'), $fileName);

        // Actualizar la ruta de la imagen en el modelo del profesor
        $profesor->imagen = $fileName;
        $profesor->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('cursos.index')->with('success', 'Foto del profesor subida exitosamente.');
    }
}
