
<?php
// Verifica si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Solo inicia la sesión si no está activa
}
include('models/musuini.php');
require_once('controllers/cusubar.php');

// Crea una instancia de la clase Musuini
$musuini = new Musuini();

// Obtén los datos del vehículo para el usuario actual
$vehiculo = $musuini->getVehiculoByUsuario($_SESSION['idusu']);

$idUsuario = $_SESSION['idusu'];
$controller = new SolicitudController();
$data = $controller->getProgressBarData($idUsuario);

$steps = $data['steps'];
$progress = $data['progress']; // El progreso calculado desde PHP
?>

<div class="allsec">
    <div class="sec1 glasusu">
        <?php if ($vehiculo && count($vehiculo) > 0): ?>
            <?php $v = $vehiculo[0]; // Tomamos el primer vehículo si solo hay uno ?>
            
            <!-- Muestra la marca -->
            <p><?php echo htmlspecialchars($v['marca']); ?></p>

            <div class="carusu">
                <!-- Imagen del carro -->
                <img src="img/audir.png" alt="Imagen de auto">
            </div>

            <!-- Muestra la placa del vehículo -->
            <p>Placa: <?php echo htmlspecialchars($v['placa']); ?></p>

        <?php else: ?>
            <p>No se encontró ningún vehículo para este usuario.</p>
        <?php endif; ?>
    </div>

    <div class="sec2 glasusu">
        <div class="barrap">
            <p>Progreso de Solicitud</p>
            <?php if (empty($steps)): ?>
                <p>No hay solicitudes activas para este usuario.</p>
            <?php else: ?>
                <div class="progress-container">
                    <div class="progress-bar">
                        <div class="progress-bar-inner" id="progressBar"></div>
                    </div>
                    <?php foreach ($steps as $index => $step): ?>
                        <div class="progress-step <?php echo $step['completed'] ? 'completed' : ''; ?>" id="step<?php echo $index; ?>">
                            <div class="progress-step-label" id="label<?php echo $index; ?>"><?php echo $step['label']; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        <div>

        </div>
        
    </div>
</div>


<script>
    // Usamos JavaScript para actualizar dinámicamente la barra de progreso
document.addEventListener("DOMContentLoaded", function() {
    var progress = <?php echo $progress; ?>; // Valor de progreso pasado desde PHP
    var progressBar = document.getElementById("progressBar");
    
    // Establece el ancho de la barra de progreso con base en el valor de $progress
    progressBar.style.width = progress + "%";

    // Cambia el color de los textos de las etapas dependiendo del progreso
    var steps = <?php echo json_encode($steps); ?>; // Datos de las etapas
    steps.forEach(function(step, index) {
        var stepElement = document.getElementById("step" + index);
        var labelElement = document.getElementById("label" + index);

        if (step.completed) {
            // Cambiar el color del texto a blanco si la etapa está completada
            labelElement.style.color = "#fff";
            stepElement.style.color = "#fff"; // Cambiar color de texto también en el paso
        } else {
            // Si no está completado, dejar el color por defecto
            labelElement.style.color = "#fff";
            stepElement.style.color = "#fff";
        }
    });
});
</script>
