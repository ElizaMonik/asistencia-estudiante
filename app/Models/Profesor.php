<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory; // UI: Habilita el uso de fábricas de modelos

    public $timestamps = false; // UI: Desactiva las marcas de tiempo automáticas

    protected $table = 'profesores'; // UI: Define el nombre de la tabla asociada al modelo

    protected $fillable = [
        'apellido', // UI: Campo que puede ser asignado en masa
        'cedula', // UI: Campo que puede ser asignado en masa
        'email', // UI: Campo que puede ser asignado en masa
        'nombre', // UI: Campo que puede ser asignado en masa
        'password', // UI: Campo que puede ser asignado en masa
        'imagen', // UI: Campo que puede ser asignado en masa
    ];

    public function cursos()
    {
        return $this->hasMany(Curso::class); // UI: Define la relación de uno a muchos con el modelo Curso
    }
}