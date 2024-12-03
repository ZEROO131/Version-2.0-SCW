<?php
require_once 'models/miniemp.php';

// Recoger los valores de los parámetros pasados
$idvehi = isset($_REQUEST['idvehi']) ? $_REQUEST['idvehi'] : NULL;
$idusu = isset($_REQUEST['idusu']) ? $_REQUEST['idusu'] : NULL;
$placa = isset($_POST['placa']) ? $_POST['placa'] : NULL;
$color = isset($_POST['color']) ? $_POST['color'] : NULL;
$marca = isset($_POST['marca']) ? $_POST['marca'] : NULL;
$modelvehi = isset($_POST['modelvehi']) ? $_POST['modelvehi'] : NULL;
$tipvehi = isset($_POST['tipvehi']) ? $_POST['tipvehi'] : NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$servicio = isset($_POST['servicio']) ? $_POST['servicio'] : NULL;

// Crear una instancia del modelo Miniemp
$miniemp = new Miniemp();

// Asignar los valores al modelo
$miniemp->setIdvehi($idvehi);
$miniemp->setIdusu($idusu);
$miniemp->setPlaca($placa);
$miniemp->setColor($color);
$miniemp->setMarca($marca);
$miniemp->setModelvehi($modelvehi);
$miniemp->setTipvehi($tipvehi);

// Lógica para guardar o editar vehículo y solicitud
if ($ope == "save") {
    // Llamar al método save para guardar el vehículo y la solicitud
    $mensaje = $miniemp->save();

    // Mostrar el mensaje de éxito o error
    echo $mensaje;
}

// Lógica para eliminar vehículo
if ($ope == "del" && $idvehi) {
    $miniemp->del(); // Eliminar el vehículo
}

// Lógica para editar vehículo
if ($ope == "edi" && $idvehi) {
    $dtOne = $miniemp->getOne(); // Obtener los datos del vehículo
} else {
    $dtOne = NULL;
}

// Obtener todos los vehículos y servicios para mostrar
$dat = $miniemp->getAll();
$serv = $miniemp->getAllsrv();
?>
