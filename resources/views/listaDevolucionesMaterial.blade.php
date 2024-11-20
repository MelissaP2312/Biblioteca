<!-- resources/views/listaDevoluciones.blade.php -->
<h1>Lista de Devoluciones de Materiales</h1>

@if (session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>Nombre del Material</th>
            <th>Usuario</th>
            <th>Fecha de Préstamo</th>
            <th>Fecha de Devolución</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($devoluciones as $devolucion)
            <tr>
                <td>{{ $devolucion->nombre_material }}</td>
                <td>{{ $devolucion->usuario->nombre }}</td> <!-- Cambié 'nombre' a 'name' porque generalmente se usa en inglés -->
                <td>{{ $devolucion->fecha_prestamo }}</td>
                <td>{{ $devolucion->fecha_devolucion }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
