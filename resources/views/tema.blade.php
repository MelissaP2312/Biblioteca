<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Tema</title>
</head>
<body>
    <h1>Crear Nuevo Tema</h1>

    <!-- Mostrar mensajes de éxito -->
    @if(session('success'))
        <div style="color: green; font-weight: bold;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Mostrar datos del tema recién creado -->
    @if(session('tema'))
        <div>
            <h2>Datos del Tema Creado:</h2>
            <p><strong>Título:</strong> {{ session('tema')->titulo }}</p>
            <p><strong>Descripción:</strong> {{ session('tema')->descripcion }}</p>
        </div>
    @endif

    <!-- Mostrar errores de validación -->
    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario para crear un nuevo tema -->
    <form action="{{ route('temas.store') }}" method="POST">
        @csrf
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}" required><br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required>{{ old('descripcion') }}</textarea><br>

        <button type="submit">Guardar Tema</button>
    </form>
</body>
</html>
