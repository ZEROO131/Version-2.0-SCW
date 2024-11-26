<?php
include("models/Musuinf.php"); // Incluir el modelo de usuario
include("controllers/optimg.php"); // Incluir cualquier controlador necesario (por ejemplo, para manejar imágenes)

// Verificar si la sesión está iniciada, si no, iniciarla
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Obtener el ID de usuario desde la sesión (o la URL en caso de edición)
$idusu = isset($_POST['idusu']) ? $_POST['idusu'] : (isset($_SESSION['idusu']) ? $_SESSION['idusu'] : NULL);
// Agregar para depurar el ID del usuario
echo "<p>ID del usuario: " . ($idusu ? $idusu : 'No ID disponible') . "</p>";
// Obtener otros datos del formulario
$nomusu = isset($_POST['nomusu']) ? $_POST['nomusu'] : NULL;
$apeusu = isset($_POST['apeusu']) ? $_POST['apeusu'] : NULL;
$emailusu = isset($_POST['emailusu']) ? $_POST['emailusu'] : NULL;
$telusu = isset($_POST['telusu']) ? $_POST['telusu'] : NULL;
$imgusu = isset($_POST['imgusu']) ? $_POST['imgusu'] : NULL;
$ope = isset($_POST['ope']) ? $_POST['ope'] : NULL;
$fots = isset($_FILES['fots']['name']) ? $_FILES['fots']['name'] : NULL;

// Agregar para depurar los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<pre>Datos del formulario: ";
    var_dump($_POST);
    echo "</pre>";
}

// Si se sube una nueva imagen, procesarla
if ($fots) {
    // Eliminar la imagen anterior si existe
    if (file_exists($imgusu)) unlink($imgusu);
    // Procesar la nueva imagen (opcional: puedes usar una función para optimizarla)
    $imgusu = opti($_FILES['fots'], 'fotos', 'jotos', date('YmdHis'));
}

// Crear el objeto Musuinf (modelo)
$musu = new Musuinf();
$musu->setIdusu($idusu);

// Si se solicita editar un usuario, obtener sus datos
if ($ope == "edi" && $idusu) {
    $dtOne = $musu->getOne(); // Cambié el método a `getOne` para obtener un solo usuario

    // Verifica si los datos fueron obtenidos correctamente
    if ($dtOne) {
        $m = 1; // Indicador de edición
    }
} else {
    $dtOne = NULL; // No se obtienen datos si no se está editando
}

// Inicialización de la variable de mensaje
$m = 2;

// Si se solicita eliminar un usuario
if ($ope == "del" && $idusu) {
    $musu->eliminarUsuario($idusu);
}

// Si se solicita guardar o editar el usuario
if ($ope == "save" && $_POST) {
    // Si se va a guardar o editar el usuario, se asignan los datos del formulario
    $musu->setNomusu($nomusu);
    $musu->setApeusu($apeusu);
    $musu->setEmailusu($emailusu);
    $musu->setTelusu($telusu);
    $musu->setImgusu($imgusu);

    // Si ya existe el ID del usuario, se edita, si no, se guarda como nuevo
    if ($idusu) {
        // Pasar los parámetros necesarios al método editarUsuario
        $musu->editarUsuario($idusu, $nomusu, $apeusu, $emailusu, $telusu);
        $_SESSION['message'] = "Usuario editado correctamente.";
    } else {
        // Pasar los parámetros necesarios al método guardarUsuario
        $musu->guardarUsuario($nomusu, $apeusu, $emailusu, $telusu);
        $_SESSION['message'] = "Usuario creado correctamente.";
    }
}
?>
