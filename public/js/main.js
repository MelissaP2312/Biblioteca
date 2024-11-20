document.addEventListener('DOMContentLoaded', () => {
    const apiUrl = 'https://miapi.com/libros'; // URL de la API
    const librosContainer = document.getElementById('libros');
    const loadingElement = document.getElementById('loading');

    const createBookCard = (libro) => {
        const contenedorLibro = document.createElement('div');
        contenedorLibro.className = 'ContenedorLibro';

        contenedorLibro.innerHTML = `
            <h4 id="nombre-libro">${libro.nombre}</h4>
            <img src="${libro.imagen}" alt="Portada libro" />
            <p>Autor</p>
            <p id="autor">${libro.autor}</p>
            <p>Género</p>
            <p id="genero">${libro.genero}</p>
        `;
        return contenedorLibro;
    };

    const loadBooks = async () => {
        const controller = new AbortController();
        const timeout = setTimeout(() => controller.abort(), 10000); // Timeout de 10 segundos
        let hasResponse = false;

        try {
            loadingElement.style.display = 'block'; // Mostrar indicador de carga

            const response = await fetch(apiUrl, { signal: controller.signal });
            clearTimeout(timeout);

            if (!response.ok) {
                throw new Error('Error en la respuesta de la API');
            }

            const libros = await response.json();
            hasResponse = true;

            if (!Array.isArray(libros)) {
                throw new Error('Formato de datos incorrecto');
            }

            librosContainer.innerHTML = ''; // Limpiar contenido previo
            libros.forEach((libro) => {
                const bookCard = createBookCard(libro);
                librosContainer.appendChild(bookCard);
            });
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Hubo un problema al cargar los libros.',
                confirmButtonText: 'Aceptar'
            });
        } finally {
            if (!hasResponse) {
                librosContainer.innerHTML = '<p>No se pudieron cargar los libros. Intenta nuevamente más tarde.</p>';
            }
            loadingElement.style.display = 'none'; // Ocultar indicador de carga
        }
    };

    loadBooks();
});
