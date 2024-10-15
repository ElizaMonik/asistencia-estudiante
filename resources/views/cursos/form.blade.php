@extends('adminlte::page')

@section('title', isset($curso) ? 'Editar Curso' : 'Nuevo Curso') <!-- UI: Título dinámico de la página -->

@section('content_header')
    <h1>{{ isset($curso) ? 'Editar Curso' : 'Nuevo Curso' }}</h1> <!-- UI: Encabezado dinámico de la página -->
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if (isset($curso))
                <form action="{{ route('cursos.update', ['curso' => $curso->id]) }}" method="POST"> <!-- UX: Formulario para editar curso -->
                    @method('PUT')
            @else
                <form action="{{ route('cursos.store') }}" method="POST"> <!-- UX: Formulario para registrar nuevo curso -->
            @endif
                    @csrf

                    <div class="form-group">
                        <label for="codigo">Código</label> <!-- UI: Etiqueta para el campo de código -->
                        <input type="text" class="form-control" id="codigo" name="codigo" value="{{ old('codigo', isset($curso) ? $curso->codigo : '') }}" required> <!-- UX: Campo de entrada para código -->
                    </div>

                    <div class="form-group">
                        <label for="nombre">Nombre</label> <!-- UI: Etiqueta para el campo de nombre -->
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', isset($curso) ? $curso->nombre : '') }}" required> <!-- UX: Campo de entrada para nombre -->
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción</label> <!-- UI: Etiqueta para el campo de descripción -->
                        <textarea class="form-control" id="descripcion" name="descripcion" required>{{ old('descripcion', isset($curso) ? $curso->descripcion : '') }}</textarea> <!-- UX: Campo de entrada para descripción -->
                    </div>

                    <div class="form-group">
                        <label for="profesor_id">Profesor</label> <!-- UI: Etiqueta para el campo de selección de profesor -->
                        <select class="form-control" id="profesor_id" name="profesor_id" required> <!-- UX: Campo de selección de profesor -->
                            @foreach ($profesores as $profesor)
                                <option value="{{ $profesor->id }}" {{ isset($curso) && $curso->profesor_id == $profesor->id ? 'selected' : '' }}>
                                    {{ $profesor->nombre }} {{ $profesor->apellido }} <!-- UI: Opciones de profesor -->
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