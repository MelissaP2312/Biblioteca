<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $libro->nombre }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            display: flex;
            gap: 20px;
        }

        .left-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .left-section img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            border: 2px solid #ddd;
        }

        .right-section {
            flex: 1.5;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            gap: 20px;
        }

        .details h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 10px;
        }

        .details p {
            font-size: 16px;
            margin: 5px 0;
            color: #555;
        }

        .details p span {
            font-weight: bold;
            color: #2c3e50;
        }

        .description {
            margin-top: 20px;
            font-size: 16px;
            color: #555;
            line-height: 1.6;
            text-align: justify;
        }

        .calificacion-form {
            margin-top: 20px;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .calificacion-form label {
            font-weight: bold;
            color: #555;
        }

        .calificacion-form select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .calificacion-form button {
            padding: 10px 20px;
            background-color: #1abc9c;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .calificacion-form button:hover {
            background-color: #16a085;
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 8px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .right-section {
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sección izquierda -->
        <div class="left-section">
            <img src="{{ $libro->imagen ? 'data:image/jpeg;base64,' . base64_encode($libro->imagen) : asset('images/default-book-image.jpg') }}" alt="{{ $libro->nombre }}">
        </div>

        <!-- Sección derecha -->
        <div class="right-section">
            <div class="details">
                <h1>{{ $libro->nombre }}</h1>
                <p><span>Autor:</span> {{ $libro->autor }}</p>
                <p><span>Género:</span> {{ $libro->genero }}</p>
                <p><span>ISBN:</span> {{ $libro->isbn }}</p>
                <p><span>Unidades Disponibles:</span> {{ $libro->unidades }}</p>
            </div>

            <div class="description">
                <h3>Descripción</h3>
                <p>{{ $libro->descripcion }}</p>
            </div>

            <!-- Formulario de calificación -->
            <div class="calificacion-form">
                <form action="{{ route('libros.addCalificacion', ['id' => $libro->id]) }}" method="POST">
                    @csrf
                    <label for="puntuacion">Calificación:</label>
                    <select name="puntuacion" id="puntuacion" required>
                        <option value="" disabled selected>Selecciona</option>
                        <option value="1">1 - Muy Mala</option>
                        <option value="2">2 - Mala</option>
                        <option value="3">3 - Regular</option>
                        <option value="4">4 - Buena</option>
                        <option value="5">5 - Excelente</option>
                    </select>
                    <button type="submit">Enviar</button>
                </form>
            </div>

            <!-- Botón de regresar -->
            <a href="{{ route('main') }}" class="back-button">Regresar</a>
        </div>
    </div>
</body>
</html>
