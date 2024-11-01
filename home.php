<?php 
require_once 'models/seg.php';
require_once 'models/conexion.php';

// Solo inicia la sesión si aún no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S. CAR WASH</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="img/LOGO.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>
<?php
    $pg = isset($_REQUEST["pg"]) ? $_REQUEST["pg"] : NULL;
    if(!$pg && isset($_SESSION['pagini'])) {
        $pg = $_SESSION['pagini'];
    }
?>
    <nav>
        <?php include ("views/menu.php"); ?>
    </nav>

	<section class="conte">
		<?php
		if (function_exists('validar')) {
			$rut = validar($pg);
            if ($rut) {
                include($rut[0]['rutpag']);
            } else {
                echo "<br><br><br><br><br><br><br>
                      <h3>No tiene permisos para ingresar a este sitio.</h3>
                      <p>Parámetro pg: $pg</p>
                      <p>ID de perfil: " . $_SESSION['idper'] . "</p>
                      <br><br><br><br><br><br><br>";
            }
		} else {
			echo "<br><br><br><br><br><br><br><h3>La función validar() no está definida.</h3><br><br><br><br><br><br><br>";
		}
		?>
	</section>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
