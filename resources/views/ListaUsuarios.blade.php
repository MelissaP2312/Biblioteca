<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="{{ asset('css/estiloListaUsuarios.css') }}">
</head>
<body>
    <header>
        <h1>@isset($usuario) Editar Usuario @else Gestionar Usuarios @endisset</h1>
    </header>

    <div class="container">
        <!-- Mostrar Mensajes de Éxito -->
        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <!-- Mostrar Lista de Usuarios -->
        <div>
            <h2>Lista de Usuarios</h2>

            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td class="button-container">
                                <!-- Botón para Editar -->
                                <button type="button" class="btn-regresar" onclick="editarUsuario({{ $usuario->id }})">Editar</button>

                                <!-- Botón para eliminar usuario con confirmación -->
                                <button type="button" class="btn-regresar" onclick="confirmDelete({{ $usuario->id }})">Eliminar</button>

                                <!-- Formulario de edición de usuario (inicialmente oculto) -->
                                <div id="editar-{{ $usuario->id }}" class="form-edit" style="display:none;">
                                    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div>
                                            <label for="name">Nombre:</label>
                                            <input type="text" name="name" value="{{ $usuario->name }}" required>
                                        </div>

                                        <div>
                                            <label for="email">Email:</label>
                                            <input type="email" name="email" value="{{ $usuario->email }}" required>
                                        </div>

                                        <div>
                                            <label for="password">Nueva Contraseña (opcional):</label>
                                            <input type="password" name="password" id="password">
                                        </div>

                                        <div>
                                            <label for="password_confirmation">Confirmar Nueva Contraseña:</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation">
                                        </div>

                                        <button type="submit">Actualizar Usuario</button>
                                        <button type="button" onclick="cancelarEdicion({{ $usuario->id }})">Cancelar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal de Confirmación (inicialmente oculto) -->
        <div id="confirmDeleteModal" class="modal">
            <div class="modal-content">
                <p>¿Estás seguro de que deseas eliminar este usuario?</p>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background-color: #dc3545;">Sí, Eliminar</button>
                    <button type="button" style="background-color: #28a745;" onclick="closeModal()">Cancelar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Función para abrir el formulario de edición
        function editarUsuario(id) {
            document.getElementById('editar-' + id).style.display = 'block'; // Mostrar el formulario de edición
        }

        // Función para cancelar la edición
        function cancelarEdicion(id) {
            document.getElementById('editar-' + id).style.display = 'none'; // Ocultar el formulario de edición
        }

        // Función para abrir el modal de confirmación
        function confirmDelete(id) {
            const form = document.getElementById('deleteForm');
            form.action = '/usuarios/' + id;
            document.getElementById('confirmDeleteModal').style.display = 'flex'; // Mostrar el modal
        }

        // Función para cerrar el modal
        function closeModal() {
            document.getElementById('confirmDeleteModal').style.display = 'none'; // Ocultar el modal
        }
    </script>
</body>
</html>
