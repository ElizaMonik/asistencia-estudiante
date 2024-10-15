@extends('adminlte::page')

@section('title', isset($asistencia) ? 'Editar Asistencia' : 'Registrar Asistencia') <!-- UI: Título dinámico de la página -->

@section('content_header')
    <h1>{{ isset($asistencia) ? 'Editar Asistencia' : 'Registrar Asistencia' }}</h1> <!-- UI: Encabezado dinámico de la página -->
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if (isset($asistencia))
                <form action="{{ route('asistencias.update', ['asistencia' => $asistencia->id]) }}" method="POST"> <!-- UX: Formulario para editar asistencia -->
                    @method('PUT')
            @else
                <form action="{{ route('asistencias.store') }}" method="POST"> <!-- UX: Formulario para registrar nueva asistencia -->
            @endif
                    @csrf

                    <div class="form-group">
                        <label for="clase_id">Clase</label> <!-- UI: Etiqueta para el campo de selección de clase -->
                        <select class="form-control" id="clase_id" name="clase_id" required> <!-- UX: Campo de selección de clase -->
                            @foreach ($clases as $clase)
                                <option value="{{ $clase->id }}" {{ isset($asistencia) && $asistencia->clase_id == $clase->id ? 'selected' : '' }}>
                                    {{ $clase->fecha_hora }} - {{ $clase->curso->nombre }} <!-- UI: Opciones de clase -->
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estudiante_id">Estudiante</label> <!-- UI: Etiqueta para el campo de selección de estudiante -->
                        <select class="form-control" id="estudiante_id" name="estudiante_id" required> <!-- UX: Campo de selección de estudiante -->
                            @foreach ($estudiantes as $estudiante)
                                <option value="{{ $estudiante->id }}" {{ isset($asistencia) && $asistencia->estudiante_id == $estudiante->id ? 'selected' : '' }}>
                                    {{ $estudiante->nombre }} {{ $estudiante->apellido }} <!-- UI: Opciones de estudiante -->
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label> <!-- UI: Etiqueta para el campo de selección de estado -->
                        <select class="form-control" id="estado" name="estado" required> <!-- UX: Campo de selección de estado -->
                            <option value="PRESENTE" {{ isset($asistencia) && $asistencia->estado == 'PRESENTE' ? 'selected' : '' }}>Presente</option> <!-- UI: Opción de estado -->
                            <option value="AUSENTE" {{ isset($asistencia) && $asistencia->estado == 'AUSENTE' ? 'selected' : '' }}>Ausente</option> <!-- UI: Opción de estado -->
                            <option value="TARDE" {{ isset($asistencia) && $asistencia->estado == 'TARDE' ? 'selected' : '' }}>Tarde</option> <!-- UI: Opción de estado -->
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button> <!-- UX: Botón para enviar el formulario -->
                </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css"> <!-- UI: Estilos personalizados -->
@stop