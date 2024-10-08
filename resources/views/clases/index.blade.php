@extends('adminlte::page')

@section('title', 'Clases')

@section('content_header')
<div class="d-flex justify-content-between">
    <h1>Clases</h1>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('clases.create') }}" class="btn btn-primary btn-sm" style="font-size: 14px">
                        Nueva Clase
                    </a>
                </div>
                <div class="card-body">
                    @if (session(key: 'message') && session(key: 'type') == 'success')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <p>{{ session(key: 'message') }}</p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @php session()->forget(['message', 'type']); @endphp
                    @endif
                    <table id="dataTable" class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha - Hora</th>
                                <th>Curso</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clases as $clase)
                                <tr>
                                    <td>{{ $clase->nombre }}</td> //agregar nombre clase
                                    <td>{{ $clase->fecha_hora }}</td>
                                    <td>{{ $clase->curso->nombre }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('clases.edit', $clase->id) }}"
                                                class="btn btn-warning btn-sm mr-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deleteModal{{ $clase->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <!-- Modal para confirmar la eliminación -->
                                            <div class="modal fade" id="deleteModal{{ $clase->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="deleteModalLabel{{ $clase->id  }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel{{ $clase->id }}">
                                                                Confirmar Eliminación</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>¿Estás seguro de eliminar la clase {{ $clase->nombre }}?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancelar</button>
                                                            <form action="{{ route('clases.destroy', $clase->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Eliminar</button>
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
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    $(document).ready(function () {
        $('#dataTable').dataTable();
    });
</script>
@stop