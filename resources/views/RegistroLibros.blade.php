<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Libros</title>
    <link rel="stylesheet" href="{{ asset('css/estiloslibrosregistro.css') }}">
    <style>
        /* General styles */
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
            max-width: 800px;
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

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        input:focus, select:focus, textarea:focus {
            border-color: #80bdff;
            outline: none;
        }

        textarea {
            resize: vertical;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }

        button, .btn-regresar {
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

        button[type="button"], .btn-regresar {
            background-color: #28a745;
        }

        button:hover, .btn-regresar:hover {
            opacity: 0.9;
        }

        button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .btn-regresar {
            text-align: center;
            font-weight: bold;
        }

        .btn-regresar:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            .button-container {
                flex-direction: column;
                align-items: stretch;
            }

            button, .btn-regresar {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <h1>Registrar un Libro</h1>

    <div class="form-container">
        <form id="formLibro" action="{{ route('libros.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="nombre">Nombre del Libro:</label>
            <input type="text" id="nombre" name="nombre" required value="{{ old('nombre') }}">

            <label for="autor">Autor:</label>
            <input type="text" id="autor" name="autor" required value="{{ old('autor') }}">

            <label for="imagen">Imagen del Libro:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*">

            <label for="genero">Género:</label>
            <input type="text" id="genero" name="genero" required value="{{ old('genero') }}">

            <label for="descripcion">Descripción del Libro:</label>
            <textarea id="descripcion" name="descripcion" rows="4" placeholder="Escribe una breve descripción del libro">{{ old('descripcion') }}</textarea>

            <label for="isbn">ISBN:</label>
            <input type="text" id="isbn" name="isbn" required value="{{ old('isbn') }}">
            <div id="isbn-error" style="color: red; display: none;">El ISBN ya está registrado.</div>
            <div id="isbn-incomplete" style="color: red; display: none;">El ISBN debe tener al menos 13 dígitos.</div>

            <label for="unidades">Unidades Disponibles:</label>
            <input type="number" id="unidades" name="unidades" min="1" required value="{{ old('unidades') }}">

            <div class="button-container centered">
                <button type="submit" id="saveButton" disabled>Guardar</button>
                <button type="button" onclick="clearForm()">Limpiar</button>
                <a href="{{ route('libros.index') }}" class="btn-regresar">Ver Libros Registrados</a>
            </div>
        </form>

        @if($errors->any())
            <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        @endif
    </div>

    <div class="button-container centered">
        <a href="{{ url('/admin/registro') }}" class="btn-regresar">Regresar al Administrador</a>
    </div>

    <script src="{{ asset('js/scriptregistrolibro.js') }}"></script>
    <script src="{{ asset('js/GuardadoyLimpiar.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            if ($('#success-message').length > 0) {
                $('#success-message').fadeIn().delay(5000).fadeOut();
            }

            $('#isbn').on('input', function() {
                const isbn = $(this).val();
                const saveButton = $('#saveButton');
                if (isbn.length < 13) {
                    $('#isbn-incomplete').show();
                    $('#isbn-error').hide();
                    saveButton.prop('disabled', true);
                } else {
                    $('#isbn-incomplete').hide();
                    $.ajax({
                        url: '{{ route("libros.checkIsbn") }}',
                        method: 'GET',
                        data: { isbn },
                        success: function(response) {
                            if (response.exists) {
                                $('#isbn-error').show();
                                saveButton.prop('disabled', true);
                            } else {
                                $('#isbn-error').hide();
                                saveButton.prop('disabled', false);
                            }
                        }
                    });
                }
            });
        });

        function clearForm() {
            document.getElementById('formLibro').reset();
            localStorage.removeItem('formLibro');
        }
    </script>
</body>
</html>
