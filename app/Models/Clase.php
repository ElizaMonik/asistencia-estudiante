<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory; // UI: Habilita el uso de fábricas de modelos
    
    public $timestamps = false; // UI: Desactiva las marcas de tiempo automáticas
    protected $table = 'clases'; // UI: Define el nombre de la tabla asociada al modelo

    protected $fillable = [
        'fecha_hora', // UI: Campo que puede ser asignado en masa
        'curso_id', // UI: Campo que puede ser asignado en masa
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class); // UI: Define la relación de pertenencia con el modelo Curso
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class); // UI: Define la relación de uno a muchos con el modelo Asistencia
    }
}