<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estiloslibrosregistro.css') }}">
    <title>Renta de Libros</title>
</head>
<body>
    <h1>Rentar un Aula</h1>

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

            <label for="unidades_disponibles">Unidades disponibles:</label>
            <input type="number" id="unidades_disponibles" name="unidades_disponibles" required value="{{ old('unidades_disponibles') }}">


            <div class="button-container">
                <button type="submit" id="saveButton">Guardar</button>
                <button type="button" onclick="clearForm()">Limpiar</button>
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
