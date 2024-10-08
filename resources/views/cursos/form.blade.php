@extends('adminlte::page')

@section('title', isset($curso) ? 'Editar Curso' : 'Nuevo Curso')

@section('content_header')
    <h1>{{ isset($curso) ? 'Editar Curso' : 'Nuevo Curso' }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if (isset($curso))
                <form action="{{ route('cursos.update', ['curso' => $curso->id]) }}" method="POST">
                    @method('PUT')
            @else
                <form action="{{ route('cursos.store') }}" method="POST">
            @endif
                    @csrf

                    <div class="form-group">
                        <label for="codigo">Código</label>
                        <input type="text" class="form-control" id="codigo" name="codigo" value="{{ old('codigo', isset($curso) ? $curso->codigo : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', isset($curso) ? $curso->nombre : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" required>{{ old('descripcion', isset($curso) ? $curso->descripcion : '') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="profesor_id">Profesor</label>
                        <select class="form-control" id="profesor_id" name="profesor_id" required>
                            @foreach ($profesores as $profesor)
                                <option value="{{ $profesor->id }}" {{ isset($curso) && $curso->profesor_id == $profesor->id ? 'selected' : '' }}>
                                    {{ $profesor->nombre }} {{ $profesor->apellido }}
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
