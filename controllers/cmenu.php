<?php
include_once "models/mmenu.php"; // Asegúrate de incluirlo solo una vez

// Inicia la sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Crear instancia del modelo
$mmenu = new Mmenu();
$mmenu->setIdper($_SESSION['idper']); // Configura el perfil del usuario actual

// Obtén el menú en el orden especificado por `ordpag`
$dat = $mmenu->getMenu();

// Función para validar una página específica
function validarPagina($idpag) {
    $mmenu = new Mmenu();
    $mmenu->setIdpag($idpag);
    $mmenu->setIdper($_SESSION['idper']);
    return $mmenu->getVal();
}

// Agregar lógica para la información de la sesión activa
$sessionInfo = [];
if (isset($_SESSION['nomusu'], $_SESSION['apeusu'], $_SESSION['nomper'])) {
    $sessionInfo = [
        'usuario' => $_SESSION['nomusu'] . ' ' . $_SESSION['apeusu'],
        'perfil' => $_SESSION['nomper'],
    ];
} else {
    $sessionInfo = [
        'error' => 'No hay sesión activa',
    ];
}

// Ahora `$dat` contiene el menú y `$sessionInfo` contiene la información adicional de la sesión.
?>
