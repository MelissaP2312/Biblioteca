<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estilosaulasregistro.css') }}">
    <title>Registro de Aulas</title>
    <style>
       
    </style>
</head>
<body>
    <h1>Registrar Aulas</h1>

    <div class="form-container">
        <form action="{{ route('aula.create') }}" method="POST">
            @csrf <!-- Token de seguridad obligatorio -->
            <label for="nombre_aula">Nombre del Aula:</label>
            <input type="text" name="nombre_aula" id="nombre_aula" required>

            <label for="capacidad">Capacidad:</label>
            <input type="number" name="capacidad" id="capacidad" min="1" required>

            <label for="ubicacion">Ubicación:</label>
            <input type="text" name="ubicacion" id="ubicacion" required>

            <label for="disponible">Disponible:</label>
            <input type="checkbox" name="disponible" id="disponible" checked disabled>

            <div class="button-container">
                <button type="submit">Registrar Aula</button>
                <button type="button" onclick="vaciarFormulario()">Vaciar Formulario</button>
            </div>
        </form>
    </div>

    <div class="button-container">
        <a href="{{ url('/admin/registro') }}" class="btn-regresar">Regresar al Admin</a>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Verifica si el usuario está offline
            if (!navigator.onLine) {
                const savedData = localStorage.getItem('formAula');
                if (savedData) {
                    const formData = JSON.parse(savedData);
                    document.getElementById('nombre_aula').value = formData.nombre_aula || '';
                    document.getElementById('capacidad').value = formData.capacidad || '';
                    document.getElementById('ubicacion').value = formData.ubicacion || '';
                }
            }

            // Guarda los datos en localStorage cuando el formulario cambia
            document.querySelector('form').addEventListener('input', function() {
                if (!navigator.onLine) {
                    const formData = {
                        nombre_aula: document.getElementById('nombre_aula').value,
                        capacidad: document.getElementById('capacidad').value,
                        ubicacion: document.getElementById('ubicacion').value,
                    };
                    localStorage.setItem('formAula', JSON.stringify(formData));
                }
            });
        });

        // Vaciar el formulario y eliminar datos de localStorage
        function vaciarFormulario() {
            localStorage.removeItem('formAula');
            document.getElementById('nombre_aula').value = '';
            document.getElementById('capacidad').value = '';
            document.getElementById('ubicacion').value = '';
        }
    </script>
</body>
</html>