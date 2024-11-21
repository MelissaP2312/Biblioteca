<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Materiales Didácticos</title>
    <link rel="stylesheet" href="{{ asset('css/estilosmaterialregistro.css') }}">
</head>
<body>
    <h1>Registrar Material Didáctico</h1>
    <div class="form-container">
        <form id="formMaterial" action="{{ route('material.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="tipo">Tipo de Material:</label>
            <select id="tipo" name="tipo" required>
                <option value="">Seleccione un tipo de material</option>
                <option value="Proyectores">Proyectores</option>
                <option value="Extensiones">Extensiones</option>
                <option value="Marcadores">Marcadores</option>
                <option value="Equipos">Equipos</option>
                <option value="Manuales">Manuales</option>
            </select>

            <label for="unidades">Unidades:</label>
            <input type="number" id="unidades" name="unidades" min="1" placeholder="Cantidad" required>

            <div class="button-container">
                <button type="submit">Añadir Material</button>
                <button type="button" onclick="vaciarFormulario()">Vaciar Formulario</button>
            </div>
        </form>
    </div>

    <div class="button-container">
        <a href="{{ url('/admin/registro') }}" class="btn-regresar">Regresar al Admin</a>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Verificar si el usuario está offline
            if (!navigator.onLine) {
                const savedData = localStorage.getItem('formMaterial');
                if (savedData) {
                    const formData = JSON.parse(savedData);
                    document.getElementById('tipo').value = formData.tipo || '';
                    document.getElementById('unidades').value = formData.unidades || '';
                }
            }

            // Guardar los datos en localStorage cuando el formulario cambia
            document.getElementById('formMaterial').addEventListener('input', function() {
                if (!navigator.onLine) {
                    const formData = {
                        tipo: document.getElementById('tipo').value,
                        unidades: document.getElementById('unidades').value,
                    };
                    localStorage.setItem('formMaterial', JSON.stringify(formData));
                }
            });
        });

        // Vaciar el formulario y eliminar datos de localStorage
        function vaciarFormulario() {
            localStorage.removeItem('formMaterial');
            document.getElementById('tipo').value = '';
            document.getElementById('unidades').value = '';
        }
    </script>
</body>
</html>
