<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estiloslibrosregistro.css') }}">
    <title>Renta de Aulas</title>
</head>
<body>
    <h1>Rentar un Aula</h1>

    <!-- Mostrar mensajes de error o éxito -->
    @if (session('error'))
        <div class="alert alert-error" style="color: red;">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success" style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <div class="form-container">
        <form id="formLibro" action="{{ route('rentas_aulas.store') }}" method="post">
            @csrf
            <label for="nombre_aula">Nombre del Aula:</label>
            <select id="nombre_aula" name="nombre_aula" required>
                <option value="">Seleccionar un aula</option>
                @foreach ($aulas as $aula)
                    <option value="{{ $aula->nombre_aula }}">{{ $aula->nombre_aula }}</option>
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

            <label for="hora_inicio">Hora de inicio:</label>
            <input type="time" id="hora_inicio" name="hora_inicio" required value="{{ old('hora_inicio') }}">

            <label for="hora_fin">Hora de fin:</label>
            <input type="time" id="hora_fin" name="hora_fin" required value="{{ old('hora_fin') }}">

            <div class="button-container">
                <button type="submit" id="saveButton">Guardar</button>
                <button type="button" onclick="clearForm()">Limpiar</button>
                <button type="button"  onclick="window.location.href='{{ route('rentasAula.index') }}'">Ver registros de Rentas</button>
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
                const savedData = localStorage.getItem('rentaAulaForm');
                if (savedData) {
                    const formData = JSON.parse(savedData);
                    // Rellena el formulario con los datos guardados
                    document.getElementById('nombre_aula').value = formData.nombre_aula || '';
                    document.getElementById('usuario_id').value = formData.usuario_id || '';
                    document.getElementById('fecha_prestamo').value = formData.fecha_prestamo || '';
                    document.getElementById('hora_inicio').value = formData.hora_inicio || '';
                    document.getElementById('hora_fin').value = formData.hora_fin || '';
                }
            }

            // Guardar los datos en localStorage cuando el formulario cambia
            document.getElementById('formAula').addEventListener('input', function() {
                if (!navigator.onLine) {
                    const formData = {
                        nombre_aula: document.getElementById('nombre_aula').value,
                        usuario_id: document.getElementById('usuario_id').value,
                        fecha_prestamo: document.getElementById('fecha_prestamo').value,
                        hora_inicio: document.getElementById('hora_inicio').value,
                        hora_fin: document.getElementById('hora_fin').value,
                    };
                    localStorage.setItem('rentaAulaForm', JSON.stringify(formData));
                }
            });
        });

        // Función para vaciar el formulario y eliminar los datos guardados en localStorage
        function clearForm() {
            localStorage.removeItem('rentaAulaForm');
            document.getElementById('formAula').reset();
        }
    </script>

    <script src="{{ asset('js/scriptrentas.js') }}"></script>
    <script src="{{ asset('js/GuardadoyLimpiar.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
