<!-- resources/views/devoluciones.blade.php -->
<h1>Registrar Devolución</h1>

@if (session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

<form action="{{ route('rentas_libros.devolucion.store') }}" method="post">
    @csrf
    <label for="renta_id">Renta:</label>
    <select name="renta_id" required>
        <option value="">Seleccionar una renta</option>
        @foreach ($rentas as $renta)
            <option value="{{ $renta->id }}">
                {{ $renta->nombre_libro }} - {{ $renta->usuario->name }}
            </option>
        @endforeach
    </select>

    <label for="fecha_devolucion">Fecha de Devolución:</label>
    <input type="date" name="fecha_devolucion" required>

    <button type="submit">Registrar</button>
    <button type="submit" onclick="window.location.href='{{ route('rentas_libros.devolucion.index') }}'">Ver devoluciones</button>
</form>
