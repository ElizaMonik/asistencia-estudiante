<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory; // UI: Habilita el uso de fábricas de modelos

    public $timestamps = false; // UI: Desactiva las marcas de tiempo automáticas

    protected $table = 'reportes'; // UI: Define el nombre de la tabla asociada al modelo

    protected $fillable = [
        'clase_id', // UI: Campo que puede ser asignado en masa
        'estudiante_id', // UI: Campo que puede ser asignado en masa
        'estado', // UI: Campo que puede ser asignado en masa
        'fecha', // UI: Campo que puede ser asignado en masa
    ];

    public function clase()
    {
        return $this->belongsTo(Clase::class); // UI: Define la relación de pertenencia con el modelo Clase
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class); // UI: Define la relación de pertenencia con el modelo Estudiante
    }
}