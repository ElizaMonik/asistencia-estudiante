@extends('adminlte::page')

@section('title', isset($profesor) ? 'Editar Profesor' : 'Nuevo Profesor')

@section('content_header')
    <h1>{{ isset($profesor) ? 'Editar Profesor' : 'Nuevo Profesor' }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @if (isset($profesor))
                <form action="{{ route('profesores.update', ['profesor' => $profesor->id]) }}" method="POST">
                    @method('PUT')
            @else
                <form action="{{ route('profesores.store') }}" method="POST">
            @endif
                    @csrf

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', isset($profesor) ? $profesor->nombre : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido', isset($profesor) ? $profesor->apellido : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="cedula">Cédula</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" value="{{ old('cedula', isset($profesor) ? $profesor->cedula : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', isset($profesor) ? $profesor->email : '') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" {{ !isset($profesor) ? 'required' : '' }}>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
