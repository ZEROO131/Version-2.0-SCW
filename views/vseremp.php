<?php 
    include("controllers/cemple.php"); // Controlador para empleados
    include("controllers/cserv.php"); // Controlador para servicios
?>
    <br>
    <br>
    <br>
<div class="container">
    <br>

        <!-- Crear Empleados -->
    <div id="crear-empleados" class="card mb-4">
        <div class="card-body">
            <h3 class="text-center mb-4" style="color: black;">Crear Empleados</h3>
            <form name="frm1" action="#" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="nomemple">Nombre del empleado</label>
                        <input type="text" class="form-control" name="nomemple" id="nomemple" 
                               value="<?php if(isset($dmOne) && $dmOne && isset($dmOne[0]['nomemple'])) echo $dmOne[0]['nomemple']; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tipdocu">Tipo de Documento</label>
                        <br>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="tipdocu" id="cc" value="C.C" 
                                   <?php if(isset($dmOne) && $dmOne && isset($dmOne[0]['tipdocu']) && $dmOne[0]['tipdocu'] == "C.C") echo 'checked'; ?> required>
                            <label class="form-check-label" for="cc">Cédula de Ciudadanía</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="tipdocu" id="p" value="P" 
                                   <?php if(isset($dmOne) && $dtOne && isset($dmOne[0]['tipdocu']) && $dmOne[0]['tipdocu'] == "P") echo 'checked'; ?>>
                            <label class="form-check-label" for="p">Pasaporte</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="tipdocu" id="ce" value="C.E" 
                                   <?php if(isset($dmOne) && $dmOne && isset($dmOne[0]['tipdocu']) && $dmOne[0]['tipdocu'] == "C.E") echo 'checked'; ?>>
                            <label class="form-check-label" for="ce">Cédula de Extranjería</label>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="ndocemple">Número de documento</label>
                        <input type="number" class="form-control" name="ndocemple" id="ndocemple" 
                               value="<?php if(isset($dmOne) && $dmOne && isset($dmOne[0]['ndocemple'])) echo $dmOne[0]['ndocemple']; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="emaiemple">Correo electrónico</label>
                        <input type="email" class="form-control" name="emaiemple" id="emaiemple" 
                               value="<?php if(isset($dmOne) && $dmOne && isset($dmOne[0]['emaiemple'])) echo $dmOne[0]['emaiemple']; ?>" required>
                    </div>
                    <div class="form-group col-md-2 d-flex align-items-end">
                        <input type="hidden" name="ope" value="save">
                        <input type="hidden" name="idemple" value="<?php if(isset($dmOne) && $dmOne && isset($dmOne[0]['idemple'])) echo $dmOne[0]['idemple']; ?>" required>
                        <input type="submit" class="btn btn-primary" value="Enviar">
                    </div>
                </div>
            </form>
        </div>
    <br>
        <div id="lista-empleados" class="card mb-4" >
            <div class="card-body">
                <h3 class="text-center mb-4" style="color: black;">Lista de Empleados</h3>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID Empleado</th>
                            <th>Nombre del Empleado</th>
                            <th>Tipo de Documento</th>
                            <th>Número de Documento</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($det as $detm) { ?>
                            <tr>
                                <td><?= htmlspecialchars($detm['idemple']); ?></td>
                                <td><?= htmlspecialchars($detm['nomemple']); ?></td>
                                <td><?= htmlspecialchars($detm['tipdocu']); ?></td>
                                <td><?= htmlspecialchars($detm['ndocemple']); ?></td>
                                <td><?= htmlspecialchars($detm['emaiemple']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
        </div>
    </div>

    </div>
    <br>
        <!-- Crear Servicios -->
    <div id="crear-servicios" class="card mb-4">
        <div class="card-body">
            <h3 class="text-center mb-4" style="color: black;">Crear Servicios</h3>
            <form name="frm1" action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group col-md-6">
                    <label for="nombre-servicio">Detalle de servicio</label>
                    <input type="text" class="form-control form-control" name="detservi" id="detservi" value="<?php if($dsOne && $dsOne[0]['detservi']) echo $dsOne[0]['detservi']; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="nombre-servicio">Precio</label>
                    <input type="number" class="form-control form-control" name="precio" id="precio" value="<?php if($dsOne && $dsOne[0]['precio']) echo $dsOne[0]['precio']; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="nombre-servicio">Tipo de servicio</label>
                    <input type="text" class="form-control form-control" name="tipservi" id="tipservi" value="<?php if($dsOne && $dsOne[0]['tipservi']) echo $dsOne[0]['tipservi']; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <br>
                    <input type="hidden" name="ope" value="save">
                    <input type="hidden" name="idservi" value="<?php if($dsOne && $dsOne[0]['idservi']) echo $dsOne[0]['idservi']; ?>" required>
                    <input type="submit" class="btn btn-primary" value="Enviar">
                </div>
            </form>
        </div>
    

        <div id="lista-empleados" class="card mb-4">
            <div class="card-body">
                <h3 class="text-center mb-4" style="color: black;">Lista de Empleados</h3>
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre del servicio</th>
                            <th>Precio</th>
                            <th>Tipo de servicio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($des as $servicio) { ?>
                            <tr>
                                <td><?= htmlspecialchars($servicio['idservi']); ?></td>
                                <td><?= htmlspecialchars($servicio['detservi']); ?></td>
                                <td><?= htmlspecialchars($servicio['precio']); ?></td>
                                <td><?= htmlspecialchars($servicio['tipservi']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
        </div>
    </div>
</div>

    <a href="home.php?pg=2001" class="btn btn-secondary">Regresar</a>
</div>