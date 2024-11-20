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
    <title>Login Empleados</title>
    <link href="../css/styles.css" rel="stylesheet" id="style">
    <!-- Bootstrap -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <!-- Font Awesome-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>

<!-- Contenedor Vista Iniciar Sesión-->
<div id="login-container" class="container" style="display: block;">
    <div class="row justify-content-center">
        <div class="col-md-4 text-center">
            <div class="form-login"></br>
                <h1>Iniciar sesión</h1>
                </br>
                <form action="{{ route('empleado.login') }}" method="POST">
                    @csrf
                    <input type="text" name="id_empleado" class="form-control input-sm chat-input" placeholder="ID de Empleado" required />
                    </br></br>
                    <input type="password" name="password" class="form-control input-sm chat-input" placeholder="Contraseña" required />
                    </br></br>
                    <div class="wrapper">
                        <span class="group-btn">
                            <a class="btn btn-danger btn-md" id="registerButton" href="{{ route('empleado.register') }}">Registrar</a>
                            <button type="submit" class="btn btn-danger btn-md">Iniciar sesión <i class="fa fa-sign-in"></i></button>
                        </span>
                    </div>
                </form>
                @if(session('error'))
                    <div class="alert alert-danger mt-2">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

</body>
</html>
