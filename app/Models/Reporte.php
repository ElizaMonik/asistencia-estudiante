<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'reportes';

    protected $fillable = [
        'clase_id',
        'estudiante_id',
        'estado',
        'fecha',
    ];

    public function clase()
    {
        return $this->belongsTo(Clase::class);
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class);
    }
}
