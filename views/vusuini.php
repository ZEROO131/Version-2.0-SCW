<?php
// Verifica si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Solo inicia la sesión si no está activa
}
include('models/musuini.php');

// Crea una instancia de la clase Musuini
$musuini = new Musuini();

// Obtén los datos del vehículo para el usuario actual
$vehiculo = $musuini->getVehiculoByUsuario($_SESSION['idusu']);
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
        <h1>Sección 2</h1>
        <div class="progress-container">
            <div class="progress-line">
            <div class="step step1 completed"></div>
            <div class="step step2 completed"></div>
            <div class="step step3 completed"></div>
            <div class="step step4 completed"></div>
            </div>
            <div class="step-text">Received</div>
            <div class="step-text">Processed</div>
            <div class="step-text">Shipped</div>
            <div class="step-text">Delivered</div>
        </div>

        <i class="fa-solid fa-house" style="color: #fff; "></i>
    </div>
</div>


