<?php
require_once './models/memple.php';


$idemple = isset($_REQUEST['idemple']) ? $_REQUEST['idemple'] : NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;

$memple = new Memple();
$memple->setIdemple($idemple);


if ($ope == "save") {

    $nomemple = isset($_POST['nomemple']) ? $_POST['nomemple'] : NULL;
    $tipdocu = isset($_POST['tipdocu']) ? $_POST['tipdocu'] : NULL;
    $ndocemple = isset($_POST['ndocemple']) ? $_POST['ndocemple'] : NULL;
    $emaiemple = isset($_POST['emaiemple']) ? $_POST['emaiemple'] : NULL;
    $direempre = isset($_POST['direempre']) ? $_POST['direempre'] : NULL;

   
    $memple->setNomemple($nomemple);
    $memple->setTipdocu($tipdocu);
    $memple->setNdocemple($ndocemple);
    $memple->setEmaiemple($emaiemple);
    $memple->setDireempre($direempre);

    if ($idemple) {

        $memple->edit();
    } else {

        $memple->save();
    }
}

// Si la operación es "del", eliminamos el empleado
if ($ope == "del" && $direempre) {
    $memple->del();
}

// Si la operación es "edi", obtenemos los datos del empleado para editar
$dmOne = NULL;
if ($ope == "edi" && $direempre) {
    $dmOne = $memple->getOne(); // Obtiene los datos del empleado con el ID específico
}

// Si la operación no es editar, eliminamos o guardar, obtenemos todos los empleados
$det = $memple->getAll(); // Si en algún momento quieres obtener todos los empleados
$demp = $memple->getEmpall(); // Este método podría no ser necesario si solo mostramos un empleado
?>
