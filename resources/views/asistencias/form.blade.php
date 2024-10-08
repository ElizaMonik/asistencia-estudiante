@extends('adminlte::page')

@section('title', isset($asistencia) ? 'Editar Asistencia' : 'Registrar Asistencia')

@section('content_header')
    <h1>{{ isset($asistencia) ? 'Editar Asistencia' : 'Registrar Asistencia' }}</h1>
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
                        <label for="clase_id">Clase</label>
                        <select class="form-control" id="clase_id" name="clase_id" required>
                            @foreach ($clases as $clase)
                                <option value="{{ $clase->id }}" {{ isset($asistencia) && $asistencia->clase_id == $clase->id ? 'selected' : '' }}>
                                    {{ $clase->fecha_hora }} - {{ $clase->curso->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estudiante_id">Estudiante</label>
                        <select class="form-control" id="estudiante_id" name="estudiante_id" required>
                            @foreach ($estudiantes as $estudiante)
                                <option value="{{ $estudiante->id }}" {{ isset($asistencia) && $asistencia->estudiante_id == $estudiante->id ? 'selected' : '' }}>
                                    {{ $estudiante->nombre }} {{ $estudiante->apellido }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="PRESENTE" {{ isset($asistencia) && $asistencia->estado == 'PRESENTE' ? 'selected' : '' }}>Presente</option>
                            <option value="AUSENTE" {{ isset($asistencia) && $asistencia->estado == 'AUSENTE' ? 'selected' : '' }}>Ausente</option>
                            <option value="TARDE" {{ isset($asistencia) && $asistencia->estado == 'TARDE' ? 'selected' : '' }}>Tarde</option>
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
