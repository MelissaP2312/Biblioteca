<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estiloslibrosregistro.css') }}">
    <style>
        /* Estilo para el botón deshabilitado */
        button:disabled {
            opacity: 0.5;  /* Hace el botón semi-transparente */
            cursor: not-allowed;  /* Cambia el cursor a un icono de no permitido */
        }

        /* Estilo para el mensaje de éxito */
        #success-message {
            display: none; /* Inicialmente oculto */
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            width: 300px;
        }

    </style>
    <title>Registro de Libros</title>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div id="success-message">
            {{ session('success') }}
        </div>
    @endif

</head>
<body>
    <h1>Registrar un Libro</h1>

    <div class="form-container">
        <form id="formLibro" action="{{ route('libros.store') }}" method="post" enctype="multipart/form-data">
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

            <div class="button-container">
                <button type="submit" id="saveButton" disabled>Guardar</button>
                <button type="button" onclick="clearForm()">Limpiar</button>
            </div>

            <button type="button" onclick="window.location.href='{{ route('libros.index') }}'">Ver Libros Registrados</button>

        </form>

        @if($errors->any())
            <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        @endif
    </div>

        <!-- Botón para regresar a la vista del administrador -->
    <div class="button-container">
        <a href="{{ url('/admin/registro') }}" class="btn-regresar">Regresar al Adminis trador</a>
    </div>

    <script src="{{ asset('js/scriptregistrolibro.js') }}"></script>
    <script src="{{ asset('js/GuardadoyLimpiar.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Mostrar el mensaje de éxito y ocultarlo después de 5 segundos
        $(document).ready(function() {
            if ($('#success-message').length > 0) {
                $('#success-message').fadeIn().delay(5000).fadeOut();
            }

            // Validación del campo ISBN (como antes, para deshabilitar el botón)
            $('#isbn').on('input', function() {
                var isbn = $(this).val();
                var saveButton = $('#saveButton');

                // Validar longitud de ISBN
                if (isbn.length < 13) {
                    $('#isbn-incomplete').show();
                    $('#isbn-error').hide();
                    saveButton.prop('disabled', true);
                } else {
                    $('#isbn-incomplete').hide();
                    $.ajax({
                        url: '{{ route("libros.checkIsbn") }}',
                        method: 'GET',
                        data: { isbn: isbn },
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
    </script>

</body>
</html>
