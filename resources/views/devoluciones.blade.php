<!-- resources/views/devoluciones.blade.php -->
<h1>Registrar Devolución</h1>

@if (session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

<form id="formDevolucion" action="{{ route('rentas_libros.devolucion.store') }}" method="post">
    @csrf
    <label for="renta_id">Renta:</label>
    <select name="renta_id" id="renta_id" required>
        <option value="">Seleccionar una renta</option>
        @foreach ($rentas as $renta)
            <option value="{{ $renta->id }}">
                {{ $renta->nombre_libro }} - {{ $renta->usuario->name }}
            </option>
        @endforeach
    </select>

    <label for="fecha_devolucion">Fecha de Devolución:</label>
    <input type="date" name="fecha_devolucion" id="fecha_devolucion" required>

    <button type="submit">Registrar</button>
    <button type="button" onclick="window.location.href='{{ route('rentas_libros.devolucion.index') }}'">Ver devoluciones</button>

    <!-- Almacenamiento offline -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Verificar si el usuario está offline
            if (!navigator.onLine) {
                // Verifica si ya tenemos datos guardados en localStorage
                const savedData = localStorage.getItem('formDevolucion');
                if (savedData) {
                    const formData = JSON.parse(savedData);
                    // Rellena el formulario con los datos guardados
                    document.getElementById('renta_id').value = formData.renta_id || '';
                    document.getElementById('fecha_devolucion').value = formData.fecha_devolucion || '';
                }
            }

            // Guardar los datos en localStorage cuando el formulario cambia
            document.getElementById('formDevolucion').addEventListener('input', function() {
                if (!navigator.onLine) {
                    const formData = {
                        renta_id: document.getElementById('renta_id').value,
                        fecha_devolucion: document.getElementById('fecha_devolucion').value,
                    };
                    localStorage.setItem('formDevolucion', JSON.stringify(formData));
                }
            });
        });
    </script>
    <script>
    // Guardar un valor en localStorage
    localStorage.setItem("testKey", "testValue");

    // Verifica si el valor fue almacenado correctamente
    const storedValue = localStorage.getItem("testKey");
    if (storedValue === "testValue") {
        console.log("LocalStorage funciona correctamente.");
    } else {
        console.log("Error: LocalStorage no está funcionando.");
    }
</script>


</form>
