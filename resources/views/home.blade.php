@extends('adminlte::page')

@section('title', 'Professional Pet Care') <!-- UI: Título de la página -->

@section('content')

    <div class="container">
        <div class="row align-items-center hero-section">
            <!-- Sección de texto (izquierda) -->
            <div class="col-md-6 text-section">
                <h2 class="text-title text-center" >BIENVENIDO A LA <span class="highlight">ACADEMIA WE MARKETS</span></h2> <!-- UI: Título de bienvenida -->
                <p class="text-description" >
                    En la era digital, la robótica se ha convertido en una herramienta
                    invaluable para educar a los niños en habilidades STEM (Ciencia, 
                    Tecnología, Ingeniería y Matemáticas). Dos enfoques principales 
                    compiten por la atención de padres y educadores: el uso de kits 
                    de robótica prefabricados y la creación de proyectos DIY 
                    (Hazlo Tú Mismo).
                </p> <!-- UI: Descripción del contenido -->
                <!-- Sección de íconos de redes sociales -->
                <br>
                </br>
                <div class="mt-4 social-icons">
                    <a href="https://www.linkedin.com/in/nataliagomez" class=" mx-2" title="LinkedIn">
                        <i class="fab fa-linkedin fa-2x"></i> <!-- UX: Ícono de LinkedIn -->
                    </a>
                    <a href="https://www.facebook.com/WeMakersEcuador" class=" mx-2" title="Facebook">
                        <i class="fab fa-facebook fa-2x"></i> <!-- UX: Ícono de Facebook -->
                    </a>
                    <a href="https://twitter.com/nataliagomez" class=" mx-2" title="Twitter">
                        <i class="fab fa-twitter fa-2x"></i> <!-- UX: Ícono de Twitter -->
                    </a>
                    <a href="https://www.instagram.com/wemakersecuador/" class=" mx-2" title="Instagram">
                        <i class="fab fa-instagram fa-2x"></i> <!-- UX: Ícono de Instagram -->
                    </a>
                </div>
            </div>
            
            <!-- Sección de imágenes (derecha) -->
            <div class="col-md-6 d-flex flex-column align-items-center image-section">
                <!-- Primera imagen (grande) -->
                <div class="circle large-circle mb-3" style="position: relative; left: 100px;"> <!-- UI: Contenedor de la imagen grande -->
                    <img src="{{ asset('image/image1.jpg') }}" alt="Large Pet Image" class="circle-img"> <!-- UI: Imagen grande -->
                </div>
                <!-- Segunda imagen (pequeña) -->
                <div class="circle small-circle" style="left: 20px;"> <!-- UI: Contenedor de la imagen pequeña -->
                    <img src="{{ asset('image/image2.png') }}" alt="Small Pet Image" class="circle-img"> <!-- UI: Imagen pequeña -->
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        body {
            background-color: #00cffe; /* UI: Color de fondo */
            font-family: Arial, sans-serif; /* UI: Fuente */
        }

        .hero-section {
            padding: 50px 0; /* UI: Espaciado de la sección */
        }

        /* Sección de texto */
        .text-section {
            text-align: left; /* UI: Alineación del texto */
        }
        .text-title {
            font-size: 48px; /* UI: Tamaño del título */
            font-weight: bold; /* UI: Peso del título */
            color: #9cb1e2; /* UI: Color del título */
        }
        .highlight {
            color: #1407c6; /* UI: Color del texto resaltado */
        }
        .text-description {
            color: #080707b3; /* UI: Color del texto */
            font-size: 18px; /* UI: Tamaño del texto */
            margin-top: 20px; /* UI: Margen superior */
            text-align: justify; /* UI: Justificación del texto */
        }

        /* Íconos de redes sociales */
        .social-icons a {
            color: #007bff; /* UI: Color de los íconos */
            transition: color 0.3s ease; /* UX: Transición de color */
        }
        .social-icons a:hover {
            color: #1500ff; /* UI: Color al hacer hover en los íconos */
        }

        /* Sección de imágenes */
        .image-section {
            position: relative; /* UI: Posicionamiento relativo */
            text-align: center; /* UI: Alineación del texto */
        }
        /* Círculo que contiene las imágenes */
        .circle {
            display: flex; /* UI: Flexbox */
            justify-content: center; /* UI: Justificación centrada */
            align-items: center; /* UI: Alineación centrada */
            border-radius: 50%;  /* UI: Forma circular */
            background-color: white; /* UI: Fondo blanco */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); /* UI: Sombra */
            overflow: hidden; /* UI: Ocultar desbordamiento */
        }
        /* Círculo más grande */
        .large-circle {
            width: 320px;  /* UI: Ancho del círculo */
            height: 320px; /* UI: Altura del círculo */
            top: -300%; /* UI: Posición vertical */
            left: 20px; /* UI: Posición horizontal */
        }
        /* Círculo más pequeño */
        .small-circle {
            width: 200px;  /* UI: Ancho del círculo */
            height: 200px; /* UI: Altura del círculo */
            position: absolute; /* UI: Posicionamiento absoluto */
            top: 140px; /* UI: Posición vertical */
            left: -50px; /* UI: Posición horizontal */
        }
        /* Estilo de las imágenes dentro de los círculos */
        .circle-img {
            width: 100%;  /* UI: Ancho de la imagen */
            height: 100%; /* UI: Altura de la imagen */
            object-fit: cover; /* UI: Ajuste de la imagen */
        }
    </style>
@stop

@section('js')
    <script> console.log("Pet Care Home Page Loaded!"); </script> <!-- UX: Mensaje de consola -->
@stop