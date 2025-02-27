<?php
require_once(__DIR__ . '/../models/control.php');// ✅ RUTA FIJA// Ahora se conecta directamente al controlador

// Verificar si se envió el formulario de recuperación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = trim($_POST['email']);
    
    // Llamar a la función de recuperación de contraseña en control.php
    restablecerContrasena($email);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="styles.css"> <!-- Asegúrate de que el estilo sea el correcto -->
</head>
<body>
    <div class="container">
        <h2>Recuperar Contraseña</h2>
        <p>Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.</p>
        
        <form action="../models/control.php" method="POST">
            <input type="hidden" name="accion" value="recuperar">
            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" required>
            
            <button type="submit">Enviar</button>
        </form>
    </div>
    
    <script>
        // Redirigir si el token es válido
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('token')) {
            window.location.href = `cambiar_contrasena.php?token=${urlParams.get('token')}`;
        }
    </script>
</body>
</html>

 