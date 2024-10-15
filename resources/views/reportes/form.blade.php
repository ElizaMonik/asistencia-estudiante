@extends('adminlte::page')

@section('title', isset($reporte) ? 'Editar Reporte' : 'Nuevo Reporte') <!-- UI: Título dinámico de la página -->

@section('content_header')
    <h1>{{ isset($reporte) ? 'Editar Reporte' : 'Nuevo Reporte' }}</h1> <!-- UI: Encabezado dinámico de la página -->
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if (isset($reporte))
                <form action="{{ route('reportes.update', ['reporte' => $reporte->id]) }}" method="POST"> <!-- UX: Formulario para editar reporte -->
                    @method('PUT')
            @else
                <form action="{{ route('reportes.store') }}" method="POST"> <!-- UX: Formulario para registrar nuevo reporte -->
            @endif
                    @csrf

                    <div class="form-group">
                        <label for="clase_id">Clase</label> <!-- UI: Etiqueta para el campo de selección de clase -->
                        <select class="form-control" id="clase_id" name="clase_id" required> <!-- UX: Campo de selección de clase -->
                            <option value="">Selecciona una clase</option> <!-- UI: Opción por defecto -->
                            @foreach ($clases as $clase)
                                <option value="{{ $clase->id }}" {{ isset($reporte) && $reporte->clase_id == $clase->id ? 'selected' : '' }}>
                                    {{ $clase->nombre }} <!-- UI: Opciones de clase -->
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estudiante_id">Estudiante</label> <!-- UI: Etiqueta para el campo de selección de estudiante -->
                        <select class="form-control" id="estudiante_id" name="estudiante_id" required> <!-- UX: Campo de selección de estudiante -->
                            <option value="">Selecciona un estudiante</option> <!-- UI: Opción por defecto -->
                            @foreach ($estudiantes as $estudiante)
                                <option value="{{ $estudiante->id }}" {{ isset($reporte) && $reporte->estudiante_id == $estudiante->id ? 'selected' : '' }}>
                                    {{ $estudiante->nombre }} <!-- UI: Opciones de estudiante -->
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label> <!-- UI: Etiqueta para el campo de selección de estado -->
                        <select class="form-control" id="estado" name="estado" required> <!-- UX: Campo de selección de estado -->
                            <option value="">Selecciona un estado</option> <!-- UI: Opción por defecto -->
                            <option value="PRESENTE" {{ isset($reporte) && $reporte->estado == 'PRESENTE' ? 'selected' : '' }}>Presente</option> <!-- UI: Opción de estado -->
                            <option value="AUSENTE" {{ isset($reporte) && $reporte->estado == 'AUSENTE' ? 'selected' : '' }}>Ausente</option> <!-- UI: Opción de estado -->
                            <option value="TARDE" {{ isset($reporte) && $reporte->estado == 'TARDE' ? 'selected' : '' }}>Tarde</option> <!-- UI: Opción de estado -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fecha">Fecha</label> <!-- UI: Etiqueta para el campo de fecha -->
                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ isset($reporte) ? $reporte->fecha : '' }}" required> <!-- UX: Campo de entrada para fecha -->
                    </div>

                    <button type="submit" class="btn btn-primary">{{ isset($reporte) ? 'Actualizar' : 'Crear' }}</button> <!-- UX: Botón para enviar el formulario -->
                    <a href="{{ route('reportes.index') }}" class="btn btn-secondary">Cancelar</a> <!-- UX: Botón para cancelar -->
                </form>
        </div>
    </div>
@stop