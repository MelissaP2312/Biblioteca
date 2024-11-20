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
    <title>Registro</title>
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

<!-- Contenedor Vista Registro-->
<div id="register-container" class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 text-center">
            <div class="form-login"></br>
                <h1>Crear cuenta</h1>
                <form action="{{route('register.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Ingresa tu nombre:</label>
                        <input type="text" name="nombre" id="name" class="form-control" placeholder="Nombres" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Ingresa tu edad:</label>
                        <input type="number" name="edad" id="age" class="form-control" placeholder="Edad" min="1" max="120" required>
                    </div>
                    <div class="form-group">
                        <label>Selecciona tu género:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="genero" id="male" value="Masculino" required>
                            <label class="form-check-label" for="male">Masculino</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="genero" id="female" value="Femenino" required>
                            <label class="form-check-label" for="female">Femenino</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="genero" id="other" value="Otro" required>
                            <label class="form-check-label" for="other">Otro</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Ingresa tu teléfono:</label>
                        <input type="text" name="telefono" id="phone" class="form-control" placeholder="Teléfono" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Ingresa tu correo electrónico:</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Correo" required>
                        <small id="emailHelp" class="form-text text-muted" style="color:red;"></small>
                    </div>
                    <div class="form-group">
                        <label for="password">Ingresa tu contraseña:</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
                    </div>                  
                    <div class="form-group">
                        <label for="password-confirm">Verifica tu contraseña:</label>
                        <input type="password" name="password_confirmation" id="password-confirm" class="form-control" placeholder="Verifica la contraseña" required>
                    </div>
                    <br/>
                    <div class="wrapper">
                        <span class="group-btn">
                            <button type="submit" class="btn btn-danger btn-md" id="registerBtn">Registrar</button>
                            <a class="btn btn-danger btn-md" id="iniciarBtn" href="{{ url('login') }}">Login</a>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="../js/script2.js"></script>
<script>
// Guardar datos en localStorage cuando el usuario complete el formulario
    document.getElementById("registerBtn").addEventListener("click", function(event) {
    event.preventDefault(); // Evitar el envío del formulario para hacer el guardado en localStorage

    // Obtener los valores del formulario
    const nombre = document.getElementById("name").value;
    const edad = document.getElementById("age").value;
    const genero = document.querySelector('input[name="genero"]:checked').value;
    const telefono = document.getElementById("phone").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    
    // Almacenar los datos en localStorage
    localStorage.setItem("nombre", nombre);
    localStorage.setItem("edad", edad);
    localStorage.setItem("genero", genero);
    localStorage.setItem("telefono", telefono);
    localStorage.setItem("email", email);
    localStorage.setItem("password", password);

    // Enviar el formulario si se necesita
    document.querySelector("form").submit();
});

// Recuperar los datos del localStorage (si los tienes guardados)
window.onload = function() {
    if (localStorage.getItem("nombre")) {
        document.getElementById("name").value = localStorage.getItem("nombre");
        document.getElementById("age").value = localStorage.getItem("edad");
        document.querySelector(`input[name="genero"][value="${localStorage.getItem("genero")}"]`).checked = true;
        document.getElementById("phone").value = localStorage.getItem("telefono");
        document.getElementById("email").value = localStorage.getItem("email");
    }
};
</script>
<!-- Almacenamiento offline -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Verifica si el usuario está offline
        if (!navigator.onLine) {
            // Verifica si ya tenemos datos guardados en localStorage
            const savedData = localStorage.getItem('formRegistro');
            if (savedData) {
                const formData = JSON.parse(savedData);
                // Rellena el formulario con los datos guardados
                document.getElementById('name').value = formData.nombre || '';
                document.getElementById('age').value = formData.edad || '';
                document.querySelector(`input[name="genero"][value="${formData.genero}"]`).checked = true;
                document.getElementById('phone').value = formData.telefono || '';
                document.getElementById('email').value = formData.email || '';
            }
        }

        // Guarda los datos en localStorage cuando el formulario cambia
        document.querySelector('form').addEventListener('input', function() {
            if (!navigator.onLine) {
                const formData = {
                    nombre: document.getElementById('name').value,
                    edad: document.getElementById('age').value,
                    genero: document.querySelector('input[name="genero"]:checked').value,
                    telefono: document.getElementById('phone').value,
                    email: document.getElementById('email').value
                };
                localStorage.setItem('formRegistro', JSON.stringify(formData));
            }
        });
    });
</script>
</body>
</html>
