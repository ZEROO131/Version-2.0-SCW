<?php 
require_once 'models/seg.php';
require_once 'models/conexion.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S. CAR WASH</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="img/LOGO.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<style>
    body {
        background-color: #2e2d2d; /* Color principal */
    background-image: 
    linear-gradient(135deg, rgba(255, 255, 255, 0.1) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.1) 50%, rgba(255, 255, 255, 0.1) 75%, transparent 75%, transparent),
    linear-gradient(45deg, rgba(255, 255, 255, 0.05) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.05) 50%, rgba(255, 255, 255, 0.05) 75%, transparent 75%, transparent);
    background-size: 20px 20px; /* Tamaño del patrón */
    background-blend-mode: overlay; /* Combina capas para más realismo */
}
</style>
<body>
<?php
    $pg = isset($_REQUEST["pg"]) ? $_REQUEST["pg"] : NULL;
    if(!$pg && isset($_SESSION['pagini'])) {
        $pg = $_SESSION['pagini'];
    }
?>
    <div class="headerr">
		<?php include ("views/header.php"); ?>
	</div>
    <nav>
        <?php include ("views/menu.php"); ?>
        
    </nav>

    <section class="homee">
        <?php
        if (function_exists('validar')) {
            $rut = validar($pg);
            if ($rut && isset($rut[0]['rutpag']) && !empty($rut[0]['rutpag'])) {
                // Incluir la ruta si existe y no está vacía
                include($rut[0]['rutpag']);
            } else {
                // Mensaje de error si no hay permisos o la ruta está vacía
                echo "<br><br><br><br><br><br><br>
                    <h3 style='color: white;'>No tiene permisos para ingresar a este sitio.</h3>
                    <p style='color: white;'>Parámetro pg: $pg</p>
                    <p style='color: white;'>ID de perfil: " . $_SESSION['idper'] . "</p>
                    <br><br><br><br><br><br><br>";
            }
        } else {
            echo "<br><br><br><br><br><br><br><h3>La función validar() no está definida.</h3><br><br><br><br><br><br><br>";
        }
        ?>
    </section>


</body> 
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</html>
