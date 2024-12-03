<?php
require_once './models/mserv.php';

// Obtenemos los datos de la solicitud
$idservi = isset($_REQUEST['idservi']) ? $_REQUEST['idservi'] : NULL;
$nit = isset($_REQUEST['nit']) ? $_REQUEST['nit'] : NULL;
$detservi = isset($_POST['detservi']) ? $_POST['detservi'] : NULL;
$precio = isset($_POST['precio']) ? $_POST['precio'] : NULL;
$tipservi = isset($_POST['tipservi']) ? $_POST['tipservi'] : NULL;
$idempre = isset($_POST['idempre']) ? $_POST['idempre'] : NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;

$servicio = new Mserv();
$servicio->setIdservi($idservi);

if ($ope == "save") {
    $servicio->setNit($nit);
    $servicio->setDetservi($detservi);
    $servicio->setPrecio($precio);
    $servicio->setTipservi($tipservi);
    $servicio->setIdempre($idempre);

    if ($idservi) {
        // Si idservi existe, entonces edita
        $servicio->edit();
    } else {
        // Si idservi es NULL, guarda el nuevo registro
        $servicio->save();
    }
}

$m = 2;
$dsOne = NULL; // Definimos $dmOne como NULL de manera predeterminada

if ($ope == "del" && $idservi) {
    $servicio->del();
}

if ($ope == "edi" && $idservi) {
    $dsOne = $servicio->getOne();
    $m = 1;
}

$des = $servicio->getAll();


?>
