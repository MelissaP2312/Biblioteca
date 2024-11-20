<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="{{ asset('css/Libreria.css') }}">
    <style>
        /* Estilos para el footer */
        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }

        footer p {
            margin: 5px 0;
        }

        #dateTime {
            font-weight: bold;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Biblioteca Virtual</h1>
    </header>

    <nav>
        <a href="#">Inicio</a>
        <a href="#">Filtros</a>
        <a href="#">Membresía</a>
        <a href="#">Renta</a>
        <a href="{{ url('/foros') }}">Foros</a>
        <a href="{{ route('login') }}" class="btn-login">Iniciar sesión</a>
    </nav>

    <div class="main-container">
        <h2 class="section-title">Libros Disponibles</h2>
        <div class="libros-list">
            @foreach($libros as $libro)
            <div class="libro-card">
                <img src="{{ $libro->imagen ? 'data:image/jpeg;base64,' . base64_encode($libro->imagen) : asset('images/default-book-image.jpg') }}" alt="{{ $libro->nombre }}">
                <div class="card-content">
                    <h3>{{ $libro->nombre }}</h3>
                    <p><strong>Autor:</strong> {{ $libro->autor }}</p>
                    <a href="{{ route('libros.show', ['id' => $libro->id]) }}" class="btn-description">Ver descripción</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="main-container">
        <h2 class="section-title">Libros Mejor Calificados</h2>
        <div class="rank-list">
            @foreach($librosDestacados as $libro)
            <div class="rank-card">
                <div class="tag">Destacado</div>
                <img src="{{ $libro->imagen ? 'data:image/jpeg;base64,' . base64_encode($libro->imagen) : asset('images/default-book-image.jpg') }}" alt="{{ $libro->nombre }}">
                <div class="rank-content">
                    <h3>{{ $libro->nombre }}</h3>
                    <p><strong>Autor:</strong> {{ $libro->autor }}</p>
                    <p><strong>Calificación:</strong> {{ round($libro->ranking, 2) }}</p>
                    <a href="{{ route('libros.show', ['id' => $libro->id]) }}" class="btn-action">Ver descripción</a>
                </div>
            </div>
            @endforeach
        </div>   
    </div>
    <footer>
        <div class="footer-container">
            <p>&copy; 2024 Biblioteca Virtual. Todos los derechos reservados.</p>
            <p id="dateTime"></p>
        </div>
    </footer>      
    <script src="{{ asset('js/scriptfooterHorayFecha.js') }}"></script>
</body>
</html>
