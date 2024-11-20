<!-- resources/views/listaDevoluciones.blade.php -->
<h1>Lista de Devoluciones</h1>

@if (session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif

<table>
    <thead>
        <tr>
            <th>Nombre del Libro</th>
            <th>Usuario</th>
            <th>Fecha de Préstamo</th>
            <th>Fecha de Devolución</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($devoluciones as $devolucion)
            <tr>
                <td>{{ $devolucion->nombre_libro }}</td>
                <td>{{ $devolucion->usuario->nombre }}</td>
                <td>{{ $devolucion->fecha_prestamo }}</td>
                <td>{{ $devolucion->fecha_devolucion }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
