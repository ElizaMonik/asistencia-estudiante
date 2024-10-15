@extends('adminlte::page')

@section('title', 'Clases') <!-- UI: Título de la página -->

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Clases</h1> <!-- UI: Encabezado de la página -->
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('clases.create') }}" class="btn btn-primary btn-sm" style="font-size: 14px">
                            Nueva Clase <!-- UX: Botón para crear una nueva clase -->
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
                                    <th>Fecha y Hora</th> <!-- UI: Encabezado de la tabla -->
                                    <th>Curso</th> <!-- UI: Encabezado de la tabla -->
                                    <th>Acciones</th> <!-- UI: Encabezado de la tabla -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clases as $clase)
                                    <tr>
                                        <td>{{ $clase->fecha_hora }}</td> <!-- UI: Datos de la tabla -->
                                        <td>{{ $clase->curso->nombre }}</td> <!-- UI: Datos de la tabla -->
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('clases.edit', $clase->id) }}" class="btn btn-warning btn-sm mr-1">
                                                    <i class="fas fa-edit"></i> <!-- UX: Botón para editar clase -->
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $clase->id }}">
                                                    <i class="fas fa-trash"></i> <!-- UX: Botón para eliminar clase -->
                                                </button>
                                                <!-- Modal para confirmar la eliminación -->
                                                <div class="modal fade" id="deleteModal{{ $clase->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $clase->id }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="deleteModalLabel{{ $clase->id }}">Confirmar Eliminación</h5> <!-- UI: Título del modal -->
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ¿Estás seguro de que deseas eliminar esta clase? <!-- UX: Mensaje de confirmación -->
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button> <!-- UX: Botón para cancelar -->
                                                                <form action="{{ route('clases.destroy', $clase->id) }}" method="POST">
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