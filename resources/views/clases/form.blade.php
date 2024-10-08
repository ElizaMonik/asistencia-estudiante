@extends('adminlte::page')

@section('title', isset($clase) ? 'Editar Clase' : 'Nueva Clase')

@section('content_header')
    <h1>{{ isset($clase) ? 'Editar Clase' : 'Nueva Clase' }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ isset($clase) ? route('clases.update', ['clase' => $clase->id]) : route('clases.store') }}" method="POST">
                @csrf
                @if (isset($clase))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', isset($clase) ? $clase->nombre : '') }}" required>
                </div>

                <div class="form-group">
                    <label for="fecha_hora">Fecha - Hora</label>
                    <input type="datetime-local" class="form-control" id="fecha_hora" name="fecha_hora" value="{{ old('fecha_hora', isset($clase) ? date('Y-m-d\TH:i', strtotime($clase->fecha_hora)) : '') }}" required>
                </div>

                <!-- Selección del curso -->
                <div class="form-group">
                    <label for="curso_id">Curso</label>
                    <select class="form-control" id="curso_id" name="curso_id" required>
                        <option value="">Seleccione un curso</option>
                        @foreach ($cursos as $curso)
                            <option value="{{ $curso->id }}" {{ old('curso_id', isset($clase) ? $clase->curso_id : '') == $curso->id ? 'selected' : '' }}>
                                {{ $curso->nombre }}
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