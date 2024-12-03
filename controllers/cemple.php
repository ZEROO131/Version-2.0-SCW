<?php
require_once './models/memple.php';


// Obtenemos los datos de la solicitud
$idemple = isset($_REQUEST['idemple']) ? $_REQUEST['idemple'] : NULL;
$nomemple = isset($_REQUEST['nomemple']) ? $_REQUEST['nomemple'] : NULL;
$tipdocu = isset($_POST['tipdocu']) ? $_POST['tipdocu'] : NULL;
$ndocemple = isset($_POST['ndocemple']) ? $_POST['ndocemple'] : NULL;
$emaiemple = isset($_POST['emaiemple']) ? $_POST['emaiemple'] : NULL;
$idempre = isset($_POST['idempre']) ? $_POST['idempre'] : NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;

$memple = new Memple();
$memple->setIdemple($idemple);

if ($ope == "save") {
    $memple->setNomemple($nomemple);
    $memple->setTipdocu($tipdocu);
    $memple->setNdocemple($ndocemple);
    $memple->setEmaiemple($emaiemple);
    $memple->setIdempre($idempre);

    if ($idemple) {
        // Si idemple existe, entonces edita
        $memple->edit();
    } else {
        // Si idemple es NULL, guarda el nuevo registro
        $memple->save();
    }
}


$m = 2;
$dmOne = NULL; // Definimos $dmOne como NULL de manera predeterminada

if ($ope == "del" && $idemple) {
    $memple->del();
}

if ($ope == "edi" && $idemple) {
    $dmOne = $memple->getOne();
    $m = 1;
}

$det = $memple->getAll();
$demp = $memple->getEmpall();
?>

