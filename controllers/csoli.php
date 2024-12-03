<?php
require_once './models/msoli.php'; // Importamos el modelo para manejar solicitudes


// Obtenemos los datos de la solicitud
$idsoli = isset($_REQUEST['idsoli']) ? $_REQUEST['idsoli'] : NULL;
$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : NULL;
$estasoli = isset($_POST['estasoli']) ? $_POST['estasoli'] : NULL;
$idvehi = isset($_POST['idvehi']) ? $_POST['idvehi'] : NULL;
$idusu = isset($_POST['idusu']) ? $_POST['idusu'] : NULL;
$idempre = isset($_POST['idempre']) ? $_POST['idempre'] : NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL; // Operación a realizar

// Creamos una instancia del modelo de solicitudes
$msoli = new Msoli();
$msoli->setIdsoli($idsoli);

if ($ope == "save") {
    // Asignamos los valores a los atributos del modelo
    $msoli->setFecha($fecha);
    $msoli->setEstasoli($estasoli);
    $msoli->setIdvehi($idvehi);
    $msoli->setIdusu($idusu);
    $msoli->setIdempre($idempre);

    if ($idsoli) {
        // Si idsoli existe, edita la solicitud existente
        $msoli->edit();
    } else {
        // Si idsoli es NULL, guarda una nueva solicitud
        $msoli->save();
    }
}

$m = 2; // Valor predeterminado para indicar que estamos en modo "nueva solicitud"
$dsolOne = NULL; // Inicializamos como NULL para almacenar una solicitud específica si se edita

if ($ope == "del" && $idsoli) {
    // Si la operación es "eliminar" y se proporcionó idsoli, elimina la solicitud
    $msoli->del();
}

if ($ope == "edi" && $idsoli) {
    // Si la operación es "editar", obtenemos los datos de una solicitud específica
    $dsolOne = $msoli->getOne();
    $m = 1; // Cambiamos el modo para indicar que estamos editando
}

// Obtenemos todas las solicitudes para mostrar en la vista
$soli = $msoli->getAll();
?>