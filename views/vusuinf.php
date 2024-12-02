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

// Verificar si hay una sesión activa y si contiene el ID del usuario
if (isset($_SESSION['idusu'])) {
    // Mostrar la ID de sesión y los datos almacenados en la sesión
    echo "<h3>Datos del Usuario en Sesión:</h3>";
    echo "ID de Usuario: " . $_SESSION['idusu'] . "<br>";
    echo "Nombre de Usuario: " . $_SESSION['nomusu'] . "<br>";
    // Agrega más datos de la sesión si es necesario
} else {
    // Mensaje si no hay datos de sesión válidos
    echo "<h3>Datos inválidos: No se encontró una sesión activa.</h3>";
}
?>


<div class="profile-container">
    <img src="img/AUDI.png" alt="Profile Picture" class="profile-image">
    <div class="moving-circle"></div>
</div>

<div id="ins">
    <form name="frm1" action="controllers/cusuinf.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="ope" value="save"> <!-- Indica que la operación es guardar -->
        <input type="hidden" name="idusu" value="<?= $_SESSION['idusu'] ?? ''; ?>"> <!-- Si estás editando, pasa el ID del usuario -->

        <div class="row">
            <div class="form-group col-md-4">
                <label for="nomusu">Nombre</label>
                <input type="text" class="form-control" name="nomusu" id="nomusu" 
                value="<?= $dat && isset($dat[0]['nomusu']) ? $dat[0]['nomusu'] : ''; ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="apeusu">Apellido</label>
                <input type="text" class="form-control" name="apeusu" id="apeusu" 
                value="<?= $dat && isset($dat[0]['apeusu']) ? $dat[0]['apeusu'] : ''; ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="emailusu">Email</label>
                <input type="email" class="form-control" name="emailusu" id="emailusu" 
                value="<?= $dat && isset($dat[0]['emailusu']) ? $dat[0]['emailusu'] : ''; ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="telusu">Teléfono</label>
                <input type="text" class="form-control" name="telusu" id="telusu" 
                value="<?= $dat && isset($dat[0]['telusu']) ? $dat[0]['telusu'] : ''; ?>" required>
            </div>
            <div class="form-group col-md-4">
                <label for="imgusu">Imagen</label>
                <input type="file" class="form-control" name="fots" accept="image/*" id="imgusu">
                <input type="hidden" name="imgusu" 
                value="<?= $dat && isset($dat[0]['imgusu']) ? $dat[0]['imgusu'] : ''; ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
</div>

