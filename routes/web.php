<?php
// routes/web.php

use App\Http\Controllers\ClaseController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\ReporteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('estudiantes', EstudianteController::class);
    Route::resource('profesores', ProfesorController::class);
    Route::resource('clases', ClaseController::class);
    Route::resource('cursos', CursoController::class);
    Route::resource('asistencias', AsistenciaController::class);
    Route::resource('reportes', ReporteController::class);

    // Define the route for uploading a photo
    Route::post('cursos/{curso}/upload_photo', [CursoController::class, 'uploadPhoto'])->name('cursos.upload_photo');
});