<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $libro->nombre }}</title>
    <style>
        .libro-detalle {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .libro-detalle img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .libro-detalle h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }
        .libro-detalle p {
            font-size: 16px;
            line-height: 1.6;
        }
        .libro-detalle .descripcion {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="libro-detalle">
        <img src="{{ $libro->imagen ? 'data:image/jpeg;base64,' . base64_encode($libro->imagen) : asset('images/default-book-image.jpg') }}" alt="{{ $libro->nombre }}">
        <h1>{{ $libro->nombre }}</h1>
        <p><strong>Autor:</strong> {{ $libro->autor }}</p>
        <p><strong>Género:</strong> {{ $libro->genero }}</p>
        <p><strong>ISBN:</strong> {{ $libro->isbn }}</p>
        <p><strong>Unidades Disponibles:</strong> {{ $libro->unidades }}</p>
        <div class="descripcion">
            <p><strong>Descripción:</strong></p>
            <p>{{ $libro->descripcion }}</p>
        </div>
    </div>
    <div class="calificacion-form">
        <form action="{{ route('libros.addCalificacion', ['id' => $libro->id]) }}" method="POST">
            @csrf
            <label for="puntuacion">Calificación (1-5):</label>
            <select name="puntuacion" id="puntuacion" required>
                <option value="" disabled selected>Selecciona</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <button type="submit">Enviar Calificación</button>
        </form>
    </div>   
    
</body>
</html>
