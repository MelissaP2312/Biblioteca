<!-- resources/views/devolucionMaterial.blade.php -->

<h1>Registrar Devolución</h1>

@if (session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

<form action="{{ route('rentas_materiales.devolucion.store') }}" method="post">
    @csrf
    <label for="renta_id">Renta:</label>
    <select name="renta_id" required>
        <option value="">Seleccionar una renta</option>
        @foreach ($rentas as $renta)
            <option value="{{ $renta->id }}">
                {{ $renta->nombre_material }} - {{ $renta->usuario->name }}
            </option>
        @endforeach
    </select>

    <label for="fecha_devolucion">Fecha de Devolución:</label>
    <input type="date" name="fecha_devolucion" required>

    <button type="submit">Registrar</button>
    <button type="button" onclick="window.location.href='{{ route('rentas_materiales.devolucion.index') }}'">Ver devoluciones</button>
</form>
