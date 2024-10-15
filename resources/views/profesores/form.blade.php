@extends('adminlte::page')

@section('title', isset($profesor) ? 'Editar Profesor' : 'Nuevo Profesor') <!-- UI: Título dinámico de la página -->

@section('content_header')
    <h1>{{ isset($profesor) ? 'Editar Profesor' : 'Nuevo Profesor' }}</h1> <!-- UI: Encabezado dinámico de la página -->
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if (session('errors'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, una letra minúscula y un número.',
                        confirmButtonText: 'Ok'
                    });
                </script>
            @endif

            @if (isset($profesor))
            <form action="{{ route('profesores.update', $profesor->id) }}" method="POST"> <!-- UX: Formulario para editar profesor -->
                    @method('PUT')
            @else
                <form action="{{ route('profesores.store') }}" method="POST"> <!-- UX: Formulario para registrar nuevo profesor -->
            @endif
                    @csrf

                    <div class="form-group">
                        <label for="nombre">Nombre</label> <!-- UI: Etiqueta para el campo de nombre -->
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', isset($profesor) ? $profesor->nombre : '') }}" required> <!-- UX: Campo de entrada para nombre -->
                    </div>

                    <div class="form-group">
                        <label for="apellido">Apellido</label> <!-- UI: Etiqueta para el campo de apellido -->
                        <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido', isset($profesor) ? $profesor->apellido : '') }}" required> <!-- UX: Campo de entrada para apellido -->
                    </div>

                    <div class="form-group">
                        <label for="cedula">Cédula</label> <!-- UI: Etiqueta para el campo de cédula -->
                        <input type="text" class="form-control" id="cedula" name="cedula" value="{{ old('cedula', isset($profesor) ? $profesor->cedula : '') }}" required> <!-- UX: Campo de entrada para cédula -->
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico</label> <!-- UI: Etiqueta para el campo de correo electrónico -->
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', isset($profesor) ? $profesor->email : '') }}" required> <!-- UX: Campo de entrada para correo electrónico -->
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label> <!-- UI: Etiqueta para el campo de contraseña -->
                        <input type="password" class="form-control" id="password" name="password" {{ !isset($profesor) ? 'required' : '' }}> <!-- UX: Campo de entrada para contraseña -->
                        @if ($errors->has('password'))
                            <small class="form-text text-danger">La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, una letra minúscula y un número.</small> <!-- UX: Mensaje de error -->
                        @else
                            <small class="form-text text-muted">Mínimo 8 caracteres</small> <!-- UX: Mensaje informativo -->
                        @endif
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
        @if ($errors->has('password'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, una letra minúscula y un número.',
                confirmButtonText: 'Ok'
            });
        @endif
    </script>
@stop