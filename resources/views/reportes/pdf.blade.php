<!DOCTYPE html>
<html>
<head>
    <title>Reportes de Estudiantes</title> <!-- UI: Título de la página -->
    <style>
        table {
            width: 100%; /* UI: Ancho completo de la tabla */
            border-collapse: collapse; /* UI: Colapsar bordes de la tabla */
        }
        th, td {
            border: 1px solid black; /* UI: Bordes de las celdas */
            padding: 8px; /* UI: Espaciado interno de las celdas */
            text-align: left; /* UI: Alineación del texto a la izquierda */
        }
        th {
            background-color: #f2f2f2; /* UI: Color de fondo de los encabezados */
        }
    </style>
</head>
<body>
    <h1>Reportes de Estudiantes</h1> <!-- UI: Encabezado de la página -->
    <table>
        <thead>
            <tr>
                <th>Clase</th> <!-- UI: Encabezado de la tabla -->
                <th>Estudiante</th> <!-- UI: Encabezado de la tabla -->
                <th>Estado</th> <!-- UI: Encabezado de la tabla -->
                <th>Fecha</th> <!-- UI: Encabezado de la tabla -->
            </tr>
        </thead>
        <tbody>
            @foreach ($reportes as $reporte)
                <tr>
                    <td>{{ $reporte->clase ? $reporte->clase->nombre : 'Sin clase' }}</td> <!-- UI: Datos de la tabla -->
                    <td>{{ $reporte->estudiante ? $reporte->estudiante->nombre : 'Sin estudiante' }}</td> <!-- UI: Datos de la tabla -->
                    <td>{{ $reporte->estado }}</td> <!-- UI: Datos de la tabla -->
                    <td>{{ $reporte->fecha }}</td> <!-- UI: Datos de la tabla -->
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>