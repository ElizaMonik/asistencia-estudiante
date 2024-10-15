<?php

use App\Http\Controllers\ClaseController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\ReporteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Ruta de inicio
Route::get('/', function () {
    return view('auth.login');
});

// Rutas de autenticación
Auth::routes();

// Ruta de inicio una vez autenticado
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    // Especificamos el parámetro 'profesor' para el recurso 'profesores'
    Route::resource('profesores', ProfesorController::class)->parameters([
        'profesores' => 'profesor'
    ]);
      // Ruta para generar PDF de reportes
    Route::get('reportes/pdf', [ReporteController::class, 'generatePDF'])->name('reportes.pdf');
    Route::resource('reportes', ReporteController::class);
    Route::resource('estudiantes', EstudianteController::class);
    Route::resource('clases', ClaseController::class);
    Route::resource('cursos', CursoController::class);
    Route::resource('asistencias', AsistenciaController::class);
    Route::resource('reportes', ReporteController::class);
    // Ruta para subir una foto a un curso
    Route::post('cursos/{curso}/upload_photo', [CursoController::class, 'uploadPhoto'])->name('cursos.upload_photo');
});
