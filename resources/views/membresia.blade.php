<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Membresía</title>
    <link rel="stylesheet" href="{{ asset('css/membresia.css') }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .profile img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid #007bff;
            object-fit: cover;
        }

        .profile-info {
            flex-grow: 1;
        }

        .profile-info h2 {
            margin: 0;
            color: #333;
            font-size: 24px;
        }

        .profile-info p {
            margin: 5px 0;
            color: #555;
        }

        .rentas-section {
            margin-top: 30px;
        }

        .rentas-section h3 {
            margin-bottom: 15px;
            color: #007bff;
        }

        .renta-item {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 10px;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .renta-item:hover {
            transform: scale(1.02);
        }

        .renta-item h4 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }

        .renta-item p {
            margin: 5px 0;
            color: #555;
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Perfil del usuario -->
        <div class="profile">
            <img src="{{ asset('images/froakie.png') }}" alt="Perfil">
            <div class="profile-info">
                <h2>{{ $user->nombre }}</h2>
                <p><strong>Correo:</strong> {{ $user->email }}</p>
                <p><strong>Membresía:</strong> {{ $user->id ?? 'N/A' }}</p>
            </div>
        </div>

        <!-- Rentas de libros -->
        <div class="rentas-section">
            <h3>Mis Rentas de Libros</h3>
            @if($rentasLibros->count() > 0)
                @foreach($rentasLibros as $renta)
                <div class="renta-item">
                    <h4>{{ $renta->libro->nombre }}</h4>
                    <p><strong>Fecha de Préstamo:</strong> {{ $renta->fecha_prestamo }}</p>
                    <p><strong>Fecha de Devolución:</strong> 
                        {{ $renta->fecha_devolucion ? $renta->fecha_devolucion : 'Pendiente' }}
                    </p>
                    <p><strong>Unidades Rentadas:</strong> {{ $renta->unidades_disponibles }}</p>
                </div>
                @endforeach
            @else
                <p>No tienes rentas de libros activas.</p>
            @endif
        </div>

        <!-- Rentas de materiales -->
        <div class="rentas-section">
            <h3>Mis Rentas de Materiales</h3>
            @if($rentasMateriales->count() > 0)
                @foreach($rentasMateriales as $renta)
                <div class="renta-item">
                    <h4>{{ $renta->nombre_material }}</h4>
                    <p><strong>Fecha de Préstamo:</strong> {{ $renta->fecha_prestamo }}</p>
                    <p><strong>Fecha de Devolución:</strong> 
                        {{ $renta->fecha_devolucion ? $renta->fecha_devolucion : 'Pendiente' }}
                    </p>
                    <p><strong>Unidades Rentadas:</strong> {{ $renta->unidades_disponibles }}</p>
                </div>
                @endforeach
            @else
                <p>No tienes rentas de materiales activas.</p>
            @endif
        </div>

        <!-- Rentas de aulas -->
        <div class="rentas-section">
            <h3>Mis Rentas de Aulas</h3>
            @if($rentasAulas->count() > 0)
                @foreach($rentasAulas as $renta)
                <div class="renta-item">
                    <h4>{{ $renta->nombre_aula }}</h4>
                    <p><strong>Fecha de Préstamo:</strong> {{ $renta->fecha_prestamo }}</p>
                    <p><strong>Hora de Inicio:</strong> {{ $renta->hora_inicio }}</p>
                    <p><strong>Hora de Fin:</strong> {{ $renta->hora_fin }}</p>
                </div>
                @endforeach
            @else
                <p>No tienes rentas de aulas activas.</p>
            @endif
        </div>

        <!-- Botón de regreso -->
        <a href="{{ route('main') }}" class="back-button">Regresar al Inicio</a>
    </div>
</body>
</html>
