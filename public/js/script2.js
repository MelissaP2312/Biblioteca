$(document).ready(function() {
    
    $('#password, #password-confirm').on('keyup', function() {
        validatePasswordStrength();
        validatePasswordsMatch();
    });

    function validatePasswordStrength() {
        var password = $('#password').val();
        var passwordInput = document.getElementById('password');

        // Expresión regular para verificar la seguridad de la contraseña
        var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,12}$/;

        //Valida si se cumple el nivel de la contraseña
        if (!regex.test(password)) {
            passwordInput.setCustomValidity('La contraseña debe tener entre 8 y 12 caracteres, con al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.');
        } else {
            passwordInput.setCustomValidity('');
        }
    }

    function validatePasswordsMatch() {
        var password = $('#password').val();
        var confirmPassword = $('#password-confirm').val();
        var confirmPasswordInput = document.getElementById('password-confirm');

        //Valida que las contraseñas coincidan
        if (password !== confirmPassword) {
            confirmPasswordInput.setCustomValidity('Las contraseñas no coinciden.');
        } else {
            confirmPasswordInput.setCustomValidity('');
        }
    }
});
