<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vista Principal</title>
        <link rel="stylesheet" href="../css/estiloVR.css">
    </head>
    <body>
        <div class="header">
            <img src="logo.png" alt="Logo Principal" class="logo"> <!-- Asegúrate de tener el logo en la misma carpeta -->
        </div>
        <div class="container">
            <div class="info-container">
                <div class="buttons">
                    <a href="{{ url('/registro/libros')}}" class="button">Libros</a>
                    <a href="{{ url('/registro/material')}}" class="button">Material</a>
                    <a href="{{ url('/registro/aulas')}}" class="button">Aulas</a>
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
