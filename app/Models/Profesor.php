<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;

    public $timestamps = false; 

    protected $table = 'profesores';

    protected $fillable = [
        'apellido',
        'cedula',
        'email',
        'nombre',
        'password',
    ];

    public function cursos()
    {
        return $this->hasMany(Curso::class);
    }
}
