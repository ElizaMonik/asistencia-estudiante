<?php

namespace App\Http\Controllers;

use App\Models\Curso;
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
        return view('cursos.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'nombre' => 'required|max:255',
            'profesor_id' => 'required|exists:profesores,id'
        ]);

        Curso::create($request->all());

        return redirect()->route('cursos.index')->with(['message' => 'Curso registrado satisfactoriamente', 'type' => 'success']);
    
    }

    public function show(string $id)
    {
        return Curso::find($id);
    }

    public function edit(string $id)
    {
        $curso = Curso::find($id);
        return view('cursos.form', compact('curso'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'codigo' => 'required|max:255',
            'descripcion' => 'required|max:255',
            'nombre' => 'required|max:255',
            'profesor_id' => 'required|exists:usuarios,id'
        ]);

        $curso = Curso::findOrFail($id);

        $curso->fill($request->all());
        if ($curso->isClean()) {
            return redirect()->back()->with(['message' => 'Por lo menos un valor debe cambiar', 'type' => 'danger']);
        }

        $curso->save();

        return redirect()->route('cursos.index')->with(['message' => 'Curso actualizado satisfactoriamente', 'type' => 'success']);
    
    }

    public function destroy(string $id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();

        return redirect()->route('cursos.index')->with([
            'message' => 'Curso eliminado satisfactoriamente', 
            'type' => 'success'
        ]);
    }
}
