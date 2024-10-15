@extends('adminlte::page')

@section('title', isset($clase) ? 'Editar Clase' : 'Nueva Clase') <!-- UI: Título dinámico de la página -->

@section('content_header')
    <h1>{{ isset($clase) ? 'Editar Clase' : 'Nueva Clase' }}</h1> <!-- UI: Encabezado dinámico de la página -->
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if (isset($clase))
                <form action="{{ route('clases.update', ['clase' => $clase->id]) }}" method="POST"> <!-- UX: Formulario para editar clase -->
                    @method('PUT')
            @else
                <form action="{{ route('clases.store') }}" method="POST"> <!-- UX: Formulario para registrar nueva clase -->
            @endif
                    @csrf

                    <div class="form-group">
                        <label for="fecha_hora">Fecha y Hora</label> <!-- UI: Etiqueta para el campo de fecha y hora -->
                        <input type="datetime-local" class="form-control" id="fecha_hora" name="fecha_hora" value="{{ old('fecha_hora', isset($clase) ? $clase->fecha_hora : '') }}" required> <!-- UX: Campo de entrada para fecha y hora -->
                    </div>

                    <div class="form-group">
                        <label for="curso_id">Curso</label> <!-- UI: Etiqueta para el campo de selección de curso -->
                        <select class="form-control" id="curso_id" name="curso_id" required> <!-- UX: Campo de selección de curso -->
                            @foreach ($cursos as $curso)
                                <option value="{{ $curso->id }}" {{ isset($clase) && $clase->curso_id == $curso->id ? 'selected' : '' }}>
                                    {{ $curso->nombre }} <!-- UI: Opciones de curso -->
                                </option>
                            @endforeach
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