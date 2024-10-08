<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'cursos';

    protected $fillable = [
        'codigo',
        'descripcion',
        'nombre',
        'profesor_id',
    ];

    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }

    public function estudiantes()
    {
        return $this->belongsToMany(Estudiante::class, 'curso_estudiante');
    }

    public function clases()
    {
        return $this->hasMany(Clase::class);
    }
}
