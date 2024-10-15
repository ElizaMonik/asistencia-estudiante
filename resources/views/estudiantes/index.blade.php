@extends('adminlte::page')

@section('title', 'Estudiantes') <!-- UI: Título de la página -->

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Estudiantes</h1> <!-- UI: Encabezado de la página -->
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('estudiantes.create') }}" class="btn btn-primary btn-sm" style="font-size: 14px">
                            Nuevo Estudiante <!-- UX: Botón para crear un nuevo estudiante -->
                        </a>
                    </div>
                    <div class="card-body">
                        @if (session('message') && session('type') == 'success')
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <p>{{ session('message') }}</p> <!-- UX: Mensaje de éxito -->
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @php session()->forget(['message', 'type']); @endphp
                        @endif

                        <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th> <!-- UI: Encabezado de la tabla -->
                                    <th>Apellido</th> <!-- UI: Encabezado de la tabla -->
                                    <th>Cédula</th> <!-- UI: Encabezado de la tabla -->
                                    <th>Email</th> <!-- UI: Encabezado de la tabla -->
                                    <th>Teléfono</th> <!-- UI: Encabezado de la tabla -->
                                    <th>Acciones</th> <!-- UI: Encabezado de la tabla -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estudiantes as $estudiante)
                                    <tr>
                                        <td>{{ $estudiante->nombre }}</td> <!-- UI: Datos de la tabla -->
                                        <td>{{ $estudiante->apellido }}</td> <!-- UI: Datos de la tabla -->
                                        <td>{{ $estudiante->cedula }}</td> <!-- UI: Datos de la tabla -->
                                        <td>{{ $estudiante->email }}</td> <!-- UI: Datos de la tabla -->
                                        <td>{{ $estudiante->telefono }}</td> <!-- UI: Datos de la tabla -->
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('estudiantes.edit', $estudiante->id) }}" class="btn btn-warning btn-sm mr-1">
                                                    <i class="fas fa-edit"></i> <!-- UX: Botón para editar estudiante -->
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $estudiante->id }}">
                                                    <i class="fas fa-trash"></i> <!-- UX: Botón para eliminar estudiante -->
                                                </button>
                                                <!-- Modal para confirmar la eliminación -->
                                                <div class="modal fade" id="deleteModal{{ $estudiante->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $estudiante->id }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel{{ $estudiante->id }}">
                                                                    Confirmar Eliminación</h5> <!-- UI: Título del modal -->
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ¿Estás seguro de que deseas eliminar este estudiante? <!-- UX: Mensaje de confirmación -->
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button> <!-- UX: Botón para cancelar -->
                                                                <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Eliminar</button> <!-- UX: Botón para confirmar eliminación -->
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css"> <!-- UI: Estilos personalizados -->
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#dataTable').dataTable(); <!-- UX: Inicialización de la tabla con DataTables -->
        });
    </script>
@stop