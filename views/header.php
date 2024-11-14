<div class="headerr">
<?php 
     // Iniciar la sesión si aún no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }

        // Verificar si hay un usuario logueado
        if (isset($_SESSION['nomusu']) && isset($_SESSION['apeusu'])) {
            $nombreUsuario = $_SESSION['nomusu'];
            $apellidoUsuario = $_SESSION['apeusu'];
            echo "<p>Bienvenido.<br> $nombreUsuario $apellidoUsuario!</p>";
        } else {
            echo "<p>Bienvenido.<br> invitado!</p>";
        }
?>

</div>