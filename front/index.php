<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="./css/login.css">
    <script src="./js/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <form id="login-form" class="form">
            <h2>Iniciar Sesión</h2>
            <input type="email" id="correo" name="correo" placeholder="Correo electrónico" required>
            <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
            <p class="message">¿No tienes una cuenta? <a href="signup.php">Registrarse</a></p>
        </form>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#login-form').submit(function(event) {
                event.preventDefault();
                
                var data = $(this).serialize();

                $.ajax({
                    url: '../back/dblogin.php',
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function(response) {
                        if (response.success) {
                            window.location.href = 'home.php'; // Página a la que redirigir después de iniciar sesión
                        } else {
                            alert(response.message);
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
