<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory; // UI: Habilita el uso de fábricas de modelos

    public $timestamps = false; // UI: Desactiva las marcas de tiempo automáticas

    protected $table = 'cursos'; // UI: Define el nombre de la tabla asociada al modelo

    protected $fillable = [
        'codigo', // UI: Campo que puede ser asignado en masa
        'descripcion', // UI: Campo que puede ser asignado en masa
        'nombre', // UI: Campo que puede ser asignado en masa
        'profesor_id', // UI: Campo que puede ser asignado en masa
    ];

    public function profesor()
    {
        return $this->belongsTo(Profesor::class); // UI: Define la relación de pertenencia con el modelo Profesor
    }

    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'curso_estudiante'); // UI: Define la relación de muchos a muchos con el modelo Estudiante
    }

    public function clases()
    {
        return $this->hasMany(Clase::class); // UI: Define la relación de uno a muchos con el modelo Clase
    }
}