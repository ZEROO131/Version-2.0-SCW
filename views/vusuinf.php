<?php 
// Iniciar sesión si no está activa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir el controlador
include('controllers/cusuinf.php');
?>
<?php
// Iniciar sesión si aún no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


?>

<div class="actusu">
    <div class="profile-container">
        <img src="img/AUDI.png" alt="Profile Picture" class="profile-image">
        <div class="moving-circle"></div>
    </div>

    <div id="ins">
        <form name="frm1" action="#" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="ope" value="save"> <!-- Indica que la operación es guardar -->
            <input type="hidden" name="idusu" value="<?= $_SESSION['idusu'] ?? ''; ?>"> <!-- Si estás editando, pasa el ID del usuario -->

            <div class="row">
                <div class="col-md-12">

                    <!-- Nombre -->
                    <div class="mb-3">
                        <label class="form-group" for="nomusu">Nombre</label>
                        <input type="text" class="form-control" name="nomusu" id="nomusu" 
                               value="<?= $dat && isset($dat[0]['nomusu']) ? $dat[0]['nomusu'] : ''; ?>" required>
                    </div>

                    <!-- Apellido -->
                    <div class="mb-3">
                        <label class="form-group" for="apeusu">Apellido</label>
                        <input type="text" class="form-control" name="apeusu" id="apeusu" 
                               value="<?= $dat && isset($dat[0]['apeusu']) ? $dat[0]['apeusu'] : ''; ?>" required>
                    </div>

                    <!-- No. Documento -->
                    <div class="mb-3">
                        <label class="form-group" for="ndocusu">No. Documento</label>
                        <input type="text" class="form-control" name="ndocusu" id="ndocusu" 
                               value="<?= $dat && isset($dat[0]['ndocusu']) ? $dat[0]['ndocusu'] : ''; ?>" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-group" for="emailusu">Email</label>
                        <input type="email" class="form-control" name="emailusu" id="emailusu" 
                               value="<?= $dat && isset($dat[0]['emailusu']) ? $dat[0]['emailusu'] : ''; ?>" required>
                    </div>

                    <!-- Teléfono -->
                    <div class="mb-3">
                        <label class="form-group" for="telusu">Teléfono</label>
                        <input type="text" class="form-control" name="telusu" id="telusu" 
                               value="<?= $dat && isset($dat[0]['telusu']) ? $dat[0]['telusu'] : ''; ?>" required>
                    </div>

                    <!-- Imagen -->
                    <div class="mb-3">
                        <label class="form-group" for="imgusu">Imagen</label>
                        <input type="file" class="form-control" name="fots" accept="image/*" id="imgusu">
                        <input type="hidden" name="imgusu" 
                               value="<?= $dat && isset($dat[0]['imgusu']) ? $dat[0]['imgusu'] : ''; ?>">
                    </div>

                </div>
                    <!-- Botón de enviar -->
                <div>
                    <br>
                    <input type="hidden" name="ope" value="save">
                    <input type="submit" class="btn" value="Enviar">
                </div>
            </div>
        </form>
    </div>
</div>
