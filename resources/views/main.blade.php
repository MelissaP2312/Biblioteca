<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="../css/Libreria.css">
    <style>
        /* Estilo para el menú desplegable */
        .dropdown {
            position: relative;
            display: inline-block;
        }
        
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f7e5af;
            min-width: 160px;
            border: 1px solid #000000;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .dropdown-content a {
            display: block;
            padding: 10px;
            color: #000000;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            text-decoration: none;
            background-color: white;
            text-align: center;
            border-bottom: 1px solid #d9d9d9;
            background-color: #f7e5af;
        }

        .dropdown-content a:hover {
            background-color: #badcd5;
            transition: background 0.3s ease;
        }

        .dropdown:hover .dropdown-content {
            display: block;
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
            <li><a href="{{ url('/foros') }}"></a>Foros</li>
        </ul>
        <a class="btn btn-danger btn-md" href="{{ route('login') }}">Iniciar sesión</a>
    </nav>
    <div id="contenedor-principal">
        <div id="libros">
            <div id="loading"></div>
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
    <script src="../js/main.js"></script>
</body>
</html>
