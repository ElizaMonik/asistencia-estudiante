@extends('adminlte::page')

@section('title', isset($estudiante) ? 'Editar Estudiante' : 'Nuevo Estudiante') <!-- UI: Título dinámico de la página -->

@section('content_header')
    <h1>{{ isset($estudiante) ? 'Editar Estudiante' : 'Nuevo Estudiante' }}</h1> <!-- UI: Encabezado dinámico de la página -->
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Mostrar alerta solo si hay un error en el campo 'email' -->
            @if ($errors->has('email'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '{{ $errors->first('email') }}',
                        confirmButtonText: 'Ok'
                    });
                </script>
            @endif

            <!-- Formulario -->
            @if (isset($estudiante))
                <form action="{{ route('estudiantes.update', ['estudiante' => $estudiante->id]) }}" method="POST"> <!-- UX: Formulario para editar estudiante -->
                    @method('PUT')
            @else
                <form action="{{ route('estudiantes.store') }}" method="POST"> <!-- UX: Formulario para registrar nuevo estudiante -->
            @endif
                    @csrf

                    <div class="form-group">
                        <label for="nombre">Nombre</label> <!-- UI: Etiqueta para el campo de nombre -->
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', isset($estudiante) ? $estudiante->nombre : '') }}" required> <!-- UX: Campo de entrada para nombre -->
                    </div>

                    <div class="form-group">
                        <label for="apellido">Apellido</label> <!-- UI: Etiqueta para el campo de apellido -->
                        <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido', isset($estudiante) ? $estudiante->apellido : '') }}" required> <!-- UX: Campo de entrada para apellido -->
                    </div>

                    <div class="form-group">
                        <label for="cedula">Cédula</label> <!-- UI: Etiqueta para el campo de cédula -->
                        <input type="text" class="form-control" id="cedula" name="cedula" value="{{ old('cedula', isset($estudiante) ? $estudiante->cedula : '') }}" required> <!-- UX: Campo de entrada para cédula -->
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico</label> <!-- UI: Etiqueta para el campo de correo electrónico -->
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', isset($estudiante) ? $estudiante->email : '') }}" required> <!-- UX: Campo de entrada para correo electrónico -->
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono</label> <!-- UI: Etiqueta para el campo de teléfono -->
                        <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', isset($estudiante) ? $estudiante->telefono : '') }}" required> <!-- UX: Campo de entrada para teléfono -->
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button> <!-- UX: Botón para enviar el formulario -->
                </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css"> <!-- UI: Estilos personalizados -->
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if ($errors->has('email'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ $errors->first('email') }}',
                confirmButtonText: 'Ok'
            });
        @endif
    </script>
@stop