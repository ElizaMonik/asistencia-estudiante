<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;
    
    public $timestamps = false;
     protected $table = 'clases';

    protected $fillable = [
        'fecha_hora',
        'curso_id',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}
