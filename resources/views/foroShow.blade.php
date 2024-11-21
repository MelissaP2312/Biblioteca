<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/Foros.css') }}">
    <title>Foro de Librería - Admin</title>
    <style>
        /* Fondo de la página y tipografía */
        body {
            background: url("{{ asset('resources/fondo_login.jpg') }}") no-repeat center center;
            background-position: center;
            background-size: cover;
            margin: 0;
            -webkit-font-smoothing: antialiased;
            font-family: 'Lora', serif !important;
            background-color: #9b7e52; /* Naranja suave */
        }

        /* Barra superior */
        .header {
            background-color: #f7e5af; /* Naranja más fuerte */
            padding: 20px;
            text-align: left;
        }

        /* Contenedor principal */
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            height: calc(100vh - 80px); /* Ajusta la altura para dejar espacio para la barra */
            justify-content: center;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal-header, .modal-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .close-btn {
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            font-size: 18px;
            cursor: pointer;
        }

        /* Estilo para los botones */
        .admin-options button {
            background-color: #f7e5af; /* Naranja más fuerte */
            border: none;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(231, 174, 109, 0.2);
        }

        .admin-options button:hover {
            background-color: #a95a00;
            transform: translateY(-2px);
        }

        /* Tema de discusión */
        .forum-header {
            background-color: rgba(255, 255, 255, 0.8); /* Blanco con opacidad */
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        /* Contenedor de los temas */
        .topics {
            list-style-type: none;
            padding: 0;
        }

        .topics li {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Estilo de la barra inferior */
        .footer {
            background-color: #f7e5af;
            color: rgb(0, 0, 0);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            border-top: 3px solid #f7e5af;
        }

        .footer-info {
            flex: 1;
        }

        .footer-date-time {
            margin-left: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Panel de Administración del Foro</h1>
        </div>

        <div class="admin-options">
            <button id="createTopicBtn">Crear nuevo tema</button>
            <button id="manageUsersBtn">Gestionar usuarios</button>
            <button id="viewReportsBtn">Ver reportes</button>
            <a href="{{ route('main') }}" class="btn-back">Volver al inicio</a>
        </div>

        <div class="forum-header">
            <h2>Temas de Discusión</h2>
        </div>

        <ul class="topics" id="topics-list">
            <div id="loading">Cargando temas...</div>
        </ul>
    </div>

    <!-- Modal para crear nuevo tema -->
    <div class="modal" id="createTopicModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Crear Nuevo Tema</h3>
                <button class="close-btn" id="closeModalBtn">&times;</button>
            </div>
            <form id="createTopicForm" action="{{ route('temas.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="titulo">Título del Tema</label>
                    <input type="text" id="titulo" name="titulo" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn-save">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Botón "Crear Nuevo Tema"
            const createTopicBtn = document.getElementById("createTopicBtn");
            const createTopicModal = document.getElementById("createTopicModal");
            const closeModalBtn = document.getElementById("closeModalBtn");

            createTopicBtn.addEventListener("click", () => {
                createTopicModal.style.display = "block";
            });

            closeModalBtn.addEventListener("click", () => {
                createTopicModal.style.display = "none";
            });

            window.addEventListener("click", (event) => {
                if (event.target === createTopicModal) {
                    createTopicModal.style.display = "none";
                }
            });

            // Botón "Gestionar Usuarios"
            const manageUsersBtn = document.getElementById("manageUsersBtn");
            manageUsersBtn.addEventListener("click", () => {
                swal("Redirigiendo a la página de gestión de usuarios...").then(() => {
                    window.location.href = "{{ route('usuarios.index') }}";
                });
            });

            // Botón "Ver Reportes"
            const viewReportsBtn = document.getElementById("viewReportsBtn");
            viewReportsBtn.addEventListener("click", () => {
                swal("Funcionalidad en desarrollo", "Aquí podrás ver y gestionar los reportes.", "info");
            });

            // Simulación de carga de temas
            setTimeout(() => {
                document.getElementById('loading').innerHTML = ''; // Quitar mensaje de carga
                document.getElementById('topics-list').innerHTML = `
                    <li>Tema 1: Cómo organizar una biblioteca</li>
                    <li>Tema 2: Sugerencias de libros para verano</li>
                    <li>Tema 3: Discusión sobre tecnología y lectura</li>
                `;
            }, 1500);
        });
    </script>
</body>
</html>
