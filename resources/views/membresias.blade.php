<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Membresía</title>
    <link rel="stylesheet" href="../css/membresias.css">
</head>
<body>
    <div class="membership-status">
        <h1>Estado de tu Membresía</h1>
        <div class="membership-info">
            <p><strong>ID de Persona:</strong> <span id="personaId">Cargando...</span></p>
            <p><strong>Nombre:</strong> <span id="nombre">Cargando...</span></p>
            <p><strong>Número de Membresía:</strong> <span id="numeroMembresia">Cargando...</span></p>
            <p><strong>Nivel de Membresía:</strong> <span id="nivelMembresia">Cargando...</span></p>
            <p><strong>Penalizaciones:</strong> <span id="penalizaciones">Cargando...</span></p>
            <p><strong>Teléfono:</strong> <span id="telefono">Cargando...</span></p>
        </div>
    </div>
        <!-- Almacenamiento offline -->
        <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Verificar si el usuario está offline
            if (!navigator.onLine) {
                // Verifica si ya tenemos datos guardados en localStorage
                const savedData = localStorage.getItem('membresiaData');
                if (savedData) {
                    const formData = JSON.parse(savedData);
                    // Rellena los datos con los valores guardados
                    document.getElementById('personaId').innerText = formData.personaId || 'No disponible';
                    document.getElementById('nombre').innerText = formData.nombre || 'No disponible';
                    document.getElementById('numeroMembresia').innerText = formData.numeroMembresia || 'No disponible';
                    document.getElementById('nivelMembresia').innerText = formData.nivelMembresia || 'No disponible';
                    document.getElementById('penalizaciones').innerText = formData.penalizaciones || 'No disponible';
                    document.getElementById('telefono').innerText = formData.telefono || 'No disponible';
                }
            }

            // Guardar los datos en localStorage cuando estemos offline
            if (!navigator.onLine) {
                const datosMembresia = {
                    personaId: document.getElementById('personaId').innerText,
                    nombre: document.getElementById('nombre').innerText,
                    numeroMembresia: document.getElementById('numeroMembresia').innerText,
                    nivelMembresia: document.getElementById('nivelMembresia').innerText,
                    penalizaciones: document.getElementById('penalizaciones').innerText,
                    telefono: document.getElementById('telefono').innerText
                };

                localStorage.setItem('membresiaData', JSON.stringify(datosMembresia));
            }
        });
    </script>
    <script src="../js/membresias.js"></script>
</body>
</html>

