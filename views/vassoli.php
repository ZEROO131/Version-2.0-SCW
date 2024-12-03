<?php 
    include("controllers/cemple.php"); // Controlador de empleados
    include("controllers/csoli.php"); //Controlador de solicitud
    include("controllers/ciniemp.php"); //Controlador de vehiculo
    include("controllers/cassoli.php"); //Controlador de asignacion

?>

<div class="container">
    <br>
    <br>
    <br>
    <br>
    <!-- Solicitudes de Servicio -->
    <div id="solicitudes-servicio" class="card mb-4">
        <div class="card-body">
            <h3 class="text-center mb-4" style="color: black;">Solicitudes de Servicio</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Solicitud</th>
                        <th>Fecha</th>
                        <th>Placa del Vehículo</th>
                        <th>Nombre del Usuario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($soli)) { ?>
                        <?php foreach ($soli as $solicitud) { ?>
                            <tr>
                                <td><?= htmlspecialchars($solicitud['idsoli']); ?></td>
                                <td><?= htmlspecialchars($solicitud['fecha']); ?></td>
                                <td><?= htmlspecialchars($solicitud['placa_vehiculo']); ?></td>
                                <td><?= htmlspecialchars($solicitud['nombre_completo']); ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="4" class="text-center">No hay solicitudes disponibles.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <br>
    <!-- Asignar Servicios a Empleados -->
    <div id="asignar-servicios" class="card mb-4">
        <div class="card-body">
            <h3 class="text-center mb-6" style="color: black;">Asignar Servicios</h3>
            <form name="frm1" action="#" method="POST" enctype="multipart/form-data">
                <!-- Campo de Selección de Solicitudes -->
                <div class="form-group mb-3">
                    <label for="solicitud">Seleccione una solicitud</label>
                    <select class="form-control" name="solicitud" id="idsoli" required>
                        <option value="">Seleccione...</option>
                        <?php if (!empty($soli)) { ?>
                            <?php foreach ($soli as $solicitud) { ?>
                                <option value="<?= $solicitud['idsoli']; ?>">
                                    Solicitud ID: <?= $solicitud['idsoli']; ?> - Fecha: <?= $solicitud['fecha']; ?>
                                </option>
                            <?php } ?>
                        <?php } else { ?>
                            <option value="">No hay solicitudes disponibles</option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Campo de Selección de Empleados -->
                <div class="form-group mb-3">
                    <label for="empleado">Seleccione un empleado</label>
                    <select class="form-control" name="empleado" id="idemple" required>
                        <option value="">Seleccione...</option>
                        <?php if ($demp): ?>
                            <?php foreach ($demp as $empleado): ?>
                                <option value="<?= $empleado['idemple']; ?>">
                                    <?= $empleado['nomemple']; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Botón de Envío -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-3">Asignar Servicio</button>
                </div>
            </form>
        </div>
    </div>

    <?php if (isset($mensaje)) { ?>
        <div class="alert alert-info">
            <?= htmlspecialchars($mensaje); ?>
        </div>
    <?php } ?>


    <br>
    <a href="home.php?pg=2001" class="btn btn-secondary">Regresar</a>
</div>