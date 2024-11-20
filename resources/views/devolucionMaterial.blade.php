<!-- resources/views/devolucionMaterial.blade.php -->

<h1>Registrar Devolución</h1>

@if (session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

<form id="formDevolucionMaterial" action="{{ route('rentas_materiales.devolucion.store') }}" method="post">
    @csrf
    <label for="renta_id">Renta:</label>
    <select name="renta_id" id="renta_id" required>
        <option value="">Seleccionar una renta</option>
        @foreach ($rentas as $renta)
            <option value="{{ $renta->id }}">
                {{ $renta->nombre_material }} - {{ $renta->usuario->name }}
            </option>
        @endforeach
    </select>

    <label for="fecha_devolucion">Fecha de Devolución:</label>
    <input type="date" name="fecha_devolucion" id="fecha_devolucion" required>

    <button type="submit">Registrar</button>
    <button type="button" onclick="window.location.href='{{ route('rentas_materiales.devolucion.index') }}'">Ver devoluciones</button>

    <!-- Almacenamiento offline -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Verifica si el usuario está offline
            if (!navigator.onLine) {
                // Verifica si ya tenemos datos guardados en localStorage
                const savedData = localStorage.getItem('formDevolucionMaterial');
                if (savedData) {
                    const formData = JSON.parse(savedData);
                    // Rellenar el formulario con los datos guardados
                    document.getElementById('renta_id').value = formData.renta_id || '';
                    document.getElementById('fecha_devolucion').value = formData.fecha_devolucion || '';
                }
            }

            // Guarda los datos en localStorage cuando el formulario cambia
            document.getElementById('formDevolucionMaterial').addEventListener('input', function() {
                if (!navigator.onLine) {
                    const formData = {
                        renta_id: document.getElementById('renta_id').value,
                        fecha_devolucion: document.getElementById('fecha_devolucion').value,
                    };
                    localStorage.setItem('formDevolucionMaterial', JSON.stringify(formData));
                }
            });
        });
    </script>
</form>
