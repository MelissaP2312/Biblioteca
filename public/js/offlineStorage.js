// Función para guardar datos en localStorage
function guardarDatosLocalmente(datos) {
    localStorage.setItem('datosPendientes', JSON.stringify(datos)); // Guardamos los datos como una cadena JSON
}

// Función para recuperar datos de localStorage
function recuperarDatosLocalmente() {
    const datos = localStorage.getItem('datosPendientes');
    return datos ? JSON.parse(datos) : null; // Devuelve los datos como objeto si existen
}

// Función para verificar si hay conexión a internet
function verificarConexion() {
    if (navigator.onLine) {
        // Si hay conexión, devolver los datos al servidor
        const datos = recuperarDatosLocalmente();
        if (datos) {
            enviarDatosAlServidor(datos);
        }
    } else {
        console.log('Sin conexión. Los datos se guardarán localmente.');
    }
}

// Función para enviar datos al servidor
function enviarDatosAlServidor(datos) {
    fetch('/api/sincronizar-datos', { // Cambia la URL a la de tu endpoint de sincronización
        method: 'POST',
        body: JSON.stringify(datos),
        headers: { 'Content-Type': 'application/json' }
    })
    .then(response => response.json())
    .then(data => {
        console.log('Datos sincronizados con el servidor:', data);
        // Limpiar los datos guardados localmente
        localStorage.removeItem('datosPendientes');
    })
    .catch(error => {
        console.error('Error al sincronizar los datos:', error);
    });
}

// Detectar eventos de conexión y desconexión
window.addEventListener('online', verificarConexion);
window.addEventListener('offline', () => console.log('Sin conexión a internet'));

// Esta función se llamará al cargar la página para comprobar la conexión y recuperar datos
document.addEventListener('DOMContentLoaded', verificarConexion);
