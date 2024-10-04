<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    // Definir la tabla asociada
    protected $table = 'estudiantes';

    // Definir los atributos que se pueden asignar masivamente
    protected $fillable = [
        'apellido',
        'cedula',
        'email',
        'nombre',
        'telefono',
    ];

/**
 * Relación muchos a muchos con el modelo Curso.
 */
/**public function cursos()
{
    return $this->belongsToMany(Curso::class, 'curso_estudiante', 'estudiante_id', 'curso_id');
}

/**
 * Relación uno a muchos con el modelo Asistencia.
 */
/**public function asistencias()
{
    return $this->hasMany(Asistencia::class);
} */
}