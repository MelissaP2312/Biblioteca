<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estilosaulasregistro.css') }}">
    <title>Registro de Aulas</title>
</head>
<body>
    <h1>Registrar Aulas</h1>
    <form action="{{ route('aula.create') }}" method="POST">
        @csrf <!-- Token de seguridad obligatorio -->
        <div>
            <label for="nombre_aula">Nombre del Aula:</label>
            <input type="text" name="nombre_aula" id="nombre_aula" required>
        </div>
        <div>
            <label for="capacidad">Capacidad:</label>
            <input type="number" name="capacidad" id="capacidad" min="1" required>
        </div>
        <div>
            <label for="ubicacion">Ubicación:</label>
            <input type="text" name="ubicacion" id="ubicacion" required>
        </div>
        <div>
            <label for="disponible">Disponible:</label>
            <input type="checkbox" name="disponible" id="disponible" checked disabled> <!-- Deshabilitado porque siempre será 'disponible' -->
        </div>
        <button type="submit">Registrar Aula</button>

        <button type="button" id="vaciar" onclick="vaciarFormulario()">Vaciar Formulario</button>
    </form>
    
    <script src="{{ asset('js/scriptregistrolibro.js') }}"></script>
    <script src="{{ asset('js/GuardadoyLimpiar.js') }}"></script>
</body>
</html>
