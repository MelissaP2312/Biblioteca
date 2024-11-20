<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estilosmaterialregistro.css') }}">
    <title>Registro de Materiales Didácticos</title>
</head>
<body>
    <h1>Registrar Material Didáctico</h1>
    <form id="formMaterial" action="{{ route('material.store') }}" method="post" enctype="multipart/form-data">
        @csrf        
        <div class="form-group">
            <label for="tipo">Tipo de Material:</label>
            <select id="tipo" name="tipo" required>
                <option value="">Seleccione un tipo de material</option>
                <option value="Proyectores">Proyectores</option>
                <option value="Extensiones">Extensiones</option>
                <option value="Marcadores">Marcadores</option>
                <option value="Equipos">Equipos</option>
                <option value="Manuales">Manuales</option>
            </select>
        </div>
    
        <div class="form-group">
            <label for="unidades">Unidades:</label>
            <input type="number" id="unidades" name="unidades" min="1" placeholder="Cantidad" required>
        </div>
    
        <button type="submit">Añadir Material</button>
        <button type="button" id="vaciar" onclick="vaciarFormulario()">Vaciar Formulario</button>
    </form>

    <script>
        // Función para guardar datos en localStorage
        document.addEventListener("DOMContentLoaded", function() {
            // Verificar si el usuario está offline
            if (!navigator.onLine) {
                // Verifica si ya tenemos datos guardados en localStorage
                const savedData = localStorage.getItem('formMaterial');
                if (savedData) {
                    const formData = JSON.parse(savedData);
                    // Rellena el formulario con los datos guardados
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

        // Función para vaciar el formulario y eliminar los datos guardados en localStorage
        function vaciarFormulario() {
            localStorage.removeItem('formMaterial');
            document.getElementById('tipo').value = '';
            document.getElementById('unidades').value = '';
        }
    </script>

    
    <script src="../js/scriptregistromaterial.js"></script>

</body>
</html>
