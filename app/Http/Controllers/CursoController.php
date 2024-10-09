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
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $curso = Curso::findOrFail($id);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/path_to_professor_image');
            $image->move($destinationPath, $name);

            // Assuming the Curso model has a relationship with Profesor
            $curso->profesor->imagen = $name;
            $curso->profesor->save();
        }

        return redirect()->route('cursos.index')->with('success', 'Foto subida correctamente');
    }
}