{{-- resources/views/admin/libros/index.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estiloslibrosindex.css') }}">
    <title>Lista de Libros</title>
    <style>
        /* Barra de navegación */
        .navbar {
            background-color: #333;
            padding: 10px;
            text-align: center;
        }
        .navbar input[type="text"],
        .navbar select {
            padding: 8px;
            width: 200px;
            margin-right: 10px;
            border-radius: 4px;
            border: none;
        }
        .navbar button {
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .navbar button:hover {
            background-color: #45a049;
        }

        /* Estilos para la lista de libros */
        .libros-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
            margin-top: 20px;
        }
        .libro-card {
            width: 280px;
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

        /* Mensaje de éxito */
        .alert-success {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    {{-- Barra de Navegación --}}
    <div class="navbar">
        <form action="{{ route('libros.index') }}" method="GET" id="search-form">
            <!-- Barra de búsqueda por título -->
            <input type="text" name="search" id="search" placeholder="Buscar por título..." value="{{ request('search') }}">

            <!-- Filtro por género -->
            <select name="genero" id="genero">
                <option value="">Selecciona un Género</option>
                @foreach($generos as $genero)
                    <option value="{{ $genero->genero }}" {{ request('genero') == $genero->genero ? 'selected' : '' }}>
                        {{ $genero->genero }}
                    </option>
                @endforeach
            </select>

            <!-- Filtro por autor -->
            <select name="autor" id="autor">
                <option value="">Selecciona un Autor</option>
                @foreach($autores as $autor)
                    <option value="{{ $autor->autor }}" {{ request('autor') == $autor->autor ? 'selected' : '' }}>
                        {{ $autor->autor }}
                    </option>
                @endforeach
            </select>

            <button type="submit">Buscar</button>
        </form>

        <!-- Botón para regresar a la vista de administrador -->
        <div class="button-container">
            <a href="{{ url('/admin/registro') }}" class="btn-regresar">Regresar al Administrador</a>
        </div>
        
    </div>

    {{-- Mensaje de éxito si existe --}}
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Título de la página --}}
    <h1>Lista de Libros</h1>

    {{-- Lista de libros --}}
    <div class="libros-list">
        @foreach($libros as $libro)
        <div class="libro-card">
            <img src="{{ $libro->imagen ? 'data:image/jpeg;base64,' . base64_encode($libro->imagen) : asset('images/default-book-image.jpg') }}" alt="{{ $libro->nombre }}">
            <div class="card-content">
                <h2>{{ $libro->nombre }}</h2>
                <p><strong>Autor:</strong> {{ $libro->autor }}</p>
                <p><strong>Género:</strong> {{ $libro->genero }}</p>
                <div class="descripcion">
                    <p><strong>Descripción:</strong></p>
                    <p>{{ Str::limit($libro->descripcion, 100) }}</p>
                </div>
                <!-- Unidades disponibles -->
                <p><strong>Unidades Disponibles:</strong> {{ $libro->unidades }}</p>
            </div>
        </div>
        @endforeach
    </div>
    {{-- Almacenamiento offline --}}
    <script src="{{ asset('js/offlineStorage.js') }}"></script>
    <script>
        // Verifica si el usuario está offline
        if (!navigator.onLine) {
            // Obtiene los filtros de búsqueda y guardarlos en localStorage
            const searchQuery = document.getElementById('search') ? document.getElementById('search').value : '';
            const generoFilter = document.getElementById('genero') ? document.getElementById('genero').value : '';
            const autorFilter = document.getElementById('autor') ? document.getElementById('autor').value : '';

            // Guarda los datos en localStorage
            const filterData = {
                search: searchQuery,
                genero: generoFilter,
                autor: autorFilter
            };

            localStorage.setItem('librosSearchFilters', JSON.stringify(filterData));
        } else {
            // Restaura los filtros si los datos están en localStorage cuando el usuario vuelva en línea
            const savedFilters = JSON.parse(localStorage.getItem('librosSearchFilters'));
            if (savedFilters) {
                document.getElementById('search').value = savedFilters.search;
                document.getElementById('genero').value = savedFilters.genero;
                document.getElementById('autor').value = savedFilters.autor;
            }
        }
    </script>

</body>
</html>
