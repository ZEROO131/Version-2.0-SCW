<?php
require_once './models/massoli.php';
require_once './models/memple.php';
require_once './models/msoli.php';


// Obtenemos los datos de la solicitud
$idasig = isset($_REQUEST['idasig']) ? $_REQUEST['idasig'] : NULL;
$idemple = isset($_POST['empleado']) ? $_POST['empleado'] : NULL;
$idsoli = isset($_POST['solicitud']) ? $_POST['solicitud'] : NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;

$asignacion = new Massoli();
$asignacion->setIdasig($idasig);


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recoger los datos del formulario
        $idemple = $_POST['empleado'];
        $idsoli = $_POST['solicitud'];

        // Crear una nueva instancia del modelo Massoli
        $massoli = new Massoli();
        $massoli->setIdemple($idemple);
        $massoli->setIdsoli($idsoli);

        // Llamar al método save del modelo para guardar la asignación
        if ($massoli->save()) {
            // Redirigir a la lista de asignaciones
        } else {
            // Si hay error, mostrar mensaje
            echo "Error al guardar la asignación.";
        }
    }


$m = 2;
$daOne = NULL; // Definimos $daOne como NULL de manera predeterminada

if ($ope == "del" && $idasig) {
    $asignacion->del();
}

if ($ope == "edi" && $idasig) {
    $daOne = $asignacion->getOne();
    $m = 1;
}

$dasi = $asignacion->getAll();
?>
