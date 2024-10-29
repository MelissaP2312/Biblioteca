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
    <title>Login</title>
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


<!-- Contenedor Vista Iniciar Sesión-->
<div id="login-container" class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 text-center">
            <div class="form-login"></br>
                <h1>Iniciar sesión</h1>
                </br>
                <!-- Formulario de inicio de sesión -->
                <form action="{{route('login')}}" method="POST">
                    @csrf
                    <input type="text" name="email" id="userName" class="form-control input-sm chat-input" placeholder="Correo electrónico" required/>
                    <br>
                    <div class="input-group">
                        <input type="password" name="password" id="userPassword" class="form-control input-sm chat-input" placeholder="Contraseña" required/>
                        <span class="input-group-text" id="togglePassword" style="cursor:pointer;">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    <br>
                    <a class="link" href="" id="contraseña-forgotten">¿Olvidaste tu contraseña?</a>
                    <br>
                    <br>
                    <div class="wrapper">
                        <span class="group-btn">
                            <a class="btn btn-danger btn-md" id="registerButton" href="{{ route('register') }}">Registrar</a>
                            <button type="submit" class="btn btn-danger btn-md">Login</button>
                        </span>
                    </div>
                </form>
                <!-- Botón de login con Facebook -->
                <div class="wrapper">
                    <span class="group-btn">
                        <a class="btn btn-primary btn-md" style="color: white;" onclick="onLogin();">
                            <i class="fab fa-facebook-f"></i> 
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../js/script.js"></script>
<script>
    window.fbAsyncInit = function() {
      FB.init({
        appId      : '522300940606305',  
        cookie     : true,
        xfbml      : true,
        version    : 'v17.0' 
      });
        
      FB.AppEvents.logPageView();   
    };
  
    (function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement(s); js.id = id;
       js.src = "https://connect.facebook.net/en_US/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
  
    // Función para manejar el login con Facebook
    function checkLoginState() {
      FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
          // El usuario está autenticado, puedes obtener su información
          FB.api('/me', function(response) {
            console.log('Nombre: ' + response.name);
            console.log('ID: ' + response.id);
            // Aquí puedes redirigir o enviar los datos a tu backend
          });
        } else {
          console.log('Usuario no autenticado');
        }
      });
    }

    function onLogin(){
        FB.login((response)=>{
            if(response.authResponse){
                FB.api('/me?fields=email,name,age',(response)=>{
                    console.log(response);
                });
            } else {
                console.error("Error de autenticación o el usuario canceló el inicio de sesión.");
            }
        }, {scope: 'email'});
    }    
  </script>

</body>
</html>
