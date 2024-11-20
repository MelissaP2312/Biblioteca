<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estiloslibrosregistro.css') }}">
    <title>Renta de Materiales</title>
</head>
<body>
    <h1>Rentar un Material</h1>

    <div class="form-container">
        <form id="formMaterial" action="{{ route('rentas_materiales.store') }}" method="post">
            @csrf
            <label for="nombre_material">Nombre del Material:</label>
            <select id="nombre_material" name="nombre_material" required>
                <option value="">Seleccionar un material</option>
                @foreach ($materiales as $material)
                    <option value="{{ $material->tipo }}">{{ $material->tipo }}</option>
                @endforeach
            </select>
            

            <label for="usuario_id">Membresía del Usuario:</label>
            <select id="usuario_id" name="usuario_id" required>
                <option value="">Seleccionar un usuario</option>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                @endforeach
            </select>

            <label for="fecha_prestamo">Fecha de préstamo:</label>
            <input type="date" id="fecha_prestamo" name="fecha_prestamo" required value="{{ old('fecha_prestamo') }}">

            <label for="unidades_disponibles">Unidades Rentadas:</label>
            <input type="number" id="unidades_disponibles" name="unidades_disponibles" min="1" max="5" value="{{ old('unidades_disponibles') }}">

            <div class="button-container">
                <button type="submit" id="saveButton">Guardar</button>
                <button type="button" onclick="clearForm()">Limpiar</button>
                <button type="button"  onclick="window.location.href='{{ route('rentasMaterial.index') }}'">Ver registros de Rentas</button>
            </div>

        </form>
    </div>

    <div class="button-container">
        <a href="{{ url('/admin/rentas') }}" class="btn-regresar">Regresar al Administrador</a>
    </div>

    <script>
        // Función para guardar datos en localStorage
        document.addEventListener("DOMContentLoaded", function() {
            // Verificar si el usuario está offline
            if (!navigator.onLine) {
                // Verifica si ya tenemos datos guardados en localStorage
                const savedData = localStorage.getItem('rentaMaterialForm');
                if (savedData) {
                    const formData = JSON.parse(savedData);
                    // Rellena el formulario con los datos guardados
                    document.getElementById('nombre_material').value = formData.nombre_material || '';
                    document.getElementById('usuario_id').value = formData.usuario_id || '';
                    document.getElementById('fecha_prestamo').value = formData.fecha_prestamo || '';
                    document.getElementById('unidades_disponibles').value = formData.unidades_disponibles || '';
                }
            }

            // Guardar los datos en localStorage cuando el formulario cambia
            document.getElementById('formMaterial').addEventListener('input', function() {
                if (!navigator.onLine) {
                    const formData = {
                        nombre_material: document.getElementById('nombre_material').value,
                        usuario_id: document.getElementById('usuario_id').value,
                        fecha_prestamo: document.getElementById('fecha_prestamo').value,
                        unidades_disponibles: document.getElementById('unidades_disponibles').value,
                    };
                    localStorage.setItem('rentaMaterialForm', JSON.stringify(formData));
                }
            });
        });

        // Función para vaciar el formulario y eliminar los datos guardados en localStorage
        function clearForm() {
            localStorage.removeItem('rentaMaterialForm');
            document.getElementById('formMaterial').reset();
        }
    </script>

    <script src="{{ asset('js/scriptregistrolibro.js') }}"></script>
    <script src="{{ asset('js/GuardadoyLimpiar.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
