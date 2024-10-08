@extends('adminlte::page')

@section('title', isset($reporte) ? 'Editar Reporte' : 'Nuevo Reporte')

@section('content_header')
    <h1>{{ isset($reporte) ? 'Editar Reporte' : 'Nuevo Reporte' }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if (isset($reporte))
                <form action="{{ route('reportes.update', ['reporte' => $reporte->id]) }}" method="POST">
                    @method('PUT')
            @else
                <form action="{{ route('reportes.store') }}" method="POST">
            @endif
                    @csrf

                    <div class="form-group">
                        <label for="clase_id">Clase</label>
                        <select class="form-control" id="clase_id" name="clase_id" required>
                            <option value="">Selecciona una clase</option>
                            @foreach ($clases as $clase)
                                <option value="{{ $clase->id }}" {{ isset($reporte) && $reporte->clase_id == $clase->id ? 'selected' : '' }}>
                                    {{ $clase->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estudiante_id">Estudiante</label>
                        <select class="form-control" id="estudiante_id" name="estudiante_id" required>
                            <option value="">Selecciona un estudiante</option>
                            @foreach ($estudiantes as $estudiante)
                                <option value="{{ $estudiante->id }}" {{ isset($reporte) && $reporte->estudiante_id == $estudiante->id ? 'selected' : '' }}>
                                    {{ $estudiante->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="">Selecciona un estado</option>
                            <option value="PRESENTE" {{ isset($reporte) && $reporte->estado == 'PRESENTE' ? 'selected' : '' }}>Presente</option>
                            <option value="AUSENTE" {{ isset($reporte) && $reporte->estado == 'AUSENTE' ? 'selected' : '' }}>Ausente</option>
                            <option value="TARDE" {{ isset($reporte) && $reporte->estado == 'TARDE' ? 'selected' : '' }}>Tarde</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ isset($reporte) ? $reporte->fecha : '' }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">{{ isset($reporte) ? 'Actualizar' : 'Crear' }}</button>
                    <a href="{{ route('reportes.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
        </div>
    </div>
@stop
