// URL de la API (ajusta esto al endpoint correcto de tu servidor)
const apiUrl = 'api/membresia';

// Función para obtener los datos de la membresía desde la API
async function fetchMembershipStatus() {
    try {
        const response = await fetch(apiUrl);
        
        if (!response.ok) {
            throw new Error(`Error en la solicitud: ${response.status}`);
        }

        const data = await response.json();

        // Actualizar el contenido de los elementos con los datos obtenidos
        document.getElementById('personaId').textContent = data.personaId;
        document.getElementById('nombre').textContent = data.nombre;
        document.getElementById('numeroMembresia').textContent = data.numeroMembresia;
        document.getElementById('nivelMembresia').textContent = data.nivelMembresia;
        document.getElementById('penalizaciones').textContent = data.penalizaciones;
        document.getElementById('telefono').textContent = data.telefono;
    } catch (error) {
        console.error('Error al obtener los datos:', error);
        document.querySelector('.membership-info').innerHTML = "<p>No se pudo cargar la información de la membresía.</p>";
    }
}

// Llamar a la función para cargar los datos al cargar la página
fetchMembershipStatus();