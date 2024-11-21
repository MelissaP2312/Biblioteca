<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Rentas de Materiales</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
            font-size: 32px;
        }

        /* Estilo de la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        thead {
            background-color: #007bff;
            color: white;
        }

        th, td {
            text-align: left;
            padding: 10px 15px;
            border-bottom: 1px solid #ddd;
        }

        th {
            font-size: 16px;
            text-transform: uppercase;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Botón de regreso */
        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .btn-regresar {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .btn-regresar:hover {
            background-color: #0056b3;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <h1>Lista de Rentas de Materiales</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre del Material</th>
                <th>Usuario</th>
                <th>Fecha de Préstamo</th>
                <th>Unidades Rentadas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rentas as $renta)
                <tr>
                    <td>{{ $renta->nombre_material }}</td>
                    <td>{{ $renta->usuario->nombre }}</td>
                    <td>{{ $renta->fecha_prestamo }}</td>
                    <td>{{ $renta->unidades_disponibles }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="button-container">
        <a href="{{ url('/admin/rentas') }}" class="btn-regresar">Regresar al Admin</a>
    </div>
</body>
</html>
