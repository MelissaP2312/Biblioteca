<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renta de Libros</title>
    <link rel="stylesheet" href="{{ asset('css/estiloslibrosregistro.css') }}">
    <style>
        
    </style>
</head>
<body>
    
    <!-- Mensajes de éxito o error -->
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <h1>Renta de Libros</h1>

    <div class="form-container">
        <form id="formLibro" action="{{ route('rentas.store') }}" method="post">
            @csrf
            <label for="nombre_libro">Nombre del Libro:</label>
            <select id="nombre_libro" name="nombre_libro" required>
                <option value="">Seleccionar un libro</option>
                @foreach ($libros as $libro)
                    <option value="{{ $libro->nombre }}">{{ $libro->nombre }}</option>
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

            <div class="button-container centered">
                <button type="submit" id="saveButton">Guardar</button>
                <button type="button" onclick="clearForm()">Limpiar</button>
            </div>
        </form>
    </div>
    <div class="button-container centered">
        <a href="{{ route('main') }}" class="btn-regresar">Regresar</a>
    </div>    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (!navigator.onLine) {
                const savedData = localStorage.getItem("rentaLibroForm");
                if (savedData) {
                    const formData = JSON.parse(savedData);
                    document.getElementById("nombre_libro").value = formData.nombre_libro || "";
                    document.getElementById("usuario_id").value = formData.usuario_id || "";
                    document.getElementById("fecha_prestamo").value = formData.fecha_prestamo || "";
                    document.getElementById("unidades_disponibles").value = formData.unidades_disponibles || "";
                }
            }

            document.getElementById("formLibro").addEventListener("input", function () {
                if (!navigator.onLine) {
                    const formData = {
                        nombre_libro: document.getElementById("nombre_libro").value,
                        usuario_id: document.getElementById("usuario_id").value,
                        fecha_prestamo: document.getElementById("fecha_prestamo").value,
                        unidades_disponibles: document.getElementById("unidades_disponibles").value,
                    };
                    localStorage.setItem("rentaLibroForm", JSON.stringify(formData));
                }
            });
        });

        function clearForm() {
            localStorage.removeItem("rentaLibroForm");
            document.getElementById("formLibro").reset();
        }
    </script>
</body>
</html>
