<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Devolución</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
            font-size: 32px;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #555;
        }

        select, input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        select:focus, input:focus {
            border-color: #80bdff;
            outline: none;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        button, .btn-admin {
            padding: 10px 20px;
            font-size: 14px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            text-align: center;
        }

        button[type="submit"] {
            background-color: #28a745;
        }

        button[type="button"] {
            background-color: #007bff;
        }

        .btn-admin {
            background-color: #6c757d;
        }

        button:hover, .btn-admin:hover {
            opacity: 0.9;
        }

        /* Mensaje de éxito */
        .success-message {
            color: green;
            background-color: #d4edda;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Registrar Devolución</h1>

    @if (session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <div class="form-container">
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

            <div class="button-container">
                <button type="submit">Registrar</button>
                <button type="button" onclick="window.location.href='{{ route('rentas_libros.devolucion.index') }}'">Ver devoluciones</button>
            </div>
        </form>

        <div class="button-container">
            <a href="{{ url('/admin') }}" class="btn-admin">Regresar al Admin</a>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Verificar si el usuario está offline
            if (!navigator.onLine) {
                const savedData = localStorage.getItem('formDevolucion');
                if (savedData) {
                    const formData = JSON.parse(savedData);
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

        // Probar almacenamiento local
        localStorage.setItem("testKey", "testValue");
        const storedValue = localStorage.getItem("testKey");
        if (storedValue === "testValue") {
            console.log("LocalStorage funciona correctamente.");
        } else {
            console.log("Error: LocalStorage no está funcionando.");
        }
    </script>
</body>
</html>
