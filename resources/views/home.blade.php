@extends('adminlte::page')

@section('title', 'Professional Pet Care')

@section('content')

    <div class="container">
        <div class="row align-items-center hero-section">
            <!-- Sección de texto (izquierda) -->
            <div class="col-md-6 text-section">
                <h2 class="text-title text-center" >BIENVENIDO A LA <span class="highlight">ACADEMIA WE MARKETS</span></h2>
                <p class="text-description" >
                    En la era digital, la robótica se ha convertido en una herramienta
                    invaluable para educar a los niños en habilidades STEM (Ciencia, 
                    Tecnología, Ingeniería y Matemáticas). Dos enfoques principales 
                    compiten por la atención de padres y educadores: el uso de kits 
                    de robótica prefabricados y la creación de proyectos DIY 
                    (Hazlo Tú Mismo).
                </p>
                <!-- Sección de íconos de redes sociales -->
                <BR>
                </BR>
                <div class="mt-4 social-icons">
                    <a href="https://www.linkedin.com/in/nataliagomez" class=" mx-2" title="LinkedIn">
                        <i class="fab fa-linkedin fa-2x"></i>
                    </a>
                    <a href="https://www.facebook.com/WeMakersEcuador" class=" mx-2" title="Facebook">
                        <i class="fab fa-facebook fa-2x"></i>
                    </a>
                    <a href="https://twitter.com/nataliagomez" class=" mx-2" title="Twitter">
                        <i class="fab fa-twitter fa-2x"></i>
                    </a>
                    <a href="https://www.instagram.com/wemakersecuador/" class=" mx-2" title="Instagram">
                        <i class="fab fa-instagram fa-2x"></i>
                    </a>
                </div>
            </div>
            
            <!-- Sección de imágenes (derecha) -->
            <div class="col-md-6 d-flex flex-column align-items-center image-section">
                <!-- Primera imagen (grande) -->
                <div class="circle large-circle mb-3" style="position: relative; left: 100px;"> <!-- Ajusta la posición aquí -->
                    <img src="{{ asset('image/image1.jpg') }}" alt="Large Pet Image" class="circle-img">
                </div>
                <!-- Segunda imagen (pequeña) -->
                <div class="circle small-circle" style="left: 20px;"> <!-- Ajusta la posición aquí -->
                    <img src="{{ asset('image/image2.png') }}" alt="Small Pet Image" class="circle-img">
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        body {
            background-color: #00cffe;
            font-family: Arial, sans-serif;
        }

        .hero-section {
            padding: 50px 0;
        }

        /* Sección de texto */
        .text-section {
            text-align: left;
        }
        .text-title {
            font-size: 48px;
            font-weight: bold;
            color: #9cb1e2;
        }
        .highlight {
            color: #1407c6;
        }
        .text-description {
            color: #080707b3;
            font-size: 18px;
            margin-top: 20px;
            text-align: justify; /* Justifica el texto del párrafo */
        }

        /* Íconos de redes sociales */
        .social-icons a {
            color: #007bff; /* Cambiar color a azul */
            transition: color 0.3s ease;
        }
        .social-icons a:hover {
            color: #1500ff; /* Color al hacer hover en los íconos */
        }

        /* Sección de imágenes */
        .image-section {
            position: relative;
            text-align: center;
        }
        /* Círculo que contiene las imágenes */
        .circle {
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;  /* Crea la forma circular */
            background-color: white; /* Fondo blanco del círculo */
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); /* Sombra suave para darle profundidad */
            overflow: hidden; /* Asegura que las imágenes no se salgan del círculo */
        }
        /* Círculo más grande */
        .large-circle {
            width: 320px;  /* Define el ancho del círculo */
            height: 320px; /* Define la altura del círculo */
            top: -300%; /* Ajusta la posición vertical para pegarla a la imagen grande */
            left: 20px; /* Ajusta el valor para mover la imagen pequeña más a la derecha */
        }
        /* Círculo más pequeño */
        .small-circle {
            width: 200px;  /* Define el ancho del círculo */
            height: 200px; /* Define la altura del círculo */
            position: absolute;
            top: 140px; /* Ajusta la posición vertical para pegarla a la imagen grande */
            left: -50px; /* Ajusta el valor para mover la imagen pequeña más a la derecha */
        }
        /* Estilo de las imágenes dentro de los círculos */
        .circle-img {
            width: 100%;  /* Hace que la imagen ocupe el 100% del círculo */
            height: 100%; /* Hace que la imagen ocupe el 100% del círculo */
            object-fit: cover; /* Hace que la imagen se ajuste dentro del círculo sin deformarse */
        }
    </style>
@stop

@section('js')
    <script> console.log("Pet Care Home Page Loaded!"); </script>
@stop
