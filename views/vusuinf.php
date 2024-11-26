<?php 
// Incluir el controlador
include('controllers/cusuinf.php');

// Iniciar sesión si no está activa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar que existe la sesión y obtener los datos del usuario
$idusu = isset($_SESSION['idusu']) ? $_SESSION['idusu'] : 0;

// Depuración de datos POST y sesión
echo "<pre>POST Data: ";
var_dump($_POST);
echo "</pre>";

echo "<pre>Session Data: ";
var_dump($_SESSION);
echo "</pre>";
?>

<div class="profile-container">
    <img src="img/AUDI.png" alt="Profile Picture" class="profile-image">
    <div class="moving-circle"></div>
</div>

<div id="ins">
    <form name="frm1" action="#" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col-md-4">
                <label for="nomusu">Nombre</label>
                <input type="text" class="form-control" name="nomusu" id="nomusu" 
                value="<?php echo ($dtOne && isset($dtOne[0]['nomusu'])) ? $dtOne[0]['nomusu'] : ''; ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="apeusu">Apellido</label>
                <input type="text" class="form-control" name="apeusu" id="apeusu" 
                value="<?php echo ($dtOne && isset($dtOne[0]['apeusu'])) ? $dtOne[0]['apeusu'] : ''; ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="emailusu">Email</label>
                <input type="email" class="form-control" name="emailusu" id="emailusu" 
                value="<?php echo ($dtOne && isset($dtOne[0]['emailusu'])) ? $dtOne[0]['emailusu'] : ''; ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="telusu">Teléfono</label>
                <input type="text" class="form-control" name="telusu" id="telusu" 
                value="<?php echo ($dtOne && isset($dtOne[0]['telusu'])) ? $dtOne[0]['telusu'] : ''; ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="imgusu">Imagen</label>
                <input type="file" class="form-control" name="fots" accept="image/*" id="imgusu">
                <input type="hidden" name="imgusu" 
                value="<?php echo ($dtOne && isset($dtOne[0]['imgusu'])) ? $dtOne[0]['imgusu'] : ''; ?>">
            </div>
            <div class="form-group col-md-4">
                <br>
                <input type="hidden" name="ope" value="save">
                <input type="hidden" name="idusu" 
                value="<?php echo (isset($_SESSION['idusu']) && $_SESSION['idusu'] != "") ? $_SESSION['idusu'] : ''; ?>" required>
                <input type="submit" class="btn btn-primary" value="Enviar">
            </div>
        </div>
    </form>
</div>
