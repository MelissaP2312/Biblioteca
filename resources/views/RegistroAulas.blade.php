<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilosaulasregistro.css">
    <title>Registro de Aulas</title>
</head>
<body>
    <h1>Registrar Aulas</h1>
    <form id="formAula" action="registrar_aula.php" method="post">
        <div class="form-group">
            <label for="nombre_aula">Nombre del Aula:</label>
            <input type="text" id="nombre_aula" name="nombre_aula" required>
        </div>

        <div class="form-group">
            <label for="capacidad">Capacidad:</label>
            <input type="number" id="capacidad" name="capacidad" min="1" required>
        </div>

        <div class="form-group">
            <label for="ubicacion">Ubicación:</label>
            <input type="text" id="ubicacion" name="ubicacion" required>
        </div>

        <button type="submit">Registrar Aula</button>
        <button type="button" id="vaciar" onclick="vaciarFormulario()">Vaciar Formulario</button>
    </form>
    
    <script src="../js/scriptregistrolibro.js"></script>
</body>
</html>
