<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="unique login form,leamug login form,boostrap login form,responsive login form,free css html login form,download login form">
    <meta name="author" content="leamug">
    <title>Registro de Empleado</title>
    <link href="../css/styles.css" rel="stylesheet" id="style">
    <!-- Bootstrap -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div id="register-container" class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 text-center">
            <div class="form-login"></br>
                <h1>Crear cuenta de Empleado</h1>
                <form action="{{route('empleado.register')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="id_empleado">ID de Empleado:</label>
                        <input type="text" name="id_empleado" id="id_empleado" class="form-control" placeholder="ID de Empleado" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre Completo:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre Completo" required>
                    </div>
                    <div class="form-group">
                        <label for="edad">Edad:</label>
                        <input type="number" name="edad" id="edad" class="form-control" placeholder="Edad" min="18" max="120" required>
                    </div>
                    <div class="form-group">
                        <label>Género:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="genero" id="masculino" value="Masculino" required>
                            <label class="form-check-label" for="masculino">Masculino</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="genero" id="femenino" value="Femenino" required>
                            <label class="form-check-label" for="femenino">Femenino</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="genero" id="otro" value="Otro" required>
                            <label class="form-check-label" for="otro">Otro</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Teléfono" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Correo Electrónico" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">Confirmar Contraseña:</label>
                        <input type="password" name="password_confirmation" id="password-confirm" class="form-control" placeholder="Confirmar Contraseña" required>
                    </div>

                    <div class="form-group">
                        <label for="puesto">Puesto:</label>
                        <input type="text" name="puesto" id="puesto" class="form-control" placeholder="Puesto de trabajo" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_ingreso">Fecha de Ingreso:</label>
                        <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="departamento">Departamento:</label>
                        <input type="text" name="departamento" id="departamento" class="form-control" placeholder="Departamento" required>
                    </div>

                    <br/>
                    <div class="wrapper">
                        <span class="group-btn">
                            <button type="submit" class="btn btn-danger btn-md" id="registerBtn">Registrar</button>
                            <a class="btn btn-danger btn-md" id="loginBtn" href="{{ url('login/empleado') }}">Iniciar sesión</a>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../js/script2.js"></script>

</body>
</html>