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

    <script src="{{ asset('js/scriptregistrolibro.js') }}"></script>
    <script src="{{ asset('js/GuardadoyLimpiar.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
