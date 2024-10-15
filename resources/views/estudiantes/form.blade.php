@extends('adminlte::page')

@section('title', isset($estudiante) ? 'Editar Estudiante' : 'Nuevo Estudiante')

@section('content_header')
    <h1>{{ isset($estudiante) ? 'Editar Estudiante' : 'Nuevo Estudiante' }}</h1>
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
                <form action="{{ route('estudiantes.update', ['estudiante' => $estudiante->id]) }}" method="POST">
                    @method('PUT')
            @else
                <form action="{{ route('estudiantes.store') }}" method="POST">
            @endif
                    @csrf

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', isset($estudiante) ? $estudiante->nombre : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido', isset($estudiante) ? $estudiante->apellido : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="cedula">Cédula</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" value="{{ old('cedula', isset($estudiante) ? $estudiante->cedula : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', isset($estudiante) ? $estudiante->email : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', isset($estudiante) ? $estudiante->telefono : '') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
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
