document.addEventListener('DOMContentLoaded', function () {
    const contenedorDeTarjetas = document.getElementById('contenedor-de-tarjetas');
    const loading = document.getElementById('loading');

    // Simulamos que los libros se cargan después de 2 segundos
    setTimeout(() => {
        // Depura la variable libros
        console.log(libros);

        // Asegúrate de que libros sea un array
        if (Array.isArray(libros)) {
            libros.forEach(libro => {
                const card = document.createElement('div');
                card.classList.add('card');

                const img = document.createElement('img');
                img.src = `/libros/imagen/${libro.id}`; // Ruta de la imagen
                img.alt = libro.nombre;

                // Manejo de errores si la imagen no carga
                img.onerror = function () {
                    img.src = '/images/default.jpg'; // Imagen predeterminada
                };

                const h3 = document.createElement('h3');
                h3.innerText = libro.nombre;

                const pAutor = document.createElement('p');
                pAutor.innerHTML = `<strong>Autor:</strong> ${libro.autor}`;

                const pGenero = document.createElement('p');
                pGenero.innerHTML = `<strong>Género:</strong> ${libro.genero}`;

                // Añade todos los elementos a la tarjeta
                card.appendChild(img);
                card.appendChild(h3);
                card.appendChild(pAutor);
                card.appendChild(pGenero);

                // Añade la tarjeta al contenedor
                contenedorDeTarjetas.appendChild(card);
            });
        } else {
            console.error('La variable "libros" no es un array válido:', libros);
        }
    }, 2000); // Espera 2 segundos (simulación de carga de libros)
});
