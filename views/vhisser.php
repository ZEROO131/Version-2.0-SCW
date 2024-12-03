<?php 
    include("controllers/cassoli.php"); //Controlador de asignacion
?>

<br>
    <div class="col">
        <table class="table table-striped" style="width:100%">
            <h1 style="color: #ffffff; text-align: center;"> HISTORIAL DE SERVICIOS </h1>
            <thead>
                <tr>
                    <th>ID Vehículo</th>
                    <th>Placa</th>
                    <th>ID Servicio</th>
                    <th>Nombre del servicio</th>
                    <th>ID Empleado</th>
                    <th>Nombre del empleado</th>
                </tr>
            </thead>
            <tbody>
                <!-- Ciclo para mostrar los datos de las asignaciones disponibles -->
                <?php if (!empty($dasi)): ?>
                    <?php foreach ($dasi as $fila): ?>
                        <tr>
                            <td><?= htmlspecialchars($fila['idvehi']) ?></td>
                            <td><?= htmlspecialchars($fila['placa']) ?></td>
                            <td><?= htmlspecialchars($fila['idservi']) ?></td>
                            <td><?= htmlspecialchars($fila['nombre_servicio']) ?></td>
                            <td><?= htmlspecialchars($fila['idemple']) ?></td>
                            <td><?= htmlspecialchars($fila['nombre_empleado']) ?></td>
                            <td>
                                <a href="home.php?pg=<?= $pg; ?>&idper=<?= $d['idper']; ?>&opera=edi" title="Editar">
                                    <i class="fa-solid fa-pen-to-square fa-2x"></i>
                                </a>
                                <br>
                                <a href="home.php?pg=<?= $pg; ?>&idper=<?= $d['idper']; ?>&opera=edi" title="Eliminar">
                                    <i class="fa-solid fa-trash fa-2x"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Mensaje si no hay datos -->
                    <tr>
                        <td colspan="4" class="text-center">No hay asignaciones registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <a href="home.php?pg=2001" class="btn btn-secondary">Regresar</a>
</div>
