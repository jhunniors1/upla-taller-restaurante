<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="estiloslogin.css">
</head>
<body>

    <form id="loginForm">
        <h2>Iniciar Sesión</h2>
        <div class="input-container">
            <input type="text" id="username" placeholder="Usuario">
        </div>
        <div class="input-container">
            <input type="password" id="password" placeholder="Contraseña">
        </div>
        <input type="submit" class="btn" value="Ingresar">
    </form>

    <script>
        // Usuario y contraseña válidos
        const validUser = "javier";
        const validPassword = "12345";

        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita el envío del formulario por defecto

            let username = document.getElementById('username').value.trim();
            let password = document.getElementById('password').value.trim();

            if (username === validUser && password === validPassword) {
                alert("Inicio de sesión exitoso");
                window.location.href = "principal.php"; // Redirige a la página principal
            } else {
                alert("Usuario o contraseña incorrectos");
            }
        });
    </script>

</body>
</html>
