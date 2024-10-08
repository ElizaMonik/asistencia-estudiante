@extends('adminlte::page')

@section('title', isset($clase) ? 'Editar Clase' : 'Nueva Clase')

@section('content_header')
    <h1>{{ isset($clase) ? 'Editar Clase' : 'Nueva Clase' }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if (isset($clase))
                <form action="{{ route('clases.update', ['clase' => $clase->id]) }}" method="POST">
                    @method('PUT')
            @else
                <form action="{{ route('clases.store') }}" method="POST">
            @endif
                    @csrf

                    <div class="form-group">
                        <label for="fecha_hora">Fecha y Hora</label>
                        <input type="datetime-local" class="form-control" id="fecha_hora" name="fecha_hora" value="{{ old('fecha_hora', isset($clase) ? $clase->fecha_hora : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="curso_id">Curso</label>
                        <select class="form-control" id="curso_id" name="curso_id" required>
                            @foreach ($cursos as $curso)
                                <option value="{{ $curso->id }}" {{ isset($clase) && $clase->curso_id == $curso->id ? 'selected' : '' }}>
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
