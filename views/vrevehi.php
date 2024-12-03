<?php 
    include("controllers/ciniemp.php"); // Controlador de registro de vehículos
?>
<div class="container">
    <br>
    <br>
    <br>
    <br>
    <!-- Registrar Vehículos -->
    <div id="registrar-vehiculos" class="card mb-6">
        <div class="card-body">
            <h3 class="text-center mb-4" style="color: #000000">Registrar Vehículos</h3>
            <form name="frm1" action="#" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="placa">Placa</label>
                        <input type="text" class="form-control form-control" name="placa" id="placa" value="<?php if($dtOne && $dtOne[0]['placa']) echo $dtOne[0]['placa']; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="color">Color</label>
                        <input type="text" class="form-control form-control" name="color" id="color" value="<?php if($dtOne && $dtOne[0]['color']) echo $dtOne[0]['color']; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="marca">Marca</label>
                        <input type="text" class="form-control form-control" name="marca" id="marca" value="<?php if($dtOne && $dtOne[0]['marca']) echo $dtOne[0]['marca']; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="modelvehi">Modelo del vehículo</label>
                        <input type="text" class="form-control form-control" name="modelvehi" id="modelvehi" value="<?php if($dtOne && $dtOne[0]['modelvehi']) echo $dtOne[0]['modelvehi']; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tipvehi">Tipo de vehículo</label>
                        <input type="text" class="form-control form-control" name="tipvehi" id="tipvehi" value="<?php if($dtOne && $dtOne[0]['tipvehi']) echo $dtOne[0]['tipvehi']; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="srv">Seleccione un servicio</label>
                        <select class="form-control" name="srv" id="idservi" required>
                            <option value="">Seleccione...</option>
                            <?php if ($serv): ?>
                                <?php foreach ($serv as $servicio): ?>
                                    <option value="<?php echo $servicio['detservi']; ?>"
                                        <?php if ($dtOne && $dtOne[0]['tipvehi'] == $servicio['detservi']) echo 'selected'; ?>>
                                        <?php echo $servicio['detservi'] . ' - $' . $servicio['precio']; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <br>
                        <input type="hidden" name="ope" value="save">
                        <input type="hidden" name="idvehi" value="<?php if($dtOne && $dtOne[0]['idvehi']) echo $dtOne[0]['idvehi']; ?>" required>
                        <input type="submit" class="btn btn-primary" value="Enviar">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    <a href="home.php?pg=2001" class="btn btn-secondary">Regresar</a>
</div>
