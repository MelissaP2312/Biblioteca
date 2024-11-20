<!-- resources/views/rentasAulas.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Rentas de Aulas</title>
</head>
<body>
    <h1>Lista de Rentas de Aulas</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Nombre del Aula</th>
                <th>Usuario</th>
                <th>Fecha de Préstamo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentas as $renta)
                <tr>
                    <td>{{ $renta->nombre_aula }}</td>
                    <td>{{ $renta->usuario->nombre }}</td> <!-- Asumiendo que el modelo User tiene un atributo 'name' -->
                    <td>{{ $renta->fecha_prestamo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
