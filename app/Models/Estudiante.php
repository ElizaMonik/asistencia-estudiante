<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    public $timestamps = false; 

    protected $table = 'estudiantes';

    protected $fillable = [
        'apellido',
        'cedula',
        'email',
        'nombre',
        'telefono',
    ];
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_estudiante');
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
    
}