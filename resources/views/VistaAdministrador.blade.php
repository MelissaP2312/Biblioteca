<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Principal</title>
    <link rel="stylesheet" href="../css/estiloVA.css">
    <style>
        .logout-container {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }

        .logout-button {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .logout-button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="logo.png" alt="Logo Principal" class="logo">
        <div class="logout-container">
            <a href="#" class="logout-button"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Cerrar Sesión
            </a>
            <form id="logout-form" action="{{ route('empleado.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
    <div class="container">
        <div class="info-container">
            <div class="buttons">
                <a href="{{ url('admin/registro') }}" class="button">Registro</a>
                <a href="{{ url('admin/rentas') }}" class="button">Rentas</a>
                <a href="{{ url('admin/devolucion') }}" class="button">Devolver</a>
                <a href="{{ url('admin/foros') }}" class="button">Foros</a>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="footer-info">
            © 2024 SoftLibrary Inc. Todos los derechos reservados.
        </div>
        <div class="footer-date-time" id="dateTime"></div>
    </div>

    <script src="../js/scriptfooterHorayFecha.js"></script>
</body>
</html>
