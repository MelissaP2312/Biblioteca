$(document).ready(function () {
    $('#saveButton').click(function (e) {
        e.preventDefault(); // Evita que el formulario se envíe inmediatamente

        const nombreAula = $('#nombre_aula').val();
        const fechaPrestamo = $('#fecha_prestamo').val();
        const horaInicio = $('#hora_inicio').val();
        const horaFin = $('#hora_fin').val();

        if (!nombreAula || !fechaPrestamo || !horaInicio || !horaFin) {
            alert('Por favor, completa todos los campos.');
            return;
        }

        $.ajax({
            url: '/verificar-disponibilidad',
            type: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
                nombre_aula: nombreAula,
                fecha_prestamo: fechaPrestamo,
                hora_inicio: horaInicio,
                hora_fin: horaFin
            },
            success: function (response) {
                if (response.disponible) {
                    $('#formLibro').unbind('submit').submit(); // Envía el formulario
                } else {
                    alert('El aula ya está ocupada en ese horario y fecha. Por favor, selecciona otro.');
                }
            },
            error: function () {
                alert('Ocurrió un error al verificar la disponibilidad. Inténtalo nuevamente.');
            }
        });
    });
});
