@extends('adminlte::page')

@section('title', 'Cursos') <!-- UI: Título de la página -->

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Cursos</h1> <!-- UI: Encabezado de la página -->
        <a href="{{ route('cursos.create') }}" class="btn btn-primary btn-sm" style="font-size: 14px">
            Nuevo Curso <!-- UX: Botón para crear un nuevo curso -->
        </a>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            @foreach ($cursos as $curso)
                <div class="col-md-4">
                    <div class="card shadow-sm" style="border-radius: 15px; border: 1px solid #ddd;"> <!-- UI: Tarjeta con borde y sombra -->
                        <!-- Header con código y título alineados -->
                        <div class="card-header text-white" style="background: linear-gradient(45deg, #6a11cb, #2575fc); border-top-left-radius: 15px; border-top-right-radius: 15px; position: relative; height: 120px;"> <!-- UI: Encabezado de la tarjeta con fondo degradado -->
                            <div class="d-flex flex-column align-items-start">
                                <!-- Código del curso -->
                                <h5 class="card-title font-weight-bold" style="margin-bottom: 0;">
                                    {{ $curso->codigo }} <!-- UI: Código del curso -->
                                </h5>
                                <!-- Nombre del curso con espacio adecuado -->
                                <p class="card-subtitle" style="margin-top: 10px;">
                                    {{ $curso->nombre }} <!-- UI: Nombre del curso -->
                                </p>
                            </div>
                            @if($curso->profesor->imagen)
                                <!-- Imagen del profesor -->
                                <div class="profesor-imagen">
                                    <img src="{{ asset('path_to_professor_image/'.$curso->profesor->imagen) }}" class="rounded-circle" alt="Foto del profesor"> <!-- UI: Imagen del profesor -->
                                </div>
                            @else
                                <!-- Imagen por defecto si no hay -->
                                <div class="profesor-imagen">
                                    <img src="{{ asset('path_to_default_image/default_professor.png') }}" class="rounded-circle" alt="Imagen por defecto"> <!-- UI: Imagen por defecto -->
                                </div>
                            @endif
                        </div>

                        <!-- Contenido de la tarjeta -->
                        <div class="card-body text-center" style="padding: 30px;"> <!-- UI: Contenido de la tarjeta con más espacio blanco -->
                            <!-- Nombre del docente -->
                            <p class="text-muted" style="margin-top: 10px;">{{ $curso->profesor->nombre }} {{ $curso->profesor->apellido }}</p> <!-- UI: Nombre del profesor -->
                        </div>

                        <!-- Pie de la tarjeta -->
                        <div class="card-footer text-right" style="background-color: #f8f9fa;">
                            <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> <!-- UX: Botón para editar curso -->
                            </a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $curso->id }}">
                                <i class="fas fa-trash"></i> <!-- UX: Botón para eliminar curso -->
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#uploadPhotoModal{{ $curso->id }}">
                                <i class="fas fa-camera"></i> <!-- UX: Botón para subir foto del profesor -->
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal para confirmar la eliminación -->
                <div class="modal fade" id="deleteModal{{ $curso->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $curso->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $curso->id }}">Confirmar Eliminación</h5> <!-- UI: Título del modal -->
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro de que deseas eliminar este curso? <!-- UX: Mensaje de confirmación -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button> <!-- UX: Botón para cancelar -->
                                <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button> <!-- UX: Botón para confirmar eliminación -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal para subir la foto del profesor -->
                <div class="modal fade" id="uploadPhotoModal{{ $curso->id }}" tabindex="-1" role="dialog" aria-labelledby="uploadPhotoModalLabel{{ $curso->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="uploadPhotoModalLabel{{ $curso->id }}">Subir Foto del Profesor</h5> <!-- UI: Título del modal -->
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('cursos.upload_photo', $curso->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="photo">Seleccione una imagen:</label> <!-- UI: Etiqueta para el campo de selección de imagen -->
                                        <input type="file" class="form-control" name="photo" accept="image/*" required> <!-- UX: Campo de selección de imagen -->
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button> <!-- UX: Botón para cancelar -->
                                    <button type="submit" class="btn btn-primary">Subir</button> <!-- UX: Botón para subir imagen -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop

@section('css')
    <style>
        .card {
            margin-bottom: 20px;
            border: 1px solid #ddd; /* UI: Bordes visibles */
        }

        .card-header {
            padding: 10px;
            font-size: 1.2em;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative; /* UI: Para posicionar la imagen */
            height: 120px; /* UI: Tamaño más pequeño para el fondo morado/celeste */
        }

        .card-subtitle {
            margin-top: 10px; /* UI: Espacio debajo del código del curso */
        }

        .profesor-imagen {
            position: absolute;
            top: 50%;
            right: 10px; /* UI: Imagen en el borde derecho */
            transform: translateY(-50%);
        }

        .profesor-imagen img {
            width: 80px;
            height: 80px;
            border: 3px solid #fff; /* UI: Bordes de la imagen */
        }

        .card-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #ddd; /* UI: Línea en el pie de la tarjeta */
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#dataTable').dataTable(); <!-- UX: Inicialización de la tabla con DataTables -->
        });
    </script>
@stop