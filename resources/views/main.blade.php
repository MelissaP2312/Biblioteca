<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="{{ asset('css/Libreria.css') }}">
    <style>
        /* Estilo para la lista de libros */
        .libros-list {
            display: flex; /* Cambiamos a flexbox */
            flex-wrap: wrap; /* Permite que las tarjetas pasen a la siguiente fila si no caben */
            justify-content: flex-start; /* Alineación horizontal de las tarjetas */
            gap: 20px; /* Espacio entre las tarjetas */
            padding: 20px; /* Espacio interno para todo el contenedor */
        }
        .libro-card {
            width: 280px; /* Fija el ancho de las tarjetas */
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: transform 0.3s ease;
        }
        .libro-card:hover {
            transform: scale(1.05);
        }
        .libro-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        .libro-card .card-content {
            padding: 15px;
        }
        .libro-card h2 {
            font-size: 22px;
            margin: 10px 0;
            color: #333;
        }
        .libro-card p {
            margin: 5px 0;
            font-size: 14px;
            color: #777;
        }
        .libro-card .descripcion {
            font-size: 13px;
            color: #555;
            margin-top: 10px;
        }
        .libro-link {
            text-decoration: none;
            color: inherit;
        }
        .libro-link:hover .libro-card {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <h1>Librería</h1>
    <nav>
        <ul class="opciones">
            <li class="dropdown">
                Filtros
                <div class="dropdown-content">
                    <a href="#">Acción</a>
                    <a href="#">Comedia</a>
                    <a href="#">Romance</a>
                    <a href="#">Terror y Suspenso</a>
                    <a href="#">Otros</a>
                </div>
            </li>
            <li>Membresía</li>
            <li>Renta</li>
            <li><a href="{{ url('/foros') }}">Foros</a></li>
        </ul>
        <a class="btn btn-danger btn-md" href="{{ route('login') }}">Iniciar sesión</a>
    </nav>

    <div id="contenedor-principal">
        <div id="libros">
            <!-- Ajustamos el contenedor de las tarjetas -->
            <div class="libros-list">
                @foreach($libros as $libro)
                <a href="{{ route('libros.show', ['id' => $libro->id]) }}" class="libro-link">
                    <div class="libro-card">
                    <img src="{{ $libro->imagen ? 'data:image/jpeg;base64,' . base64_encode($libro->imagen) : asset('images/default-book-image.jpg') }}" alt="{{ $libro->nombre }}">
                    <div class="card-content">
                        <h2>{{ $libro->nombre }}</h2>
                        <!-- Unidades disponibles -->
                        <p><strong>Unidades Disponibles:</strong> {{ $libro->unidades }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="rankings">
        <div class="contenedorrank" id="rankings-title">
            <h4>Rankings</h4>
            <p>Libros más leídos</p>
            <p>Libros más valorados</p>
            <p>Libros más rentados</p>
        </div>
    </div>

    <div id="footer">
        <p>Copyright SoftLibrary © . All rights reserved.</p>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        var libros = @json($libros); // Pasa los libros como un array JSON
    </script>
</body>
</html>
