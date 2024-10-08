@extends('adminlte::page')

@section('title', isset($asistencia) ? 'Editar Asistencia' : 'Nueva Asistencia')

@section('content_header')
    <h1>{{ isset($asistencia) ? 'Editar Asistencia' : 'Nueva Asistencia' }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if (isset($asistencia))
                <form action="{{ route('asistencias.update', ['asistencia' => $asistencia->id]) }}" method="POST">
                    @method('PUT')
            @else
                <form action="{{ route('asistencias.store') }}" method="POST">
            @endif
                    @csrf

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="PRESENTE" {{ old('estado', isset($asistencia) ? $asistencia->estado : '') == 'PRESENTE' ? 'selected' : '' }}>PRESENTE</option>
                            <option value="AUSENTE" {{ old('estado', isset($asistencia) ? $asistencia->estado : '') == 'AUSENTE' ? 'selected' : '' }}>AUSENTE</option>
                            <option value="TARDE" {{ old('estado', isset($asistencia) ? $asistencia->estado : '') == 'TARDE' ? 'selected' : '' }}>TARDE</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="clase_id">Clase</label>
                        <input type="number" class="form-control" id="clase_id" name="clase_id" value="{{ old('clase_id', isset($asistencia) ? $asistencia->clase_id : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="estudiante_id">Estudiante</label>
                        <input type="number" class="form-control" id="estudiante_id" name="estudiante_id" value="{{ old('estudiante_id', isset($asistencia) ? $asistencia->estudiante_id : '') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
