<?php 
include("models/musuiniser.php");


if (isset($_SESSION['idusu'])) {
    $idUsuario = $_SESSION['idusu'];
    $modeloServicios = new ModeloServicios();
    $servicios = $modeloServicios->obtenerServiciosPorUsuario($idUsuario);

} else {
    echo "No hay sesión activa. Por favor, inicia sesión.";
}
?>