<?php

use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ClaseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('estudiantes', EstudianteController::class);
    Route::resource('clases', ClaseController::class);
});