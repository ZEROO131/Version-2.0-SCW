<?php
include("models/Musuinf.php"); // Incluir el modelo de usuario
include("controllers/optimg.php"); // Incluir cualquier controlador necesario (por ejemplo, para manejar imágenes)

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$idusu = isset($_SESSION['idusu']) ? $_SESSION['idusu'] : NULL; 

$nomusu = isset($_POST['nomusu']) ? $_POST['nomusu'] : NULL; 
$apeusu = isset($_POST['apeusu']) ? $_POST['apeusu'] : NULL; 
$emailusu = isset($_POST['emailusu']) ? $_POST['emailusu'] : NULL; 
$paswusu = isset($_POST['paswusu']) ? $_POST['paswusu'] : NULL; 
$tipdocusu = isset($_POST['tipdocusu']) ? $_POST['tipdocusu'] : NULL; 
$ndocusu = isset($_POST['ndocusu']) ? $_POST['ndocusu'] : NULL; 
$telusu = isset($_POST['telusu']) ? $_POST['telusu'] : NULL; 
$codubi = isset($_POST['codubi']) ? $_POST['codubi'] : NULL; 
$idper = isset($_POST['idper']) ? $_POST['idper'] : NULL; 
$imgusu = isset($_POST['imgusu']) ? $_POST['imgusu'] : NULL; 
$ope = isset($_POST['ope']) ? $_POST['ope'] : NULL;

$musuinf = new Musuinf();

if ($ope == "save") {
    $musuinf->setIdusu($idusu);
    $musuinf->setNomusu($nomusu);
    $musuinf->setApeusu($apeusu);
    $musuinf->setEmailusu($emailusu);
    $musuinf->setPaswusu($paswusu);
    $musuinf->setTipdocusu($tipdocusu);
    $musuinf->setNdocusu($ndocusu);
    $musuinf->setTelusu($telusu);
    $musuinf->setCodubi($codubi);
    $musuinf->setIdper($idper);
    $musuinf->setImgusu($imgusu);

        // Guardar o actualizar según el valor de idusu
        if ($idusu) {
            $musuinf->edit();
        } else {
            $musuinf->save();
        }
}

// Determina el modo de la operación y obtiene los datos de usuario
$m = 2;
if (isset($_GET['ope']) && $_GET['ope'] == "edi" && $idusu) {
    $dtOne = $musuinf->getOne(); // Obtiene los datos del usuario específico
    $m = 1;
} else {
    $dtOne = NULL;
}

// Obtiene todos los usuarios
$dat = $musuinf->getAll();


?>
