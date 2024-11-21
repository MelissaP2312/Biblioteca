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
        <div class="dropdown">
            <span class="dropdown-trigger">Filtros</span>
            <div class="dropdown-content">
                <a href="#" class="filter-option" data-genero="none">Eliminar Filtro</a>
                @foreach($generos as $genero)
                    <a href="#" class="filter-option" data-genero="{{ $genero->genero }}">{{ $genero->genero }}</a>
                @endforeach
            </div>
        </div>        
        <a href="#">Membresía</a>
        <a href="{{ route('rentas.create') }}">Renta</a>
        <a href="{{ url('/foros') }}">Foros</a>
        @if(Auth::check())
        <div class="dropdown">
            <span class="dropdown-trigger">Hola, {{ Auth::user()->nombre }}</span>
            <div class="dropdown-menu">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
        @else
            <a href="{{ route('login') }}" class="btn-login">Iniciar sesión</a>
        @endif
    </nav>
    
    <div class="main-container">
        <h2 class="section-title">Libros Disponibles</h2>
        <div class="libros-list" id="libros-list">
            @foreach($libros as $libro)
            <div class="libro-card" data-genero="{{ $libro->genero }}">
                <img src="{{ $libro->imagen ? 'data:image/jpeg;base64,' . base64_encode($libro->imagen) : asset('images/default-book-image.jpg') }}" alt="{{ $libro->nombre }}">
                <div class="card-content">
                    <h3>{{ $libro->nombre }}</h3>
                    <p><strong>Autor:</strong> {{ $libro->autor }}</p>
                    <p><strong>Género:</strong> {{ $libro->genero }}</p>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterOptions = document.querySelectorAll('.filter-option');
    
            filterOptions.forEach(option => {
                option.addEventListener('click', function (e) {
                    e.preventDefault();
                    const genero = this.getAttribute('data-genero');
                    const url = new URL(window.location.href);
    
                    if (genero === "none") {
                        // Eliminar todos los filtros
                        url.searchParams.delete('genero');
                    } else if (genero) {
                        // Aplicar un filtro específico
                        url.searchParams.set('genero', genero);
                    }
    
                    // Recargar la página con los filtros actualizados
                    window.location.href = url.toString();
                });
            });
        });
    </script>
      
</body>
</html>
