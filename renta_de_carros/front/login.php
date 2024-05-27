<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="./css/login.css">
    <script src="./js/login.js" defer></script>
</head>
<body>
    <div class="container">
        <form id="login-form" class="form" action="login.php" method="POST">
            <h2>Iniciar Sesión</h2>
            <input type="email" id="login-email" name="email" placeholder="Correo electrónico" required>
            <input type="password" id="login-password" name="password" placeholder="Contraseña" required>
            <button type="submit">Iniciar Sesión</button>
            <p class="message">¿No tienes una cuenta? <a href="signup.php">Registrarse</a></p>
        </form>
    </div>
</body>
</html>
