@extends('adminlte::page')

@section('title', isset($curso) ? 'Editar Curso' : 'Nuevo Curso')

@section('content_header')
<h1>{{ isset($curso) ? 'Editar Curso' : 'Nuevo Curso' }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ isset($curso) ? route('cursos.update', ['curso' => $curso->id]) : route('cursos.store') }}"
            method="POST">
            @csrf
            @if (isset($curso))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                    value="{{ old('nombre', isset($curso) ? $curso->nombre : '') }}" required>
            </div>

            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" class="form-control" id="codigo" name="codigo"
                    value="{{ old('codigo', isset($curso) ? $curso->codigo : '') }}" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion"
                    required>{{ old('descripcion', isset($curso) ? $curso->descripcion : '') }}</textarea>
            </div>
            <!-- Selección del profesor -->
            <div class="form-group">
                <label for="profesor_id">Profesor</label>
                <select class="form-control" id="profesor_id" name="profesor_id" required>
                    <option value="">Seleccione un profesor</option>
                    @foreach ($profesores as $profesor)
                        <option value="{{ $profesor->id }}" {{ old('profesor_id', isset($curso) ? $curso->profesor_id : '') == $profesor->id ? 'selected' : '' }}>
                            {{ $profesor->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop